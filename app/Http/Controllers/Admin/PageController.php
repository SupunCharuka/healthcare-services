<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Storage;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies(['page.manage', 'page.create']), Response::HTTP_FORBIDDEN);
        $pages = Page::all();
        return view('backend.admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        abort_if(Gate::denies(['page.manage', 'page.update']), Response::HTTP_FORBIDDEN);
        return view('backend.admin.pages.edit', compact('page'));
    }

    public function destroy(Page $page)
    {
        abort_if(Gate::denies(['page.manage', 'page.delete']), Response::HTTP_FORBIDDEN);
        $role = Auth::user()->getRoleNames()->first();

        if ($role != 'admin') {
            $json['status'] = 'error';
            $json['code'] = '403';
            $json['message'] = 'Access denied';
            $json['icon'] = 'error';
            return response()->json($json, 403);
        }
        if (!$page) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'page not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }

        $page->delete();
        Storage::delete('uploads/pages/' . $page->image);
        $json['status'] = 'deleted';
        $json['message'] = 'Page record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $page;
        return response()->json($json);
    }
}
