<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class UserController extends Controller
{
    public function index()
    {

    }

    final public function getOwnUser(Request $request): Response|null
    {
        $user = User::with(['memberRegister', 'education', 'workDetails'])->find($request->user()->id);

        if ($request->is('api/*') || $request->expectsJson()) {
            try {
                if (!$user) {
                    return response([
                        'success' => false,
                        'message' => 'No User Found..!',
                        'data' => null,
                    ], ResponseAlias::HTTP_UNAUTHORIZED);
                }

                Log::info('GET OWN USER DETAILS: USER ID[' . auth()->user()->id . ']');
                return response([
                    'success' => true,
                    'message' => 'Own user details..!',
                    'data' => new UserResource($user),
                ], ResponseAlias::HTTP_OK);

            } catch (Throwable $e) {
                return response([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'data' => null,
                ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            //write your logic for web call
            return null;
        }
    }

}
