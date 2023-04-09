<?php

namespace App\Http\Controllers;

use App\Models\BookDetail;
// use Elastic\Elasticsearch\Response\Elasticsearch;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $bookdetails = BookDetail::search($request->search)->paginate(10);
        } else {
            return view('home');
        }

        return view('home', compact('bookdetails'));
    }

    public function getProductList(Request $request, $id = NULL)
    {
        if (!is_null($id)) {
            $bookdetails =  BookDetail::where('id', $id)->paginate(10);
        } else {
            $bookdetails =  BookDetail::paginate(10);
        }
        return  view('product', compact('bookdetails'));
    }

    public function create(Request $request)
    {
        return view('product.addProduct');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'book_title' => 'required',
            'author' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        $originalFile = '';
        if (!is_null($request->file('image'))) {
            $file = $request->file('image');
            $destinationPath = 'public/image/';
            $originalFile = $file->getClientOriginalName();
            $file->move($destinationPath, $originalFile);
        }
        $instertData = [
            'title' => $data['book_title'],
            'author' => $data['author'],
            'description' => $data['description'],
            'isbn' => $data['isbn'],
            'genre' => $data['genre'] ? $data['genre'] : uniqid(),
            'published' => $data['published'],
            'publisher' => $data['publisher'],
            'image' => $originalFile,
        ];

        BookDetail::insert($instertData);
        return redirect()->route('getProductList')->withFlashSuccess('Product added successfully');
    }
    public function edit(Request $request, $id)
    {


        $bookdetails = BookDetail::where('id', $id)->get()->first();

        if ($bookdetails) {
            return view('product.edit', compact('bookdetails'));
        }
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
        ]);

        $data = $request->all();
        $user = BookDetail::where("id", $data["id"]);
        $updatData = [
            'title' => $data['title'],
            'author' => $data['author'],
            'description' => $data['description'],
            'isbn' => $data['isbn'],
            'genre' => $data['genre'] ? $data['genre'] : uniqid(),
            'published' => $data['published'],
            'publisher' => $data['publisher'],
        ];
        if (!is_null($request->file('image'))) {
            $file = $request->file('image');
            $destinationPath = 'public/image/';
            $originalFile = $file->getClientOriginalName();
            $file->move($destinationPath, $originalFile);
            $updatData['image'] = $originalFile;
        }
        $updated =  $user->update($updatData);
        return redirect()->route('getProductList')->withFlashSuccess('Product updated successfully');
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        $data = BookDetail::destroy($data['id']);

        return response()->json(['data' => ["msg" => "Product deleted successfully", "status" => 200]]);
    }
}
