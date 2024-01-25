<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Customer;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function DoReg()

    {
        return view('book.register');
    }
    
    public function DoRegSave(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required',
            'content' => 'required|min:10',
        ]);
        $books=Book::create([
            'name' => request('name'),
            'author' => request('author'),
            'content' => request('content'),
        ]);

        return redirect()->route('home.book',compact('books'))->with('message', 'Registration successful!');
    }


    public function home(Request $request){
        $search = $request->input('search');

        $books = Book::with('customers')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', '%' . $search . '%')
                             ->orWhere('author', 'LIKE', '%' . $search . '%');
            })
            ->paginate(5);

        return view('book.home', compact('books', 'search'));
    }

    // public function search(Request $request){
    //     $search = $request->input('search');
    //     $books = Book::where(function($query) use ($search){
    //         $query->where('name','LIKE','%'.$search.'%')
    //               ->orWhere('author','LIKE','%'.$search.'%');
    //     })->paginate(5);

    //     return view('book.home', compact('books','search'));
    // }

    public function store(Request $request)
    {
        // dd($request->all());
        // // Validate the form data
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
        ]);

        // Create a new customer
        $customers = Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'bid' => $request->input('bookId'),
        ]);

        // return redirect()->route('home.book')->with('message', 'Subscription successful!');

        // return response()->json(['success' => 'Subscription successful!']);

        return redirect()->route('home.book',compact('customers'))->with('message', 'Subscription successful!');
}

    public function count(){
        $books = Book::with('customers')->paginate(5);

        return view('book.count',compact('books'));
    }
}


