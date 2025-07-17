<?php

namespace App\Http\Livewire\Admin\ServiceCategory;

use App\Models\Helper;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;


class EditServiceCategory extends Component
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
            'category.name' => ['required', Rule::unique('service_categories', 'name')->ignore($this->category->id, 'id')],
            'category.caption' => ['required'],
            'category.video_id' => ['nullable', 'url'],
            'category.video_id_si' => ['nullable', 'url'],
            'category.description' => ['required'],
            'category.commission' => ['nullable', 'numeric', 'gte:0', 'lte:100', 'min:0', 'max:100'],
            'image' => [Rule::requiredIf(empty($this->category->image)), 'base64image'],
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

    public function setsImage($image)
    {
        $this->image = $image;
        $this->validate();
    }

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        if (!empty($this->image)) {
            $image_name = Helper::store($this->image, "admin/service-category", \Str::random(20) . "-" . Carbon::now()->timestamp, $this->image_config);
            Storage::delete('uploads/admin/service-category/' . $this->category->image);
            $this->category->image = $image_name;
        }

        $videoId = $this->extractVideoId($this->category->video_id);
        $this->category->video_id = $videoId;

        $videoIdSi = $this->extractVideoId($this->category->video_id_si);
        $this->category->video_id_si = $videoIdSi;

        $this->category->save();
        $this->category->video_id = 'https://www.youtube.com/watch?v=' . $this->category->video_id;
        $this->category->video_id_si = 'https://www.youtube.com/watch?v=' . $this->category->video_id_si;
        session()->flash('message', 'Category has been updated successfully!');
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

        if (!empty($this->category->video_id)) {
            $this->category->video_id = 'https://www.youtube.com/watch?v=' . $this->category->video_id;
        }
        if (!empty($this->category->video_id_si)) {
            $this->category->video_id_si = 'https://www.youtube.com/watch?v=' . $this->category->video_id_si;
        }
    }

    public function render()
    {
        return view('livewire.admin.service-category.edit-service-category');
    }
}
