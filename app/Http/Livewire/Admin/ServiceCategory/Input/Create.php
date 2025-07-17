<?php

namespace App\Http\Livewire\Admin\ServiceCategory\Input;

use App\Models\Input;
use App\Models\ServiceCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public ServiceCategory $category;
    public Input $input;
    public $slug;
    public $categoryName;

    protected function rules()
    {
        return [
            "input.name" => 'required',
            "input.type" => 'required',
            "input.placeholder" => 'required',
            "input.option" => 'nullable',
            "input.required" => 'required',
            "input.option" => 'required_if:input.type,select',
            "slug" => ['nullable', Rule::unique('inputs', 'slug')->where('service_category_id', $this->category->id)],
        ];
    }

    protected $validationAttributes = [
        'input.name' => 'input name',
        'input.type' => 'input type',
        'input.placeholder' => 'input placeholder',
        'input.required' => 'input required',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        $slug = Str::slug($this->input->name);

        // Find the last post with the same slug
        $lastSlugPost = Input::where('slug', 'like', "{$slug}%")
            ->where('service_category_id', $this->category->id)
            ->latest('id')
            ->first();

        if ($lastSlugPost) {
            // If a post with the same slug exists, increment the number at the end
            $slug = "{$slug}-" . (intval(Str::afterLast($lastSlugPost->slug, '-')) + 1);
        }

        $this->input->service_category_id = $this->category->id;
        $this->input->slug = $slug;
        $this->input->save();
        $this->categoryName = $this->input->serviceCategory->name;
        $this->emit('inputAdded', ["input" => $this->input, "categoryName" => $this->categoryName]);
        $this->input = new Input();
        session()->flash('message', 'Input field has been created successfully!');
    }

    public function render()
    {
        return view('livewire.admin.service-category.input.create');
    }

    public function mount($category)
    {
        $this->category = $category;
        $this->input = new Input();
    }
}
