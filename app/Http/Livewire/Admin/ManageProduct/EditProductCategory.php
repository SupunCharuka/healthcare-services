<?php

namespace App\Http\Livewire\Admin\ManageProduct;

use App\Models\Helper;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;


class EditProductCategory extends Component
{
    use WithFileUploads;

    public ProductCategory $product;
    public $image;

    protected $listeners = ['setsImage'];

    protected $image_config = [
        'image_resize' => true,
        'image_ratio_y' => true,
        'image_ratio_crop' => 'C',
        'image_x' => 400,
        'image_y' => 400,
    ];

    protected function rules()
    {
        return [
            'product.name' => ['required', Rule::unique('product_categories', 'name')->ignore($this->product->id, 'id')],
            'product.description' => ['required', 'string'],
            'image' => [Rule::requiredIf(empty($this->product->image)), 'base64image'],
        ];
    }

    protected $validationAttributes = [
        'product.name' => 'name',
        'product.description' => 'description',
        'image' => 'image',
    ];

    protected $messages = [
        'product.name.unique' => 'You have already added this product category!',
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
            $image_name = Helper::store($this->image, "admin/product-category", \Str::random(20) . "-" . Carbon::now()->timestamp, $this->image_config);
            Storage::delete('uploads/admin/product-category/' . $this->product->image);
            $this->product->image = $image_name;
        }
        $this->product->save();
        session()->flash('message', 'Product Category has been updated successfully!');
    }

    public function mount(ProductCategory $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.admin.manage-product.edit-product-category');
    }
}
