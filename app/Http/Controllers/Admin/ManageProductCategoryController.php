<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ManageProductCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product-category.view'), Response::HTTP_FORBIDDEN);
        $manageProductsCategories = ProductCategory::all();
        return view('backend.admin.manage-product.index', compact('manageProductsCategories'));
    }

    public function edit(ProductCategory $product)
    {
        return view('backend.admin.manage-product.edit', compact('product'));
    }

    public function destroy(ProductCategory $productCategory)
    {
        if (!$productCategory) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Product not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $productCategory->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'Product Category record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $productCategory;
        return response()->json($json);
    }

    public function subCategory(ProductCategory $productcategory)
    {

        $subcategories = $productcategory->productSubCategories ?? '';
        return view('backend.admin.manage-product.product-sub-category.index', compact('productcategory', 'subcategories'));
    }

    public function subCategoryEdit(ProductSubCategory $subcategory)
    {
        $subcategory->load('productCategory');
        return view('backend.admin.manage-product.product-sub-category.edit', compact('subcategory'));
    }

    public function subCategoryDestroy(ProductSubCategory $subcategory)
    {
        if (!$subcategory) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Product not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $subcategory->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'Product Category record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $subcategory;
        return response()->json($json);
    }
}
