<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\DoctorAvailability;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AvailabilityController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('doctor.access') || Gate::allows('service-provider.access'), Response::HTTP_FORBIDDEN);


        $services = Service::where('user_id', Auth::user()->id)->get();
        return view('backend.service-provider.availability.index',compact('services'));
    }
}
