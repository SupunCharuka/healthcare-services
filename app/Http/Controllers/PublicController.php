<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Inquiry;
use App\Models\InquiryConversation;
use App\Models\Invoice;
use App\Models\MemberRegister;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Page;
use App\Models\Product;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $serviceCategories = ServiceCategory::orderBy('local_order', 'asc')->get();
        $banners = Banner::where('is_active', 1)->orderBy('local_order', 'asc')->get();
        return view('frontend.index', compact('serviceCategories', 'banners'));
    }

    public function links(Request $request)
    {
        $testimonials = Testimonial::where('is_active', true)->get();
        return view('frontend.links', compact('testimonials'));
    }

    public function foreignPage(Request $request)
    {
        $visitorType = $request->query('visitor_type');
        if ($visitorType !== 'foreign') {
            abort(403, 'Unauthorized');
        }

        $serviceCategories = ServiceCategory::orderBy('foreign_order', 'asc')->get();
        $banners = Banner::where('is_active', 1)->orderBy('foreign_order', 'asc')->get();

        return view('frontend.index-foreign', compact('serviceCategories', 'banners'));
    }

    public function register()
    {
        return view('auth.register');
    }


    public function serviceProviderRegister()
    {
        return view('auth.member-register');
    }

    public function superAdmin()
    {
        return view('backend.super-admin.dashboard');
    }

    public function admin()
    {
        $doctorTotal = MemberRegister::where('status', 1)->whereHas('user', function ($query) {
            $query->where('member_type', 'doctor');
        })->count();

        $pendingDoctorTotal = MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'doctor');
        })->where('status', 0)->count();

        $serviceProviderTotal = MemberRegister::where('status', 1)->whereHas('user', function ($query) {
            $query->where('member_type', 'service-provider');
        })->count();

        $pendingServiceProviderTotal = MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'service-provider');
        })->where('status', 0)->count();

        $inquiryTotal = Inquiry::all()->count();

        $orderTotal = Order::all()->count();

        $productTotal = Product::all()->count();

        $total_sales = OrderItem::whereRelation('order', fn ($query) => $query->where('status', 1))->count();

        $saleProductCount = Product::whereHas('orderItems', function ($query) {
            $query->whereHas('order', function ($query) {
                $query->where('status', '=', 1);
            });
        })->count();

        $serviceTotal = Service::all()->count();

        return view('backend.admin.dashboard', compact('doctorTotal', 'serviceProviderTotal', 'inquiryTotal', 'orderTotal', 'productTotal', 'total_sales', 'saleProductCount', 'serviceTotal', 'pendingDoctorTotal', 'pendingServiceProviderTotal'));
    }

    public function serviceProvider(Request $request)
    {

        $todayBookings = Inquiry::whereRelation('service', 'user_id', Auth::user()->id)
            ->whereDate('appointment_datetime', Carbon::today()->format('Y-m-d'))
            ->count();
        $allBookings = Inquiry::whereRelation('service', 'user_id', Auth::user()->id)->count();
        $todayPayouts = Invoice::whereRelation('inquiry.service', 'user_id', Auth::user()->id)
            ->whereDate('created_at', Carbon::today()->format('Y-m-d'))
            ->wherePaid(1)
            ->count();
        $latestPayouts = Invoice::whereRelation('inquiry.service', 'user_id', Auth::user()->id)
            ->wherePaid(1)
            ->count();
        $messages = InquiryConversation::where('receiver_id', Auth::user()->id)
            ->where('status', '<>', 'seen')
            ->count();
        $services = Service::where('user_id', $request->user()->id)
            ->count();


        return view('backend.service-provider.dashboard', compact('todayBookings', 'allBookings', 'todayPayouts', 'latestPayouts', 'messages', 'services'));
    }


    public function customer()
    {
        $user = Auth::user()->id;
        $myInquiryCount = Inquiry::where('user_id', $user)->count();
        $myInvoiceCount = Invoice::whereHas('inquiry', function ($query) use ($user) {
            $query->where('user_id', $user);
        })->count();

        $myReviewCount = Review::whereHas('inquiry', function ($query) use ($user) {
            $query->where('user_id', $user);
        })->count();

        $myOrderCount = Order::where('user_id', $user)->count();

        $serviceCategories = ServiceCategory::orderBy('local_order', 'asc')->get();

        return view('backend.customer.dashboard', compact('myInquiryCount', 'myReviewCount', 'myOrderCount', 'serviceCategories', 'myInvoiceCount'));
    }

    public function inquiry(ServiceCategory $servicecategory)
    {
        return view('frontend.inquiry.index', compact('servicecategory'));
    }

    public function aboutUs()
    {

        $abouts = Page::where('slug', 'about-us')->first();

        return view('frontend.about-us', compact('abouts'));
    }

    public function contactUs()
    {
        $contactUs = Page::where('slug', 'contact-us')->first();
        return view('frontend.contact-us', compact('contactUs'));
    }

    public function services()
    {
        $serviceCategories = ServiceCategory::orderBy('local_order', 'asc')->get();
        return view('frontend.services', compact('serviceCategories'));
    }

    public function userGuide()
    {
        return view('frontend.user-guide');
    }
}
