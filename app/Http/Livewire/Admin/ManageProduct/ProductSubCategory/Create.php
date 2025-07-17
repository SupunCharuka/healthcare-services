<?php

namespace App\Http\Livewire\Admin\ManageProduct\ProductSubCategory;

use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public ProductCategory $product;
    public ProductSubCategory $subcategory;

    protected function rules()
    {
        return [
            'subcategory.name' => ['required', Rule::unique('product_sub_categories', 'name')->where('product_category_id', $this->product->id ?? null)],
        ];
    }
    protected $validationAttributes = [
        'subcategory.name' => 'name',
    ];
    protected $messages = [
        'subcategory.name.unique' => 'You have already added this subcategory!',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        $this->subcategory->product_category_id=$this->product->id;
        $this->subcategory->save();
        $this->emit('subcategoryAdded', ["subcategory" => $this->subcategory]);
        $this->subcategory= new ProductSubCategory();
        session()->flash('message', 'Subcategory has been created successfully!');
    }
    public function mount($productcategory)
    {
        $this->product = $productcategory;
        $this->subcategory = new ProductSubCategory();

    }
    public function render()
    {
        return view('livewire.admin.manage-product.product-sub-category.create');
    }
}
