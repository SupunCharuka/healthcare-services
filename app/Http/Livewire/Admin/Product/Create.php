<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Helper;
use App\Models\MediaCenter;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductSubCategory;
use App\Models\ProductVariation;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class Create extends Component
{

    use WithFileUploads;

    public array $images = [];
    public Product $product;
    public array $listForFields = [];
    protected $listeners = ['unsetMediaCenter'];
    public $variations = [];


    protected function rules()
    {
        return [
            'product.name' => ['required', 'string', 'max:255', 'unique:products,name'],
            'product.product_category_id' => ['required', 'string'],
            'product.product_subcategory_id' => ['required', 'string'],
            'product.description' => ['required'],
            'images' => ['required', 'array', 'min:1'],
            'variations.*.name' => ['required', 'string', 'max:255'],
            'variations.*.price' => ['required', 'numeric', 'min:0'],
            'variations.*.quantity' => ['required', 'numeric', 'min:0'],
            'variations.*.discount' => ['nullable', 'numeric', 'min:0', 'max:100'],

        ];
    }

    protected $validationAttributes = [
        'product.name' => "name",
        'product.product_category_id' => "category",
        'product.product_subcategory_id' => "subcategory",
        'product.description' => "description",
        'variations.*.name' => "name",
        'variations.*.price' => "price",
        'variations.*.quantity' => "quantity",

    ];

    protected $messages = [
        'product.name.unique' => 'You have already added this product!',
        'images.required' => 'Main image is missing. Please upload at least 1 image.',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function unsetMediaCenter($media_center_id)
    {
        unset($this->images[$media_center_id]);
        $this->emit('imageRemoved', $media_center_id);

        // Delete the image from storage or perform any other necessary actions
        $image = MediaCenter::findOrFail($media_center_id);
        Storage::delete([
            'uploads/admin/media-center/' . $image->file_name,
            'uploads/admin/media-center/thumb/' . $image->file_name
        ]);
        $image->delete();
    }

    public function addVariation()
    {
        $this->variations[] = [
            'name' => '',
            'price' => '',
            'quantity' => '',
            'discount' => '',
        ];
    }

    public function removeVariation($index)
    {
        if ($index !== 0) {
            unset($this->variations[$index]);
            $this->variations = array_values($this->variations);
        }
    }

    public function updatingProductProductCategoryId($category)
    {

        $this->product->product_subcategory_id = null;
        $this->listForFields['subcategory'] = ProductSubCategory::where('product_category_id', $category)->orderBy('name')->get();
    }


    public function mount()
    {
        $this->product = new Product();
        $this->listForFields['category'] = ProductCategory::orderBy('name')->get();
        $this->listForFields['subcategory'] = ProductSubCategory::where('product_category_id', $this->product->product_category_id)->orderBy('name')->get();
        $this->variations = [['name' => '', 'price' => '', 'quantity' => '', 'discount' => '']];
    }


    public function save()
    {
        $this->validate();

        $this->product->save();

        // Save the variations
        foreach ($this->variations as $variation) {
            $productVariation = new ProductVariation();
            $productVariation->name = $variation['name'];
            $productVariation->price = $variation['price'];
            $productVariation->quantity = $variation['quantity'];
            $productVariation->discount = $variation['discount'];
            $productVariation->product_id = $this->product->id;
            $productVariation->save();
        }

        // PRODUCT PHOTOS
        foreach ($this->images as $image) {
            $photos = new ProductImage();
            $photos->product()->associate($this->product);
            $photos->images = $image['file_name'];
            $photos->save();
            storage_copy('uploads/admin/media-center/' . $photos->images, 'uploads/admin/product-images/' . $photos->images);
            storage_copy('uploads/admin/media-center/thumb/' . $photos->images, 'uploads/admin/product-images/thumb/' . $photos->images);
        }

        session()->flash('message', 'Product has been created successfully!');
        return redirect()->route('admin.product');
    }


    public function render()
    {
        return view('livewire.admin.product.create');
    }
}
