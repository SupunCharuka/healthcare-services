<?php

namespace App\Http\Livewire\Admin\ServiceCategory\SubCategory;

use App\Models\ServiceCategory;
use App\Models\SubCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public ServiceCategory $category;
    public SubCategory $subcategory;

    protected function rules()
    {
        return [
            'subcategory.name' => ['required', Rule::unique('sub_categories', 'name')->where('service_category_id',$this->subcategory->service_category_id ?? null)->ignore($this->subcategory->id, 'id')],
            'subcategory.name_si' => ['nullable', Rule::unique('sub_categories', 'name_si')->where('service_category_id',$this->subcategory->service_category_id ?? null)->ignore($this->subcategory->id, 'id')],
        ];
    }
    protected $validationAttributes = [
        'subcategory.name' => 'Subcategory name',
        'subcategory.name_si' => 'Subcategory sinhala name',
    ];
    protected $messages = [
        'subcategory.name.unique' => 'You have already added this Subcategory!',
        'subcategory.name_si.unique' => 'You have already added this Subcategory!',
    ];
    public function updated()
    {
        $this->validate();
    }
    public function save()
    {
        $this->validate();
        $this->subcategory->save();
        session()->flash('message', 'Category has been updated successfully!');
    }
    public function mount($subcategory)
    {
        $this->subcategory = $subcategory;
        $this->category = new ServiceCategory();
    }
    public function render()
    {
        return view('livewire.admin.service-category.sub-category.edit');
    }
}
