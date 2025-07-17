<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Review;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AdminReviewsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reviews.view'), Response::HTTP_FORBIDDEN);
        
        $inquiries = Inquiry::where('member_status', 'completed')->get();
        $inquiryId = $inquiries->pluck('id');
        $reviews = Review::whereIn('inquiry_id', $inquiryId)->get();
         return view('backend.admin.reviews.index',compact('reviews'));
    }

    public function publish(Request $request)
    {
        try {
            $fields = $request->validate([
                'tableId' => 'required',
              
            ]);

            $reviews = Review::find($fields['tableId']);
            $reviews->status = 1;
            // $memberRegister->approved_date = Carbon::now();
            $reviews->save();

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully published!',
                    'data' => ['reviews' => $reviews]
                ));
            }
            return back()->with(['reviews' => $reviews]);
        } catch (ValidationException | QueryException | \Exception $e) {
            $errors = $e->getMessage();
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'message' => $errors,
                    'data' => null
                ));
            }
            return back()->withErrors($errors)->withInput();
        }
    }


    public function unpublish(Request $request)
    {
        try {
            $fields = $request->validate([
                'tableId' => 'required',
            ]);

            $reviews = Review::find($fields['tableId']);
            $reviews->status = 2;
            // $memberRegister->approved_date = Carbon::now();
            $reviews->save();

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully unpublished!',
                    'data' => ['reviews' => $reviews]
                ));
            }
            return back()->with(['reviews' => $reviews]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errors = reset($errors)[0];
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'message' => $errors,
                    'data' => null
                ));
            }
            return back()->withErrors($errors)->withInput();
        }
    }

    public function delete(Request $request)
    {
        try {
            $fields = $request->validate([
                'tableId' => 'required',
            ]);
         

            $reviews = Review::find($fields['tableId']);
            $reviews->delete();

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully deleted!',
                    'data' => ['reviews' => $reviews]
                ));
            }
            return back()->with(['reviews' => $reviews]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errors = reset($errors)[0];
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'message' => $errors,
                    'data' => null
                ));
            }
            return back()->withErrors($errors)->withInput();
        }
    }
}
