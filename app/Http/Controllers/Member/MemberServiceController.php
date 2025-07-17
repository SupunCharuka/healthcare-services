<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Storage;

class MemberServiceController extends Controller
{
    public function index()
    {
        $this->authorize('create', Service::class);

        $services = Service::where('user_id', Auth::user()->id)->get();
        return view('backend.service-provider.service.index', compact('services'));
    }

    public function edit(Service $service)
    {
         $this->authorize('update', $service);

        return view('backend.service-provider.service.edit', compact('service'));
    }


    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);
        if (!$service) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Service not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $service->delete();
        Storage::delete('uploads/member/service/' . $service->image);
        $json['status'] = 'deleted';
        $json['message'] = 'Service record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $service;
        return response()->json($json);
    }
}
