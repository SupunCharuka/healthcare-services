<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Storage;
use Symfony\Component\HttpFoundation\Response;

class BannerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies(['banner.manage', 'banner.create']), Response::HTTP_FORBIDDEN);
        $banners = Banner::where('is_active', 1)->get();
        return view('backend.admin.banners.index', compact('banners'));
    }

    public function edit(Banner $banner)
    {
        abort_if(Gate::denies(['banner.manage', 'banner.update']), Response::HTTP_FORBIDDEN);
        return view('backend.admin.banners.edit', compact('banner'));
    }

    public function destroy(Banner $banner)
    {
        abort_if(Gate::denies(['banner.manage', 'banner.delete']), Response::HTTP_FORBIDDEN);
        if (!$banner) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'banner name not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }

        $banner->delete();
        Storage::delete('uploads/banners/' . $banner->image);
        $json['status'] = 'deleted';
        $json['message'] = 'Banner record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $banner;
        return response()->json($json);
    }

    public function localSort(Banner $banner)
    {
        $banners = $banner->where('is_active', 1)->orderBy('local_order', 'asc')->get();
        return view('backend.admin.banners.arrange-local', compact('banners', 'banner'));
    }

    public function updateLocalOrder($banner, Request $request)
    {
        if ($request->has('ids')) {
            foreach ($request->ids as $sortOrder => $id) {
                $banners = Banner::find($id);
                $banners->update([
                    "local_order" => $sortOrder
                ]);
            }
            return ['success' => true, 'message' => 'Updated', "type" => 'success'];
        }
        return response()->json(['status' => false, 'message' => 'Something went wrong', "type" => 'danger']);
    }

    public function foreignSort(Banner $banner)
    {
        $banners = $banner->where('is_active', 1)->orderBy('foreign_order', 'asc')->get();
        return view('backend.admin.banners.arrange-foreign', compact('banners', 'banner'));
    }

    public function updateForeignOrder($banner, Request $request)
    {
        if ($request->has('ids')) {
            foreach ($request->ids as $sortOrder => $id) {
                $banners = Banner::find($id);
                $banners->update([
                    "foreign_order" => $sortOrder
                ]);
            }
            return ['success' => true, 'message' => 'Updated', "type" => 'success'];
        }
        return response()->json(['status' => false, 'message' => 'Something went wrong', "type" => 'danger']);
    }
}
