<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\typebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('staff.type.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        
     
        if ($validator->fails()) {
            return redirect('/type/create')
                ->withInput()
                ->withErrors('Vui lòng nhập đầy đủ các trường'. $request->input('typename'));
        }
     
        $type = new typebook();
        $type->name = $request->input('typename');
        $type->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
