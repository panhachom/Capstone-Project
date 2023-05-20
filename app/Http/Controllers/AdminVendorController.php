<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $vendor = User::orderBy('id', 'desc')->where('role', 'vendor')->get(); 
        $vendor = Vendor::all();
        $vendor = Vendor::OrderBy('id', 'desc')->get();
        return view('admin/manage_vendor.view_vendor', compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        // $vendor = User::where('role', 'vendor')->get();
        $vendor = User::where('role', 'vendor')
            ->whereNotIn('id', function ($query) {
                $query->select('user_id')
                    ->from('vendors');
            })->get();
        return view('admin/manage_vendor.create_vendor', compact('vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vendor = new Vendor;
        $vendor->name = $request->name;
        $vendor->about_us = $request->about_us;
        $vendor->email = $request->email;
        $vendor->contact = $request->contact;


        $image = $request->logo;
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->logo->move('vendor', $imagename);
        $vendor->logo = $imagename;
        $vendor->user_id = $request->user_id;
        $vendor->save();


        return redirect('/view_vendor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);
        $user_ids = User::where('role', 'vendor')
        ->whereNotIn('id', function ($query) {
            $query->select('user_id')
                ->from('vendors');
        })->get();
        return view('admin/manage_vendor.update_vendor', compact('vendor', 'user_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vendor = new Vendor;
        $vendor -> where('id', $id)
        ->update(['name' => $request -> name,
                  'about_us' => $request-> about_us,
                  'email' => $request->email,
                  'contact'=> $request->contact,
                  'user_id'=> $request->user_id
                  ]
                  );

        return redirect('/view_vendor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();
        return redirect('/view_vendor');
    }
}
