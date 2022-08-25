<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Toastr::success('User created Successfully !!!', 'Congratulation',
            ["positionClass" => "toast-bottom-left", "progressBar"=> true]);

        return redirect()->route('user.list');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if($request->password){
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
        }

        $user = User::findOrFail($id);
        if($request->name){
            $user->name = $request->name;
        }
        if($request->email){
            $user->email = $request->email;
        }
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        Toastr::success('User updated Successfully !!!', 'Congratulation',
            ["positionClass" => "toast-bottom-left", "progressBar"=> true]);

        return redirect()->route('user.list');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Toastr::success('User deleted Successfully !!!', 'Congratulation',
            ["positionClass" => "toast-bottom-left", "progressBar"=> true]);

        return redirect()->route('user.list');
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
