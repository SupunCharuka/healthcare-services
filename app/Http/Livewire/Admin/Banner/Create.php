<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Banner;
use App\Models\Helper;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
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
            'image' => ['required', 'base64image'],
            'mobile_image' => ['required', 'base64image'],
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

    public function mount()
    {
        $this->banner = new Banner;
    }

    public function save()
    {
        $this->validate();
        $maxLocalOrder = Banner::max('local_order');
        $maxForeignOrder = Banner::max('foreign_order');
        $this->banner->local_order = $maxLocalOrder + 1;
        $this->banner->foreign_order = $maxForeignOrder + 1;

        $image_name = \Str::random(20) . "-" . Carbon::now()->timestamp;
        $this->banner->image = Helper::store($this->image, "banners/", $image_name);
        $this->banner->mobile_image = Helper::store($this->mobile_image, "banners/mobile-image/", $image_name);
        $this->banner->link_to = $this->banner->link_to ?? '#';
        $this->banner->save();
        $this->emit('bannerAdded', ["banner" => $this->banner]);
        $this->image = null;
        $this->banner = new Banner();
        session()->flash('message', 'Banner created successfully!');
    }

    public function render()
    {
        return view('livewire.admin.banner.create');
    }
}
