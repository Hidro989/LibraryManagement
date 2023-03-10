<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\LoanCard;
use App\Models\Reader;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $readers = Reader::paginate(10);
        return view('staff.reader.index', compact('readers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.reader.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'cmnd' => 'required|max:255',
            'address' =>'required|max:300'
        ],
        [
            'name.required' => 'Vui lòng nhập trường tên đọc giả',
            'cmnd.required' => 'Vui lòng nhập trường CMND',
            'address.required' => 'Vui lòng nhập trường địa chỉ',
        ]
        );

        if($validator->fails()){
            return redirect()->route('reader.create')->withInput()->withErrors($validator);
        }



        $reader = new Reader();
        $reader->cmnd = $request->input('cmnd');
        $reader->name = $request->input('name');
        $reader->address = $request->input('address');

        try{
            $reader->save();
        }catch(Exception $e){
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()->route('reader.index')
        ->with('success', 'Thêm đọc giả thành công');
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
    public function edit(string $cmnd)
    {
        $reader = Reader::where('cmnd', $cmnd)->first();
        if(is_null($reader)){
            return redirect('/404');
        }
        return view('staff.reader.edit', compact('reader'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cmnd)
    {
        $reader = Reader::where('cmnd', $cmnd)->first();
        if(is_null($reader)){
            return redirect('/404');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'cmnd' => 'required|max:255',
            'address' =>'required|max:300'
        ],
        [
            'name.required' => 'Vui lòng nhập trường tên đọc giả',
            'cmnd.required' => 'Vui lòng nhập trường CMND',
            'address.required' => 'Vui lòng nhập trường địa chỉ',
        ]
        );

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $reader->name = $request->input('name');
        $reader->address = $request->input('address');
        $reader->save();
        return redirect()->route('reader.index')
        ->with('success', 'Cập nhật đọc giả thành công');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cmnd)
    {
        try {
            $reader = Reader::where('cmnd', $cmnd)->first();
            if (!is_null($reader)) {
                $loancards = LoanCard::where('cmndReader', $cmnd)->get();
                if (!is_null($loancards)) {
                    foreach ($loancards as $key => $loancard) {
                        Book::where("isbn", $loancard->idBook)->update(['status' => 0]);
                        $loancard->delete();
                    }
                }
                $reader->delete();
            }
        } catch (\Throwable $th) {
            return back()->withErrors("Xóa người đọc thất bại");
        }

        return back();

    }
}
