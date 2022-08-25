<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OutletController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $outlets = Outlet::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.outlet.index', compact('outlets'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.outlet.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $outlet = new Outlet();
        $outlet->name = $request->name;
        $outlet->phone_no = $request->phone_no;
        $outlet->latitude = $request->latitude;
        $outlet->longitude = $request->longitude;
        if($request->has('img_url')){
            $name = $request->file('img_url')->getClientOriginalName();
            $request->file('img_url')->storeAs('public/images', $name);
            $outlet->img_url = 'storage/images/'. $name;
        }
        $outlet->save();

        Toastr::success('Outlet created Successfully !!!', 'Congratulation',
            ["positionClass" => "toast-bottom-left", "progressBar"=> true]);

        return redirect()->route('outlet.list');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $outlet = Outlet::findOrFail($id);

        return view('admin.outlet.show', compact('outlet'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $outlet = Outlet::findOrFail($id);

        return view('admin.outlet.edit', compact('outlet'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $outlet = Outlet::findOrFail($id);
        if($request->name){
            $outlet->name = $request->name;
        }
        if($request->phone_no){
            $outlet->phone_no = $request->phone_no;
        }
        if($request->latitude) {
            $outlet->latitude = $request->latitude;
        }
        if($request->longitude) {
            $outlet->longitude = $request->longitude;
        }
        if($request->has('img_url')){
            $name = $request->file('img_url')->getClientOriginalName();
            $request->file('img_url')->storeAs('public/images', $name);
            $outlet->img_url = 'storage/images/'. $name;
        }
        $outlet->save();

        Toastr::success('Outlet updated Successfully !!!', 'Congratulation',
            ["positionClass" => "toast-bottom-left", "progressBar"=> true]);

        return redirect()->route('outlet.list');

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $outlet = Outlet::findOrFail($id);
        $outlet->delete();

        Toastr::success('Outlet deleted Successfully !!!', 'Congratulation',
            ["positionClass" => "toast-bottom-left", "progressBar"=> true]);

        return redirect()->route('outlet.list');
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone_no' => ['required', 'string', 'integer', 'min:11', 'unique:outlets'],
            'latitude' => ['required', 'integer'],
            'longitude' => ['required', 'integer'],
        ]);
    }
}
