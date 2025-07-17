<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\Helper;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public Blog $blog;
    public $image;

    protected $listeners = ['setsImage'];

    protected $image_config = [
        'image_resize' => true,
        'image_ratio_y' => true,
        'image_ratio_crop' => 'C',
        'image_x' => 1170,
    ];

    protected function rules()
    {
        return [
            'blog.title' => ['required', 'unique:blogs,title'],
            'blog.short_description' => ['required', 'max:250'],
            'blog.description' => ['required'],
            'image' => ['required', 'base64image'],
        ];
    }

    protected $validationAttributes = [
        'blog.title' => 'title',
        'blog.short_description' => 'short description',
        'blog.description' => 'description',
        'image' => 'image',
    ];


    protected $messages = [
        'blog.title.unique' => 'You have already added this title!',
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
        $this->blog->image = Helper::store($this->image, "admin/blog", \Str::random(20) . "-" . Carbon::now()->timestamp, $this->image_config);
        $this->blog->save();
        session()->flash('message', 'Blog has been created successfully!');
        return redirect()->route('admin.blog');
    }

    public function mount(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function render()
    {
        return view('livewire.admin.blog.create');
    }
}
