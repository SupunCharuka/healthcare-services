<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Helper;
use App\Models\MediaCenter;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;
use DB;
use Exception;
use Illuminate\Support\Facades\Gate;
use Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product.create'), ResponseAlias::HTTP_FORBIDDEN);
        $products = Product::all();
        return view('backend.admin.product.index', compact('products'));
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product.update'), ResponseAlias::HTTP_FORBIDDEN);
        return view('backend.admin.product.edit', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product.delete'), ResponseAlias::HTTP_FORBIDDEN);
        if (!$product) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Product not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        // Retrieve the product's associated product images
        $productImages = $product->productImages;

        // Delete each product image individually
        foreach ($productImages as $productImage) {
            // Delete the image file from storage
            Storage::delete([
                'uploads/admin/product-images/' . $productImage->images,
                'uploads/admin/product-images/thumb/' . $productImage->images
            ]);
            // Delete the product image record from the database
            $productImage->delete();
        }

        // Delete the product itself
        $product->delete();

        $json['status'] = 'deleted';
        $json['message'] = 'Product record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $product;
        return response()->json($json);
    }

    public function store(Request $request)
    {
        try {
            $new_name = Str::random(20) . "-" . Carbon::now()->timestamp;
            $file_name = Helper::store($request->get('file'), "admin/media-center", $new_name, [
                'image_resize' => true,
                'image_ratio_crop' => 'C',
                'image_x' => 900,
                'image_y' => 900,
            ]);
            Helper::store($request->get('file'), "admin/media-center/thumb", $new_name, [
                'image_resize' => true,
                'image_ratio_crop' => 'C',
                'image_x' => 350,
                'image_y' => 350,
            ]);

            $media_center = DB::transaction(static function () use ($file_name) {
                $media_center = MediaCenter::create([
                    'file_name' => $file_name,
                ]);
                if (empty($media_center->file_name)) {
                    throw new \RuntimeException("could not create media center file");
                }
                return $media_center;
            });

            return response()->json($media_center, ResponseAlias::HTTP_OK);
        } catch (Exception $e) {
            $json['type'] = 'error';
            $json['status'] = 'error';
            $json['message'] = 'Could not create media center file!';
            return response()->json($json, ResponseAlias::HTTP_NOT_ACCEPTABLE);
        }
    }
}
