<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Storage;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::paginate(12);
        return view('frontend.blog.index',compact('blogs'));
    }

    public function blogDetails(Blog $blog)
    {
        $recentPosts = Blog::latest()->take(5)->get();
        return view('frontend.blog.blog-details',compact('blog','recentPosts'));
    }
    
    public function create()
    {
        abort_if(Gate::denies('blog.view'), Response::HTTP_FORBIDDEN);
        $blogs = Blog::all();
        return view('backend.admin.blog.index',compact('blogs'));
    }

    public function edit(Blog $blog)
    {
        abort_if(Gate::denies('blog.view'), Response::HTTP_FORBIDDEN);
        return view('backend.admin.blog.edit', compact('blog'));
    }

    public function destroy(Blog $blog)
    {
        abort_if(Gate::denies('blog.view'), Response::HTTP_FORBIDDEN);
        if (!$blog) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Blog not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $blog->delete();
        Storage::delete('uploads/admin/blog/' . $blog->image);
        $json['status'] = 'deleted';
        $json['message'] = 'Blog record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $blog;
        return response()->json($json);
    }
}
