<x-backend-layout>
    <x-slot name="styles">
       <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
    </x-slot>
    <x-slot name="breadcrumb_title">
       Edit sub-category
    </x-slot>
    <x-slot name="breadcrumb_items">
       <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
       <li class="breadcrumb-item active"><a href="{{ route('admin.productSubCategory',$subcategory->productCategory->slug) }}">Manage Product Subcategory</a></li>
       <li class="breadcrumb-item active">Edit Product Sub-Category</li>
    </x-slot>
    <div>
       <div class="row">
          <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
             <livewire:admin.manage-product.product-sub-category.edit :subcategory="$subcategory"  />
          </div>
       </div>
    </div>
 </x-backend-layout>
