<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\Helper;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;


class Edit extends Component
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
            'blog.title' => ['required', Rule::unique('blogs', 'title')->ignore($this->blog->id, 'id')],
            'blog.short_description' => ['required', 'max:250'],
            'blog.description' => ['required'],
            'image' => [Rule::requiredIf(empty($this->blog->image)), 'base64image'],
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
        if (!empty($this->image)) {
            $image_name = \Str::random(20) . "-" . Carbon::now()->timestamp;
            $this->blog->image = Helper::store($this->image, "admin/blog", $image_name,$this->image_config);
            Storage::delete('uploads/admin/blog/' . $this->blog->getOriginal('image'));
        }
        $this->blog->save();
        session()->flash('message', 'Blog has been updated successfully!');
        return redirect()->route('admin.blog');
    }

    public function mount(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function render()
    {
        return view('livewire.admin.blog.edit');
    }
}
