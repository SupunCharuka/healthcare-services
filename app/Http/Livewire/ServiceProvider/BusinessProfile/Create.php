<?php

namespace App\Http\Livewire\ServiceProvider\BusinessProfile;

use App\Models\Business;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Create extends Component
{
    use WithFileUploads;

    public $document;
    public Business $business;
    public array $listForFields = [];
    public $editMode = false;


    protected function rules()
    {
        return [
            'business.address' => ['required', 'string', 'max:255'],
            'business.district_id' => ['required', 'integer'],
            'business.city_id' => ['required', 'integer'],
            'business.postcode' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'business.owner_name' => ['required', 'string', 'max:255'],
            'business.registration_no' => ['required', 'string', 'max:255'],
            'document' => [Rule::requiredIf(empty($this->business->document)), 'nullable', 'file', 'mimes:jpeg,bmp,png,gif,svg,pdf'],
        ];
    }

    protected $validationAttributes = [
        'business.address' => "address",
        'business.district_id' => "district",
        'business.city_id' => "city",
        'business.postcode' => "postcode",
        'business.owner_name' => "name",
        'business.registration_no' => "registration no",
        'document' => "business documents",
    ];

    public function updated()
    {
        $this->validate();
    }
   

    public function updatingBusinessDistrictId($district)
    {

        $this->listForFields['city'] = City::where('district_id', $district)->orderBy('name')->get();
    }

    public function save()
    {
        $this->validate();
        if (!empty($this->document)) {
            $document_name = $this->document->getClientOriginalName() . "-" . \Str::random(20) . "-" . Carbon::now()->timestamp . '.' . $this->document->extension();
            if (!empty($this->business->document)) {
                Storage::delete('uploads/service-provider/business/profile/' . $this->business->document);
            }
            $this->document->storeAs('uploads/service-provider/business/profile', $document_name);
            $this->business->document = $document_name;
        }
        if ($this->editMode) {
            // Perform update logic
            $this->business->update();
            session()->flash('message', 'Successfully updated!');
        } else {
            // Perform create logic

            $this->business->user_id = Auth::user()->id;
            $this->business->save();
            session()->flash('message', 'Successfully created!');
        }
        
    }


    public function mount($existingdata = null)
    {
        $this->business = $existingdata ?: new Business();
        $this->listForFields['district'] = District::orderBy('name')->get();
        $this->listForFields['city'] = City::where('district_id', $this->business->district_id)->orderBy('name')->get();

        if ($existingdata) {
            $this->editMode = true;
        }
    }

    public function render()
    {
        return view('livewire.service-provider.business-profile.create');
    }
}
