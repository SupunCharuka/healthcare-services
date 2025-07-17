<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberRegister;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ManageServiceController extends Controller
{

    public function index(Request $request)
    {
        $query = Service::query()->whereHas('user', function ($userQuery) {
            $userQuery->whereNull('deactivated_at');
        });
        if ($request->wantsJson()) {
            return DataTables::eloquent($query)
                ->addColumn('service_provider_name', function (Service $service) {
                    return $service->user->name;
                })
                ->addColumn('service_category_name', function (Service $service) {
                    return $service->category->name;
                })
                ->addColumn('service_subcategory_name', function (Service $service) {
                    return $service->subcategory->name;
                })
                ->addColumn('image', function (Service $service) {
                    $fileUrl = storage('uploads/service-provider\service/' . $service->image);
                    return '<a href="' . $fileUrl . '" data-lightbox="service-' . $service->id . '" data-title="' . $service->user->id . '" data-fit-images-in-viewport="true" data-max-width="1200"><img src="' . $fileUrl . '" alt="Image" style="max-width: 100px; max-height: 100px;"></a>';
                })
                ->addColumn('bank_details', function ($service) {
                    if ($service->bankDetail->exists) {
                        return '<a href="' . url('admin/mange-services/' . $service->id . '/bank-detail') . '" target="_blank"><b>
                    <i class="fa fa-eye mr-2"></i>View Details</a>';
                    } else {
                        return ' <a href="javascript:void(0)" class="text-danger"><b>
                        <i class="fa fa-exclamation-circle mr-2"></i>Not
                        Details</a>';
                    }
                })
                ->addColumn('action', function ($service) {
                    return '<a href="javascript:void(0)" data-id="' . $service->id . '" class="btn btn-sm btn-primary btn-approve">Approve</a> ' .
                        '<a href="javascript:void(0)" data-id="' . $service->id . '" class="btn btn-sm btn-danger btn-reject">Reject</a>';
                })
                ->rawColumns(['bank_details', 'image', 'action'])
                ->make(true);
        }
        return view('backend.admin.manage-services.index');
    }

    public function bankDetails(Service $service)
    {
        $bank = $service->bankDetail;
        return view('backend.admin.manage-services.bank-details.index', compact('bank'));
    }

    public function approveService(Service $service)
    {

        $service->update(['status' => 'approved']);
        return response()->json(['success' => true, 'message' => 'Approved successfully']);
    }

    public function rejectService(Service $service)
    {
        $service->update(['status' => 'rejected']);
        return response()->json(['success' => true, 'message' => 'Rejected successfully']);
    }

    public function pendingServices(Request $request)
    {
        $query = Service::query()->where('status', 'pending')->whereHas('user', function ($userQuery) {
            $userQuery->whereNull('deactivated_at');
        });
        if ($request->wantsJson()) {
            return DataTables::eloquent($query)
                ->addColumn('service_provider_name', function (Service $service) {
                    return $service->user->name;
                })
                ->addColumn('service_category_name', function (Service $service) {
                    return $service->category->name;
                })
                ->addColumn('service_subcategory_name', function (Service $service) {
                    return $service->subcategory->name;
                })
                ->addColumn('image', function (Service $service) {
                    $fileUrl = storage('uploads/service-provider\service/' . $service->image);
                    return '<a href="' . $fileUrl . '" data-lightbox="service-' . $service->id . '" data-title="' . $service->user->id . '" data-fit-images-in-viewport="true" data-max-width="1200"><img src="' . $fileUrl . '" alt="Image" style="max-width: 100px; max-height: 100px;"></a>';
                })
                ->addColumn('bank_details', function ($service) {
                    return '<a href="' . url('admin/mange-services/' . $service->id . '/bank-detail') . '" target="_blank"><b>
                    <i class="fa fa-eye mr-2"></i>View Details</a>';
                })
                ->addColumn('action', function ($service) {
                    return '<a href="javascript:void(0)" data-id="' . $service->id . '" class="btn btn-sm btn-primary btn-approve">Approve</a> ' .
                        '<a href="javascript:void(0)" data-id="' . $service->id . '" class="btn btn-sm btn-danger btn-reject">Reject</a>';
                })
                ->rawColumns(['bank_details', 'image', 'action'])
                ->make(true);
        }
        return view('backend.admin.manage-services.pending-service');
    }
    public function approveServices(Request $request)
    {
        $query = Service::query()->where('status', 'approved')->whereHas('user', function ($userQuery) {
            $userQuery->whereNull('deactivated_at');
        });
        if ($request->wantsJson()) {
            return DataTables::eloquent($query)
                ->addColumn('service_provider_name', function (Service $service) {
                    return $service->user->name;
                })
                ->addColumn('service_category_name', function (Service $service) {
                    return $service->category->name;
                })
                ->addColumn('service_subcategory_name', function (Service $service) {
                    return $service->subcategory->name;
                })
                ->addColumn('image', function (Service $service) {
                    $fileUrl = storage('uploads/service-provider\service/' . $service->image);
                    return '<a href="' . $fileUrl . '" data-lightbox="service-' . $service->id . '" data-title="' . $service->user->id . '" data-fit-images-in-viewport="true" data-max-width="1200"><img src="' . $fileUrl . '" alt="Image" style="max-width: 100px; max-height: 100px;"></a>';
                })
                ->addColumn('bank_details', function ($service) {
                    return '<a href="' . url('admin/mange-services/' . $service->id . '/bank-detail') . '" target="_blank"><b>
                    <i class="fa fa-eye mr-2"></i>View Details</a>';
                })
                ->addColumn('action', function ($service) {
                    return '<a href="javascript:void(0)" data-id="' . $service->id . '" class="btn btn-sm btn-primary btn-approve">Approve</a> ' .
                        '<a href="javascript:void(0)" data-id="' . $service->id . '" class="btn btn-sm btn-danger btn-reject">Reject</a>';
                })
                ->rawColumns(['bank_details', 'image', 'action'])
                ->make(true);
        }
        return view('backend.admin.manage-services.approve-service');
    }

    public function rejectServices(Request $request)
    {
        $query = Service::query()->where('status', 'approved')->whereHas('user', function ($userQuery) {
            $userQuery->whereNull('deactivated_at');
        });
        if ($request->wantsJson()) {
            return DataTables::eloquent($query)
                ->addColumn('service_provider_name', function (Service $service) {
                    return $service->user->name;
                })
                ->addColumn('service_category_name', function (Service $service) {
                    return $service->category->name;
                })
                ->addColumn('service_subcategory_name', function (Service $service) {
                    return $service->subcategory->name;
                })
                ->addColumn('image', function (Service $service) {
                    $fileUrl = storage('uploads/service-provider\service/' . $service->image);
                    return '<a href="' . $fileUrl . '" data-lightbox="service-' . $service->id . '" data-title="' . $service->user->id . '" data-fit-images-in-viewport="true" data-max-width="1200"><img src="' . $fileUrl . '" alt="Image" style="max-width: 100px; max-height: 100px;"></a>';
                })
                ->addColumn('bank_details', function ($service) {
                    return '<a href="' . url('admin/mange-services/' . $service->id . '/bank-detail') . '" target="_blank"><b>
                    <i class="fa fa-eye mr-2"></i>View Details</a>';
                })
                ->addColumn('action', function ($service) {
                    return '<a href="javascript:void(0)" data-id="' . $service->id . '" class="btn btn-sm btn-primary btn-approve">Approve</a> ' .
                        '<a href="javascript:void(0)" data-id="' . $service->id . '" class="btn btn-sm btn-danger btn-reject">Reject</a>';
                })
                ->rawColumns(['bank_details', 'image', 'action'])
                ->make(true);
        }
        return view('backend.admin.manage-services.reject-service');
    }
}
