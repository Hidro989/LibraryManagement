<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\LoanCard;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class LoanCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loancards = LoanCard::paginate(10);
        $readers = Reader::all();
        $books = Book::all();

        return view('staff.loancard.index', compact('loancards', 'readers', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::where('status', 0)->get();
        $readers = Reader::all();
        return view('staff.loancard.create', compact('books', 'readers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reader' => 'required',
            'book' => 'required',
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ],
        [
            'required' => "Vui lòng nhập đầy đủ các trường"
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $book = Book::where('isbn', $request->input('book'))->first();
        if(!is_null($book)){
            $book->status = 1;
            $book->save();
        }

        $dateStart = date_create($request->input('dateStart'));
        $dateEnd = date_create($request->input('dateEnd'));
        if($dateStart > $dateEnd){
            return back()->withInput()->withErrors("Ngày trả phải lớn hơn ngày mượn");
        }

        $loancard = new LoanCard();
        $loancard->cmndReader = $request->input('reader');
        $loancard->idBook = $request->input('book');
        $loancard->dateStart = $dateStart;
        $loancard->dateEnd = $dateEnd;
        $loancard->cmndReader = $request->input('reader');
        $loancard->status = 0;
        $loancard->idStaff = 1;

    
        
        try {
            $loancard->save();
            return redirect()->route('loancard.index');
        } catch (\Throwable $th) {
            return back()->withErrors("Tạo thẻ mượn không thành công");
        }
    }

    /**
     * Display the specified resource.
     */
    public function returnBooks(string $id)
    {
        $loancard = LoanCard::findOrFail($id);
        if(is_null($loancard)){
            return redirect('/404');
        }
        $loancard->status = 1;
        try {
            Book::where("isbn", $loancard->idBook)->update(['status' => 0]);
            $loancard->save();
        } catch (\Throwable $th) {
            return back()->withErrors("Trả sách không thành công");
        }

        return redirect()->route('loancard.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loancard = LoanCard::findOrFail($id);
        if(is_null($loancard)){
            return redirect('/404');
        }
        $books = Book::all();
        $readers = Reader::all();
        return view('staff.loancard.edit', compact('loancard', 'books', 'readers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $loancard = LoanCard::findOrFail($id);
        if(is_null($loancard)){
            return redirect('/404');
        }

        $validator = Validator::make($request->all(), [
            'reader' => 'required',
            'book' => 'required',
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ],
        [
            'required' => "Vui lòng nhập đầy đủ các trường"
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $loancard->cmndReader = $request->input('reader');
        $loancard->idBook = $request->input('book');
        $loancard->dateStart = date_create($request->input('dateStart'));
        $loancard->dateEnd = date_create($request->input('dateEnd'));
        $loancard->cmndReader = $request->input('reader');
        $loancard->save();
        return redirect()->route('loancard.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $loancard = LoanCard::findOrFail($id);
            Book::where("isbn", $loancard->idBook)->update(['status' => 0]);
            LoanCard::findOrFail($id)->delete();
        } catch (\Throwable $th) {
            return back()->withErrors("Trả sách không thành công");
        }

        return redirect()->route('loancard.index');
    }
}
