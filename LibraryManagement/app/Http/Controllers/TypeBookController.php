<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\LoanCard;
use App\Models\typebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\VarDumper;

class TypeBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = typebook::paginate(10);
        return view('staff.type.index', compact('types'));
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
            'typename' => 'required|max:255',
        ],
        [
            'typename.required' => 'Vui lòng nhập trường tên thể loại'
        ]);


        if ($validator->fails()) {
            return redirect('/type/create')
                ->withInput()
                ->withErrors($validator);
        }


        $type = typebook::create(['name' =>  $request->input('typename')]);
        $type->save();
        return redirect()->route('type.index')
        ->with('success', 'Thêm thể loại thành công');
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
        $type = typebook::findOrFail($id);
        if(is_null($type)){
            return redirect('/404');
        }

        return view('staff.type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type = typebook::findOrFail($id);
        if(is_null($type)){
            return redirect('/404');
        }
        $validator = Validator::make($request->all(), [
            'typename' => 'required|max:255',
        ],
        [
            'typename.required' => 'Vui lòng nhập trường tên thể loại'
        ]);


        if ($validator->fails()) {
            return redirect('/type/'.$id)
                ->withInput()
                ->withErrors($validator);
        }


        $type->name = $request->input('typename');
        $type->save();

        return redirect()->route('type.index')
            ->with('success', 'Cập nhật thể loại thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $type = typebook::findOrFail($id);
            if (!is_null($type)) {
                $books = Book::where('idTypeBook', $id)->get();

                if (!is_null($books)) {
                    foreach ($books as $key => $book) {
                        $loancards = LoanCard::where('idBook', $book->isbn)->get();
                        if (!is_null($loancards)) {
                            foreach ($loancards as $key => $loancard) {
                                $loancard->delete();
                            }
                        }
                        $book->delete();
                    }
                }
                $type->delete();
            }
        } catch (\Throwable $th) {
            return back()->withErrors("Xóa thể loại thất bại");
        }

        return back();

    }
}
