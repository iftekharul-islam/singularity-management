<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json($user);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        if($user){
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found']);
        }

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user) {
            if ($request->name) {
                $user->name = $request->name;
            }
            if ($request->email) {
                $user->email = $request->email;
            }
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return response()->json($user);
        }

        return response()->json(['message' => 'User not found']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
            return response()->json('User deleted successfully');
        } else {
            return response()->json(['message' => 'User not found']);
        }
    }
}
