<?php

namespace App\Http\Livewire\Admin\ManageProduct\ProductSubCategory;

use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public ProductCategory $product;
    public ProductSubCategory $subcategory;

    protected function rules()
    {
        return [
            'subcategory.name' => ['required', Rule::unique('product_sub_categories', 'name')->where('product_category_id',$this->subcategory->product_category_id ?? null)->ignore($this->subcategory->id, 'id')],
        ];
    }
    protected $validationAttributes = [
        'subcategory.name' => 'name',
    ];
    protected $messages = [
        'subcategory.name.unique' => 'You have already added this name!',
    ];
    public function updated()
    {
        $this->validate();
    }
    public function save()
    {
        $this->validate();
        $this->subcategory->save();
        session()->flash('message', 'Updated successfully!');
    }
    public function mount($subcategory)
    {
        $this->subcategory = $subcategory;
        $this->product = new ProductCategory();
    }
    public function render()
    {
        return view('livewire.admin.manage-product.product-sub-category.edit');
    }
}
