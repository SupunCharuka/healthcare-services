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
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Intervention\Image\Facades\Image;



class Edit extends Component
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
            'product.name' => ['required', 'string', 'max:255', Rule::unique('products', 'name')->ignore($this->product->id, 'id')],
            'product.product_category_id' => ['required', 'integer'],
            'product.product_subcategory_id' => ['required', 'integer'],
            'product.description' => ['required'],
            'images' => ['required', 'array', "min:1"],
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
        if (isset($this->variations[$index]['id'])) {
            $variationId = $this->variations[$index]['id'];

            // Delete the variation from the database
            ProductVariation::destroy($variationId);
        }

        unset($this->variations[$index]);
        $this->variations = array_values($this->variations);
    }

    public function unsetMediaCenter($media_center_id)
    {
        unset($this->images[$media_center_id]);
        $this->emit('imageRemoved', $media_center_id);


        // Check if the image is new or old
        $existingImage = MediaCenter::find($media_center_id);

        if ($existingImage) {
            // Existing image: Delete it from storage and the database
            Storage::delete([
                'uploads/admin/media-center/' . $existingImage->file_name,
                'uploads/admin/media-center/thumb/' . $existingImage->file_name
            ]);
            $existingImage->delete();
        } else {
            $uploadedImaged =  ProductImage::find($media_center_id);
            Storage::delete([
                'uploads/admin/product-images/' .  $uploadedImaged->images,
                'uploads/admin/product-images/thumb/' .  $uploadedImaged->images,
                'uploads/admin/media-center/' . $uploadedImaged->images,
                'uploads/admin/media-center/thumb/' . $uploadedImaged->images,

            ]);
            $uploadedImaged->delete();
        }
    }

    public function updatingProductProductCategoryId($category)
    {

        $this->product->product_subcategory_id = null;
        $this->listForFields['subcategory'] = ProductSubCategory::where('product_category_id', $category)->orderBy('name')->get();
    }


    public function mount($product)
    {
        $this->product = $product;
        foreach ($this->product->productImages as $image) {
            $this->images[$image->id] = ["images" => $image->images];
        }
        $this->variations = $product->productVariations->toArray();
        $this->listForFields['category'] = ProductCategory::orderBy('name')->get();
        $this->listForFields['subcategory'] = ProductSubCategory::where('product_category_id', $this->product->product_category_id)->orderBy('name')->get();
    }


    public function save()
    {
        $this->validate();

        $this->product->save();

        // Save the variations
        foreach ($this->variations as $index => $variation) {
            // Check if the variation already exists in the database
            if (isset($variation['id'])) {
                $productVariation = $this->product->productVariations()->where('id', $variation['id'])->first();
            } else {
                $productVariation = new ProductVariation();
                $productVariation->product_id = $this->product->id;
            }

            // Update the variation's attributes
            $productVariation->name = $variation['name'];
            $productVariation->price = $variation['price'];
            $productVariation->quantity = $variation['quantity'];
            $productVariation->discount = $variation['discount'];

            // Save the variation
            $productVariation->save();
        }

        // $this->product->productImages()->delete();
        // Add the new images
        foreach ($this->images as $image) {
            if (isset($image['file_name'])) { // Check if the 'file_name' key exists
                $photos = new ProductImage();
                $photos->product()->associate($this->product);
                $photos->images = $image['file_name'];
                $photos->save();
                storage_copy('uploads/admin/media-center/' . $photos->images, 'uploads/admin/product-images/' . $photos->images);
                storage_copy('uploads/admin/media-center/thumb/' . $photos->images, 'uploads/admin/product-images/thumb/' . $photos->images);
            }
        }





        session()->flash('message', 'Product has been updated successfully!');
        return redirect()->route('admin.product.edit', $this->product);
    }



    public function render()
    {
        return view('livewire.admin.product.edit')->with('errors', $this->getErrorBag());
    }
}
