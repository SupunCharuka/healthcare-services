<?php

namespace App\Http\Livewire\Admin\Testimonial;

use App\Models\Helper;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $image;
    protected $listeners = ['setsImage'];
    public Testimonial $testimonial;

    protected $image_config = [
        'image_resize' => true,
        'image_ratio_crop' => 'C',
        'image_x' => 500,
        'image_y' => 500,
    ];


    protected function rules()
    {
        return [
            'testimonial.name' => ['required'],
            'testimonial.title' => ['required'],
            'testimonial.country' => ['required'],
            'image' => [Rule::requiredIf(empty($this->testimonial->image)), 'base64image'],
            'testimonial.description' => ['required'],
            'testimonial.is_active' => ['nullable', 'boolean'],
        ];
    }

    protected $validationAttributes = [
        'testimonial.title' => 'title',
        'testimonial.description' => 'description',
        'testimonial.name' => 'name',
        'testimonial.country' => 'country',
        'image' => 'image',
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

    public function mount(Testimonial $testimonial)
    {
        $this->testimonial = $testimonial;
    }

    public function save()
    {
        $this->validate();
        if (!empty($this->image)) {
            $image_name = \Str::random(20) . "-" . Carbon::now()->timestamp;
            $this->testimonial->image = Helper::store($this->image, "testimonial/", $image_name, $this->image_config);
            Storage::delete('uploads/testimonial/' . $this->testimonial->getOriginal('image'));
        }
        $this->testimonial->save();
        session()->flash('message', 'Testimonial updated successfully!');
        return redirect()->route('admin.testimonials.manage');
    }


    public function render()
    {
        return view('livewire.admin.testimonial.edit');
    }
}
