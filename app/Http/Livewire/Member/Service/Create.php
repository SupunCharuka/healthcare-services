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
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public Service $service;
    public array $listForFields = [];
    public $image;
    protected $listeners = ['setImage'];
    public $categoryName = [];
    public $subcategoryName = [];
    public $districtName = [];
    public $cityName = [];


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
            'service.title' => ['required', 'string', 'max:255'],
            'service.service_category_id' => ['required', 'integer'],
            'service.sub_categories_id' => ['required', 'integer'],
            'service.district_id' => ['required', 'string'],
            'service.city_id' => ['required', 'string'],
            'service.number' => ['required', 'regex:/^\+\d{11}$/'],
            'service.description' => ['required'],
            'image' => ['required', 'base64image'],

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
        'service.number.regex' => 'Please enter a valid phone number in the format: "+94123456789".',
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


    public function mount()
    {
        $this->service = new Service();
        if (Auth::check() && Auth::user()->hasRole('service-provider')) {
            if (Auth::user()->hasPermissionTo('doctor.access')) {
               
                $this->listForFields['category'] = ServiceCategory::whereIn('slug', ['home-visit', 'video-audio-consultation'])->get();
            } elseif (Auth::user()->hasPermissionTo('service-provider.access')) {
               
                $this->listForFields['category'] = ServiceCategory::whereIn('slug', ['emergency-medical-care', 'home-nursing'])->orderBy('name')->get();
            }
    
            // Set the default category if available
            if (!empty($this->listForFields['category'])) {
                $this->service->service_category_id = $this->listForFields['category'][0]['id'];
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
        $this->service->image = Helper::store($this->image, "service-provider/service", \Str::random(20) . "-" . Carbon::now()->timestamp, $this->image_config);
        $this->categoryName = $this->service->category->name;
        $this->subcategoryName = $this->service->subcategory->name;
        $this->districtName = $this->service->district->name;
        $this->cityName = $this->service->city->name;
        $this->service->user_id = Auth::user()->id;
        $this->service->save();
        $this->emit('memberServiceAdded', ["service" => $this->service, "categoryName" => $this->categoryName, "subcategoryName" => $this->subcategoryName, "districtName" => $this->districtName, "cityName" => $this->cityName]);
        $this->image = null;
        $this->service = new Service();
        session()->flash('message', 'Service has been created successfully!');
    }

    public function render()
    {
        return view('livewire.member.service.create');
    }
}
