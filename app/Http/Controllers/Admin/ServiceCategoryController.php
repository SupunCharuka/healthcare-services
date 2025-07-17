<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Input;
use App\Models\ServiceCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies(['service-category.manage', 'service-category.create']), Response::HTTP_FORBIDDEN);

        $serviceCategories = ServiceCategory::all();
        return view('backend.admin.service-category.index', compact('serviceCategories'));
    }

    public function edit(ServiceCategory $category)
    {
        abort_if(Gate::denies(['service-category.manage', 'service-category.update']), Response::HTTP_FORBIDDEN);

        return view('backend.admin.service-category.edit', compact('category'));
    }

    public function destroy(ServiceCategory $category)
    {
        abort_if(Gate::denies(['service-category.manage', 'service-category.delete']), Response::HTTP_FORBIDDEN);

        if (!$category) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Category not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $category->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'Category record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $category;
        return response()->json($json);
    }


    public function subCategory($categoryId)
    {
        abort_if(Gate::denies(['service-category.manage', 'service-category.subcategory']), Response::HTTP_FORBIDDEN);
        $category = ServiceCategory::find($categoryId);
        $subcategories = $category->subCategories ?? '';

        return view('backend.admin.service-category.sub-category.index', compact('subcategories', 'category'));
    }

    public function subCategoryEdit(SubCategory $subcategory)
    {
        $subcategory->load('serviceCategory');
        return view('backend.admin.service-category.sub-category.edit', compact('subcategory'));
    }

    public function subCategoryDestroy(SubCategory $subcategory)
    {

        if (!$subcategory) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Category not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $subcategory->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'Category record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $subcategory;
        return response()->json($json);
    }



    public function input(ServiceCategory $category)
    {
        abort_if(Gate::denies(['service-category.manage', 'service-category.dynamic-input-field']), Response::HTTP_FORBIDDEN);

        $inputs = Input::Where('service_category_id', $category->id)->get();

        return view('backend.admin.service-category.input.index', compact('category', 'inputs'));
    }

    public function inputEdit(Input $input)
    {
        return view('backend.admin.service-category.input.edit', compact('input'));
    }

    public function inputDestroy(Input $input)
    {

        if (!$input) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Category not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $input->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'Category record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $input;
        return response()->json($json);
    }

    public function sort(ServiceCategory $category)
    {
        abort_if(Gate::denies(['service-category.manage', 'service-category.arrange-input-field']), Response::HTTP_FORBIDDEN);

        $categoryInputs = $category->inputs()->orderBy('order', 'asc')->get();
        return view('backend.admin.service-category.input.arrange', compact('categoryInputs', 'category'));
    }

    public function updateOrder($category, Request $request)
    {
        if ($request->has('ids')) {
            foreach ($request->ids as $sortOrder => $id) {
                $inputs = Input::find($id);
                $inputs->update([
                    "order" => $sortOrder
                ]);
            }
            return ['success' => true, 'message' => 'Updated', "type" => 'success'];
        }
        return response()->json(['status' => false, 'message' => 'Something went wrong', "type" => 'danger']);
    }


    
    public function localSort()
    {
        abort_if(Gate::denies('service-category.manage'), Response::HTTP_FORBIDDEN);

        $categories = ServiceCategory::orderBy('local_order', 'asc')->get();
        return view('backend.admin.service-category.local-arrange', compact('categories'));
    }

    public function updateLocalOrder(Request $request)
    {
      
        if ($request->has('ids')) {
            foreach ($request->ids as $sortOrder => $id) {
                $localCategory = ServiceCategory::find($id);
                $localCategory->update([
                    "local_order" => $sortOrder
                ]);
            }
            return ['success' => true, 'message' => 'Updated', "type" => 'success'];
        }
        return response()->json(['status' => false, 'message' => 'Something went wrong', "type" => 'danger']);
    }

    public function foreignSort()
    {
        abort_if(Gate::denies('service-category.manage'), Response::HTTP_FORBIDDEN);

        $categories = ServiceCategory::orderBy('foreign_order', 'asc')->get();
        return view('backend.admin.service-category.foreign-arrange', compact('categories'));
    }

    public function updateForeignOrder(Request $request)
    {
      
        if ($request->has('ids')) {
            foreach ($request->ids as $sortOrder => $id) {
                $foreignCategory = ServiceCategory::find($id);
                $foreignCategory->update([
                    "foreign_order" => $sortOrder
                ]);
            }
            return ['success' => true, 'message' => 'Updated', "type" => 'success'];
        }
        return response()->json(['status' => false, 'message' => 'Something went wrong', "type" => 'danger']);
    }
}
