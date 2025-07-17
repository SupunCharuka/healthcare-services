<?php

namespace App\Http\Livewire\Admin\ServiceCategory;

use App\Models\Helper;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateServiceCategory extends Component
{

    use WithFileUploads;

    public ServiceCategory $category;
    public $image;

    protected $listeners = ['setsImage'];

    protected $image_config = [
        'image_resize' => true,
        'image_ratio_y' => true,
        'image_ratio_crop' => 'C',
        'image_x' => 330,
    ];

    protected function rules()
    {
        return [
            'category.name' => ['required', 'unique:service_categories,name'],
            'category.caption' => ['required'],
            'category.video_id' => ['nullable', 'url'],
            'category.video_id_si' => ['nullable', 'url'],
            'category.description' => ['required'],
            'category.commission' => ['nullable', 'numeric', 'gte:0', 'lte:100', 'min:0', 'max:100'],
            'image' => ['required', 'base64image'],
        ];
    }

    protected $validationAttributes = [
        'category.name' => 'category name',
        'category.caption' => 'category caption',
        'category.video_id' => 'category video',
        'category.video_id_si' => 'category sinhala video',
        'category.description' => 'category description',
        'category.commission' => 'category commission',
        'image' => 'category image',
    ];

    protected $messages = [
        'category.name.unique' => 'You have already added this category!',
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

    public function save()
    {
        $this->validate();
        $maxLocalOrder = ServiceCategory::max('local_order');
        $maxForeignOrder = ServiceCategory::max('foreign_order');
        $this->category->local_order = $maxLocalOrder + 1;
        $this->category->foreign_order = $maxForeignOrder + 1;
        $this->category->image = Helper::store($this->image, "admin/service-category", \Str::random(20) . "-" . Carbon::now()->timestamp, $this->image_config);
        if (empty($this->category->video_id)) {
            $this->category->video_id = null;
        } else {
            $this->category->video_id = $this->extractVideoId($this->category->video_id);
        }
        if (empty($this->category->video_id_si)) {
            $this->category->video_id_si = null;
        } else {
            $this->category->video_id_si = $this->extractVideoId($this->category->video_id_si);
        }
        $this->category->save();
        $this->emit('categoryAdded', ["category" => $this->category]);
        $this->image = null;
        $this->category = new ServiceCategory();

        session()->flash('message', 'Category has been created successfully!');
    }

    private function extractVideoId($url): string|null
    {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=|.*[?&]si=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $video_id)) {
            return $video_id[1];
        }

        return null;
    }

    public function mount(ServiceCategory $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.admin.service-category.create-service-category');
    }
}
