<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Banner;
use App\Models\Helper;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;


class Edit extends Component
{
    use WithFileUploads;
    public $image;
    public $mobile_image;
    protected $listeners = ['setsImage','setsMobileImage'];
    public Banner $banner;

  
    protected function rules()
    {
        return [
            'banner.title' => ['required'],
            'banner.link_to' => ['nullable'],
            'image' => [Rule::requiredIf(empty($this->banner->image)), 'base64image'],
            'mobile_image' => [Rule::requiredIf(empty($this->banner->mobile_image)), 'base64image'],
            'banner.is_active' => ['nullable', 'boolean'],
        ];
    }

    protected $validationAttributes = [
        'banner.title' => 'title',
        'image' => 'desktop image',
        'mobile_image' => 'mobile image',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function setsImage($image)
    {
        $this->image = $image;
        $this->validate();
    }

       public function setsMobileImage($mobile_image)
    {
        $this->mobile_image = $mobile_image;
        $this->validate();
    }


    public function mount(Banner $banner)
    {
        $this->banner = $banner;
    }

    public function save()
    {
        $this->validate();
        if (!empty($this->image)) {
            $image_name = \Str::random(20) . "-" . Carbon::now()->timestamp;
            $this->banner->image = Helper::store($this->image, "banners/", $image_name);
            Storage::delete('uploads/banners/' . $this->banner->getOriginal('image'));
        }
        if (!empty($this->mobile_image)) {
            $image_name = \Str::random(20) . "-" . Carbon::now()->timestamp;
            $this->banner->mobile_image = Helper::store($this->mobile_image, "banners/mobile-image/", $image_name);
            Storage::delete('uploads/banners/mobile-image/' . $this->banner->getOriginal('mobile_image'));
        }


        $this->banner->link_to = $this->banner->link_to ?? '#';
        $this->banner->save();

        session()->flash('message', 'Banner updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.banner.edit');
    }
}
