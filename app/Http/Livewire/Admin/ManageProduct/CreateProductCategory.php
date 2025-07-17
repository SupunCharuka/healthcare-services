<?php

namespace App\Http\Livewire\Admin\ManageProduct;

use App\Models\Helper;
use App\Models\ProductCategory;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Storage;

class CreateProductCategory extends Component
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
            'product.name' => ['required', 'unique:product_categories,name'],
            'product.description' => ['required', 'string'],
            'image' => ['required', 'base64image'],
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
        $this->product->image = Helper::store($this->image, "admin/product-category", \Str::random(20) . "-" . Carbon::now()->timestamp, $this->image_config);
        $this->product->save();
        $this->emit('productCategoryAdded', ["product" => $this->product]);
        $this->image = null;
        $this->product = new ProductCategory();

        session()->flash('message', 'Product has been created successfully!');
    }

    public function mount(ProductCategory $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.admin.manage-product.create-product-category');
    }
}
