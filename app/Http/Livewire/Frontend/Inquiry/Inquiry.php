<?php

namespace App\Http\Livewire\Frontend\Inquiry;

use App\Events\CustomerInquiryReceived;
use App\Jobs\SendAdminInquiryEmail;
use App\Jobs\SendCustomerInquiryEmail;
use App\Mail\AdminInquiryReceivedMail;
use App\Mail\CustomerInquiryReceivedMail;
use App\Models\City;
use App\Models\District;
use App\Models\Input;
use App\Models\InputDetaile;
use App\Models\Inquiry as ModelsInquiry;
use App\Models\Province;
use App\Models\ServiceCategory;
use App\Models\ServiceStaticInputData;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithFileUploads;

class Inquiry extends Component
{
    use WithFileUploads;

    public ModelsInquiry $inquiry;
    public Input $input;
    public ServiceCategory $serviceCategory;
    public Collection $staticInputs;
    public array $listForFields = [];
    public $form = [];
    protected $listeners = ['latitudeUpdated', 'longitudeUpdated'];

    protected $rules = [];

    public ?string $selectedDate = null;
    public ?string $selectedTime = null;


    protected function rules()
    {
        $messages = [];
        $validationAttributes = [];
        $inputCollection = collect($this->listForFields['input']);


        foreach ($inputCollection as $key => $input) {
            if ($input['required'] == 'true') {
                if ($input['type'] == 'email') {
                    $this->rules["form.{$input['id']}"] = 'required|email';
                } elseif ($input['type'] == 'number') {
                    $this->rules["form.{$input['id']}"] = 'required|regex:/^\d+(\.\d{1,2})?$/';
                } else {
                    $this->rules["form.{$input['id']}"] = 'required|max:255';
                }
                $validationAttributes["form.{$input['id']}"] = str_replace('-', ' ', preg_replace('/\d+/', '', $input['slug']));
            } else {
                $this->rules["form.{$input['id']}"] = 'nullable';
            }
        }

        foreach ($this->staticInputs as $input) {
            if ($input->serviceStaticInput->name == 'Name') {
                $this->rules['inquiry.name'] = 'required|string|max:255';
            } elseif ($input->serviceStaticInput->name == 'Email') {
                $this->rules['inquiry.email'] = 'required|string|email|max:255';
            } elseif ($input->serviceStaticInput->name == 'Phone') {
                $this->rules['inquiry.phone'] = 'required|string|regex:/^\+\d{11}$/';
            } elseif ($input->serviceStaticInput->name == 'Province/District/City') {
                $this->rules['inquiry.district_id'] = 'required|string';
                $this->rules['inquiry.city_id'] = 'nullable|string';
            } elseif ($input->serviceStaticInput->name == 'Map') {
                $this->rules['inquiry.latitude'] = 'required';
                $this->rules['inquiry.longitude'] = 'required';
            } elseif ($input->serviceStaticInput->name == 'ConferenceMode') {
                $this->rules['inquiry.is_video_call'] = 'required';
            } elseif ($input->serviceStaticInput->name == 'Duration') {
                $this->rules['inquiry.duration'] = 'required';
            } elseif ($input->serviceStaticInput->name == 'DateAndTime') {
                $this->rules['selectedDate'] = 'required|date';
                $this->rules['selectedTime'] = 'required';
            }
        }


        $validationAttributes['inquiry.name'] = "name";
        $validationAttributes['inquiry.email'] = "email";
        $validationAttributes['inquiry.phone'] = "mobile number";
        $validationAttributes['inquiry.district_id'] = "district";
        $validationAttributes['inquiry.city_id'] = "city";
        $validationAttributes['inquiry.latitude'] = "location";
        $validationAttributes['inquiry.longitude'] = "location";
        $validationAttributes['inquiry.is_video_call'] = "video call";
        $validationAttributes['inquiry.duration'] = "duration";
        $validationAttributes['selectedDate'] = "date";
        $validationAttributes['selectedTime'] = "time";

        $this->validationAttributes = $validationAttributes;


        $this->messages = $messages;

        return $this->rules;
    }

    public function updated()
    {
        $this->validate();
    }

    public function latitudeUpdated($latitude)
    {
        $this->inquiry->latitude = $latitude;
    }

    public function longitudeUpdated($longitude)
    {
        $this->inquiry->longitude = $longitude;
    }


    public function updatingInquiryDistrictId($district)
    {

        $this->listForFields['city'] = City::where('district_id', $district)->orderBy('name')->get();
    }

    public function resetForm()
    {
        $this->reset('form');
        foreach ($this->listForFields['input'] as $input) {
            $this->form[$input['id']] = '';
        }
    }

    public function store()
    {

        $validatedData = $this->validate();


        // Check if the user is authenticated
        if (Auth::check()) {
            $this->inquiry->user_id = (int) Auth::user()->id;
        } else {
            $this->inquiry->user_id = null;
        }
        $this->inquiry->created_by = null;
        $this->inquiry->service_category_id = $this->serviceCategory->id;

        $combinedDateTime = $this->selectedDate && $this->selectedTime
            ? $this->selectedDate . ' ' . $this->selectedTime
            : null;

        $this->inquiry->appointment_datetime = $combinedDateTime;


        $inputDetails = [];

        if (isset($validatedData['form'])) {
            $inputDetails = collect($validatedData['form'])->map(function ($value, $id) {
                if ($value instanceof \Illuminate\Http\UploadedFile) {
                    $extension = $value->getClientOriginalExtension();
                    $fileName = \Str::random(20) . "-" . \Carbon\Carbon::now()->timestamp . '.' . $extension;
                    $path = $value->storeAs('uploads/frontend/inquiry/file', $fileName);
                    return new InputDetaile([
                        'data' => $fileName,
                        'input_id' => $id,
                    ]);
                } else {
                    return new InputDetaile([
                        'data' => $value,
                        'input_id' => $id,
                    ]);
                }
            });
        }

        $this->inquiry->save();
        $this->inquiry->inputDetails()->saveMany($inputDetails);

        $name = $this->inquiry->id;

        $this->sendNotification();


        $this->resetForm();
        $this->inquiry = new ModelsInquiry();

        session()->flash('success', 'Send successfully!');
    }


    private function sendNotification()
    {
        //customer
        Mail::to($this->inquiry->email)->send(new CustomerInquiryReceivedMail(
            $this->inquiry,
            $this->serviceCategory
        ));

        //admin
        $adminUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        foreach ($adminUsers as $adminUser) {
            //mail
            Mail::to($adminUser->email)->send(new AdminInquiryReceivedMail($this->inquiry, $this->serviceCategory));

        }
    }

    public function mount($servicecategory)
    {
        $this->serviceCategory = $servicecategory;
        $this->inquiry = new ModelsInquiry();
        $this->inquiry->name = auth()->user()->name ?? '';
        $this->inquiry->email = auth()->user()->email ?? '';
        $this->inquiry->phone = auth()->user()->phone ?? '';
        $this->listForFields['input'] = Input::where('service_category_id', $this->serviceCategory->id)->orderBy('order', 'asc')->get();
        foreach ($this->listForFields['input'] as $input) {
            $this->form[$input['id']] = '';
        }

        $this->listForFields['district'] = District::orderBy('name')->get();
        $this->listForFields['city'] = City::where('district_id', $this->inquiry->district_id)->orderBy('name')->get();

        $this->staticInputs = ServiceStaticInputData::where('service_category_id', $this->serviceCategory->id)->get();
    }

    public function render()
    {

        return view('livewire.frontend.inquiry.inquiry');
    }
}
