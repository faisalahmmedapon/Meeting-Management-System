<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use JustSteveKing\LaravelPostcodes\Facades\Postcode;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:dashboard');

        $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:admin-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admins = Admin::all();
        return view('backend.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('backend.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // return $request->all();
        $this->validate($request, [
            'post_code' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            // 'phone' => 'required|regex:/^((\+44)?[\s-]?)?\(?[2-9]\d\d\)?[\s-]?[2-9]\d\d[\s-]?\d\d\d\d/',
            'phone' => 'required|regex:/^((\+44)?[\s-]?)?\(?[2-9]\d\d\)?[\s-]?[2-9]\d\d[\s-]?\d\d\d\d/',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed',
            'roles' => 'required'
        ]);

        $postCode = $request->post_code;

        $data =  Postcode::query($postCode);
        if($data->isNotEmpty()){
            if ($data[0]->postcode) {
                // return $data[0]->postcode;
                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
                $input['post_code'] = $data[0]->postcode;
                $user = Admin::create($input);
                $user->assignRole($request->input('roles'));
                return redirect()->route('admins.index')->with('success', 'User created successfully.');
            } else {
                return "Post code not match using uk poscode";
            }
        }else{
            return "Post code not match using uk poscode";
        }

        // return $data[0]->postcode;


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Admin::find($id);

        return view('backend.admins.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $adminRole = $admin->roles->pluck('name', 'name')->all();

        return view('backend.admins.edit', compact('admin', 'roles', 'adminRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //        $this->validate($request, [
        ////            'name' => 'required',
        ////            'last_name' => 'required',
        ////            'email' => 'required|email|unique:admins,email,'.$id,
        ////            'password' => 'confirmed',
        ////            'roles' => 'required'
        //        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = Admin::find($id);
        $user->update($input);

        DB::table('model_has_roles')
            ->where('model_id', $id)
            ->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('admins.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();

        return redirect()->route('admins.index')->with('success', 'User deleted successfully.');
    }



    public function postCode($postCode)
    {

        // $dd =  strlen($postCode);
        // if ($dd <= 6) {
        //     echo "Please use valid Post code";
        // }else{
        //     $data =  Postcode::query($postCode);
        //     return response()->json([
        //         'status' => "200",
        //         'post_code' => $data
        //     ]);
        // }

        // $data =   Postcode::query($postCode);


        // $location = Postcode::getPostcode($postCode);


        $data =  Postcode::query($postCode);
        return response()->json([
            'status' => "200",
            'data' => $data
        ]);
    }
}
