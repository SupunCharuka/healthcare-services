<div>

    <form wire:submit.prevent="save" class="theme-form" enctype="multipart/form-data">
        @error('images')
            <div class="text-danger mb-3">{{ $message }}</div>
        @enderror

        <div class="row">
            <div class="col-md-12">
                <label class="form-label" for="">Name</label>
                <input wire:model.lazy="product.name" class="form-control" id="name" type="text">
                <div id="preview"></div>
                @error('product.name')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label class="form-label" for="">Product Category</label>
                <select wire:model.lazy="product.product_category_id" class="form-select" id="category"
                    name="category">
                    <option selected="" value="">Choose...</option>
                    @foreach ($listForFields['category'] as $categories)
                        <option value="{{ $categories['id'] }}">{{ $categories['name'] }}</option>
                    @endforeach
                </select>
                @error('product.product_category_id')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="">Product Subcategory</label>
                <select wire:model.lazy="product.product_subcategory_id" class="form-select" id="subcategory"
                    name="subcategory">
                    <option selected="" value="">Choose...</option>
                    @foreach ($listForFields['subcategory'] as $subcategories)
                        <option value="{{ $subcategories['id'] }}">{{ $subcategories['name'] }}</option>
                    @endforeach
                </select>
                @error('product.product_subcategory_id')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Variations -->
        <div class="mt-3">
            <label class="form-label">Variations : </label>
            @foreach ($variations as $index => $variation)
                <div class="row mt-2" wire:key="variation-field-{{ $index }}">

                    <div class="col-md-2">
                        <input wire:model.lazy="variations.{{ $index }}.name" class="form-control" type="text"
                            placeholder="Name">
                        @error('variations.' . $index . '.name')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <input wire:model.lazy="variations.{{ $index }}.price" class="form-control"
                            type="text" placeholder="Price">
                        @error('variations.' . $index . '.price')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <input wire:model.lazy="variations.{{ $index }}.quantity" class="form-control"
                            type="text" placeholder="Quantity">
                        @error('variations.' . $index . '.quantity')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <input wire:model.lazy="variations.{{ $index }}.discount" class="form-control"
                            type="text" placeholder="Discount">
                        @error('variations.' . $index . '.discount')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <button wire:click="removeVariation({{ $index }})" class="btn btn-danger"
                            type="button"><i class="fa fa-times"></i></button>
                    </div>
                </div>
            @endforeach

            <button wire:click="addVariation" class="btn btn-pill btn-success btn-air-info btn-sm mt-3" type="button">Add
                Variation</button>
        </div>

        <div class="row mt-3 mb-4">
            <label class="form-label" for="">Description</label>
            <div class="col-sm-12" wire:ignore>
                <textarea wire:model.lazy="product.description" id="description" class="form-control"></textarea>
            </div>
            @error('product.description')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">Update</button>
    </form>
    <script>
        const PRODUCT = () => @this
    </script>
</div>
