<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\LoanCard;
use App\Models\Typebook;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;
use Symfony\Component\VarDumper\Caster\RedisCaster;

use function Ramsey\Uuid\v1;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $books = Book::paginate(10);
        $types = typebook::all();
        return view('staff.book.index', compact('books', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $types = Typebook::all();
        return view('staff.book.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =  $this->customRule($request);
        
        // var_dump($request->all());
        // exit();
        if ($validator->fails()) {
            return redirect('/book/create')
                ->withInput()
                ->withErrors($validator );
        }
        
        $book = new Book();
        $book->isbn = $request->input('isbn');
        $book->name = $request->input('bookname');
        $book->idStaff = 1; // Sửa lại khi merge
        $book->idTypeBook = intval($request->input('typebook'));
        $book->author = $request->input('author');
        $book->publisher = $request->input('publisher');
        $book->publishingYear = $request->input('publisingYear');
        $book->status = 0;
        try{
            $book->save();
        }catch(Exception $e){
            return redirect('/book/create')
                ->withInput()
                ->withErrors($e->getMessage());
        }
        return redirect()->route('book.index');
    }
    
    // Custom validator rule, message, attribute
    private function customRule($request) : ValidationValidator 
    {   
        $validator = Validator::make($request->all(), [
            'isbn' => 'required|max:255',
            'bookname' => 'required|max:255',
            'typebook' => 'required',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'publisingYear' => 'required|numeric|min:1990'
        ],
        [
            'publisingYear.numeric' => 'Trường năm xuất bản yêu cầu nhập số',
            'publisingYear.min' => 'Giá trị năm xuất bản lớn hơn năm 1990',
            'bookname' => 'Vui lòng nhập trường :attribute',
            'typebook' => 'Vui lòng nhập trường :attribute',
            'isbn' => 'Vui lòng nhập trường :attribute',
            'author' => 'Vui lòng nhập trường :attribute',
            'publisher' => 'Vui lòng nhập trường :attribute',
            'publishingYear' => 'Vui lòng nhập trường :attribute',
            
        ],
        [
            'bookname' => 'Tên sách',
            'typebook' => 'Thể loại',
            'isbn' => 'ISBN',
            'author' => 'Tác giả',
            'publisher' => 'Nhà xuất bản',
            'publishingYear' => 'Năm xuất bản'
        ]);
        return $validator;
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
    public function edit(string $isbn)
    {   
        $book = Book::where('isbn', $isbn)->first();
        $types = Typebook::all();
        if(is_null($book) || is_null($types)){
            return redirect('/404');
        }
        
        return view('staff.book.edit', compact('book', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $isbn)
    {
        $validator =  $this->customRule($request);
        

        if ($validator->fails()) {
            return redirect('/book/'.$isbn)
                ->withInput()
                ->withErrors($validator);
        }

        $book = Book::where('isbn', $isbn)->first();
        if(is_null($book)){
            return redirect('/404');
        }

        $book->name = $request->input('bookname');
        $book->idTypeBook = intval($request->input('typebook'));
        $book->author = $request->input('author');
        $book->publisher = $request->input('publisher');
        $book->publishingYear = $request->input('publisingYear');
        $book->save();
        return redirect()->route('book.index')->with(['success' => 'Cập nhật sách thành công']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $isbn)
    {
        $book = Book::where('isbn', $isbn)->first();
        if(is_null($book)){
            return redirect('/404');
        }else{
            $loancard = LoanCard::where('idBook', $isbn)->first();

            if(!is_null($loancard)){
                $loancard->delete();
            }
            $book->delete();
        }

        return back();
    }
}
