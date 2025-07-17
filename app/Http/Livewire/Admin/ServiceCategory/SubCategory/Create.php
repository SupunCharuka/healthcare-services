<?php

namespace App\Http\Livewire\Admin\ServiceCategory\SubCategory;

use App\Models\ServiceCategory;
use App\Models\SubCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public ServiceCategory $category;
    public SubCategory $subcategory;


    protected function rules()
    {
        return [
            'subcategory.name' => ['required', Rule::unique('sub_categories', 'name')->where('service_category_id', $this->category->id ?? null)],
            'subcategory.name_si' => ['nullable', Rule::unique('sub_categories', 'name_si')->where('service_category_id', $this->category->id ?? null)],
        ];
    }
    protected $validationAttributes = [
        'subcategory.name' => 'subcategory name',
        'subcategory.name_si' => 'subcategory sinhala name',

    ];
    protected $messages = [
        'subcategory.name.unique' => 'You have already added this subcategory!',
        'subcategory.name_si.unique' => 'You have already added this Subcategory!',
    ];


    public function updated()
    {
        $this->validate();
    }
    public function save()
    {
        $this->validate();
        $this->subcategory->service_category_id=$this->category->id;
        $this->subcategory->save();
        $this->emit('subcategoryAdded', ["subcategory" => $this->subcategory]);
        $this->subcategory= new SubCategory();
        session()->flash('message', 'Subcategory has been created successfully!');
    }
    public function mount($category)
    {
        $this->category = $category;
        $this->subcategory = new SubCategory();

    }

    public function render()
    {
        return view('livewire.admin.service-category.sub-category.create');
    }
}
