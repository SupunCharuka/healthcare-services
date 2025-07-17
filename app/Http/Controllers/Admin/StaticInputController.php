<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceStaticInput;
use App\Models\ServiceStaticInputData;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class StaticInputController extends Controller
{
    public function index(ServiceCategory $category)
    {
        abort_if(Gate::denies(['service-category.manage', 'service-category.static-input-field']), Response::HTTP_FORBIDDEN);
        $staticInputs = ServiceStaticInput::all();
        return view('backend.admin.service-category.static-input.index', compact('staticInputs', 'category'));
    }


    public function checkStaticInputs(Request $request)
    {
        try {
            $fields = $request->validate([
                'Id' => 'required',
                'CategoryId' => 'required',
            ]);


            $staticInputs = ServiceStaticInput::findOrFail($fields['Id']);


            $inputData = new ServiceStaticInputData();
            $inputData->service_category_id = $fields['CategoryId'];
            $inputData->service_static_inputs_id = $staticInputs->id;
            $inputData->availability = 1;
            $inputData->save();


            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully checked!',
                    'data' => ['staticInputs' => $staticInputs]
                ));
            }
            return back()->with(['staticInputs' => $staticInputs]);
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

    public function uncheckStaticInputs(Request $request)
    {
        try {
            $fields = $request->validate([
                'Id' => 'required',
                'CategoryId' => 'required',
            ]);


            $staticInputs = ServiceStaticInput::findOrFail($fields['Id']);
            // Delete the record if it exists
            ServiceStaticInputData::where('service_static_inputs_id', $staticInputs->id)->where('service_category_id', $fields['CategoryId'])->delete();


            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully unchecked!',
                    'data' => ['staticInputs' => $staticInputs]
                ));
            }
            return back()->with(['staticInputs' => $staticInputs]);
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
