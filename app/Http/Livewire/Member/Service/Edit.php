<?php

namespace App\Http\Livewire\Member\Service;

use App\Models\City;
use App\Models\District;
use App\Models\Helper;
use App\Models\Province;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Edit extends Component
{
    use WithFileUploads;

    public Service $service;
    public array $listForFields = [];
    public $image;
    protected $listeners = ['setImage'];

    protected $image_config = [
        'image_resize' => true,
        'image_ratio_y' => true,
        'image_ratio_crop' => 'C',
        'image_x' => 500,
        'image_y' => 500,
    ];

    protected function rules()
    {
        return [
            'service.title' => ['required', Rule::unique('services', 'title')->ignore($this->service->user_id, 'user_id')],
            'service.service_category_id' => ['required', 'integer'],
            'service.sub_categories_id' => ['required', 'integer'],
            'service.district_id' => ['required', 'integer'],
            'service.city_id' => ['required', 'integer'],
            'service.number' => ['required', 'regex:/^\+\d{11}$/'],
            'service.description' => ['required'],
            'image' => [Rule::requiredIf(empty($this->service->image)), 'base64image'],

        ];
    }

    protected $validationAttributes = [
        'service.title' => "title",
        'service.service_category_id' => "category",
        'service.sub_categories_id' => "subcategory",
        'service.district_id' => "district",
        'service.city_id' => "city",
        'service.number' => "phone number",
        'service.description' => "description",
        'image' => "image",
    ];

    protected $messages = [
        'service.title.unique' => 'You have already added this title!',
        'service.number.regex' => 'Please enter a valid phone number in the format: "+94123456789".".',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function setImage($image)
    {
        $this->image = $image;
        $this->validate();
    }

    public function updatingServiceServiceCategoryId($category)
    {

        $this->service->sub_categories_id = null;
        $this->listForFields['subcategory'] = SubCategory::where('service_category_id', $category)->orderBy('name')->get();
    }

    public function updatingServiceDistrictId($district)
    {
        $this->service->city_id = null;
        $this->listForFields['city'] = City::where('district_id', $district)->orderBy('name')->get();
    }

    public function mount(Service $service)
    {
        $this->service = $service;
        if (Auth::check() && Auth::user()->hasRole('service-provider')) {
            if (Auth::user()->hasPermissionTo('doctor.access')) {
               
                $this->listForFields['category'] = ServiceCategory::whereIn('slug', ['home-visit', 'video-audio-consultation'])->get();
            } elseif (Auth::user()->hasPermissionTo('service-provider.access')) {
               
                $this->listForFields['category'] = ServiceCategory::whereIn('slug', ['emergency-medical-care', 'home-nursing'])->orderBy('name')->get();
            }
        }
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $this->listForFields['category'] = ServiceCategory::orderBy('name')->get();
        }

        $this->listForFields['subcategory'] = SubCategory::where('service_category_id', $this->service->service_category_id)->orderBy('name')->get();

        $this->listForFields['district'] = District::orderBy('name')->get();
        $this->listForFields['city'] = City::where('district_id', $this->service->district_id)->orderBy('name')->get();
    }


    public function save()
    {
        $this->validate();
        if (!empty($this->image)) {
            $image_name = Helper::store($this->image, "service-provider/service", \Str::random(20) . "-" . Carbon::now()->timestamp, $this->image_config);
            Storage::delete('uploads/service-provider/service/' . $this->service->image);
            $this->service->image = $image_name;
        }
        $this->service->update();

        session()->flash('message', 'Service has been updated successfully!');
    }

    public function render()
    {
        return view('livewire.member.service.edit');
    }
}
