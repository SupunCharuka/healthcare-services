<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class OnlineShoppingController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search-field');

        if ($searchTerm) {
            $products = Product::where('name', 'like', '%' . $searchTerm . '%')->paginate(12);
        } else {
            $products = Product::paginate(12);
        }
        $productCategories = ProductCategory::all();
        return view('frontend.product-view.index', compact('products', 'productCategories'));
    }

    public function subCategory(Request $request, ProductCategory $product)
    {
        $searchTerm = $request->input('search-field');

        if ($searchTerm) {
            $products = Product::where('product_category_id', $product->id)->where('name', 'like', '%' . $searchTerm . '%')->paginate(12);
        } else {
            $products = Product::where('product_category_id', $product->id)->paginate(12);
        }
        $productSubCategories = ProductSubCategory::where('product_category_id', $product->id)->get();


        return view('frontend.product-view.sub-category.index', compact('productSubCategories', 'product', 'products'));
    }

    public function viewSub(Request $request, ProductSubCategory $category)
    {
        $searchTerm = $request->input('search-field');

        if ($searchTerm) {
            $products = Product::where('product_subcategory_id', $category->id)->where('name', 'like', '%' . $searchTerm . '%')->paginate(12);
        } else {
            $products = Product::where('product_subcategory_id', $category->id)->paginate(12);
        }
        $productSubCategories = ProductSubCategory::where('product_category_id', $category->productCategory->id)->get();


        return view('frontend.product-view.sub-category.view', compact('productSubCategories', 'category', 'products'));
    }

    public function viewProduct(Product $product)
    {
        $stock = $product->productVariations?->first();

        return view('frontend.product-view.product', compact('product', 'stock'));
    }

    public function viewCart()
    {
        return view('frontend.cart.index');
    }
}
