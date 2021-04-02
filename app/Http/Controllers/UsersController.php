<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $allUsers = User::all();
        return response()->json($allUsers, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' =>'required|string|max:255',
            'email' =>'required|string|max:255',
            'password' =>'required|string|max:255',
        ];

        $inputs = $request->validate($rules);
        $inputs['password'] = Hash::make($inputs['password']);
        $user = User::create($inputs);
        return response()->json($user, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $rules = [
            'name' =>'sometimes|string|max:255',
        ];
        $validated = $request->validate($rules);
        $user = Auth::user();
        $user->fill($validated);
        $user->save();
        $user['token'] = JWTAuth::fromUser($user);
        return response()->json($user,200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ad  $ad
     * @return JsonResponse
     */
    public function destroy(Ad $ad)
    {
        $result = $ad->delete();
        return response()->json($result,200);
    }
}
