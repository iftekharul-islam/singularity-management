<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $outlets = Outlet::all();

        return response()->json($outlets);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
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

        return response()->json($outlet);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $outlet = Outlet::find($id);
        if($outlet){
            return response()->json($outlet);
        }
        return response()->json(['message' => 'Outlet not found']);

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $outlet = Outlet::find($id);
        if($outlet) {
            if ($request->name) {
                $outlet->name = $request->name;
            }
            if ($request->phone_no) {
                $outlet->phone_no = $request->phone_no;
            }
            if ($request->latitude) {
                $outlet->latitude = $request->latitude;
            }
            if ($request->longitude) {
                $outlet->longitude = $request->longitude;
            }
            if ($request->has('img_url')) {
                $name = $request->file('img_url')->getClientOriginalName();
                $request->file('img_url')->storeAs('public/images', $name);
                $outlet->img_url = 'storage/images/' . $name;
            }
            $outlet->save();

            return response()->json($outlet);
        }

        return response()->json(['message' => 'Outlet not found']);


    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $outlet = Outlet::find($id);
        if($outlet) {
            $outlet->delete();
            return response()->json('outlet deleted successfully');
        } else {
            return response()->json(['message' => 'outlet not found']);
        }
    }
}
