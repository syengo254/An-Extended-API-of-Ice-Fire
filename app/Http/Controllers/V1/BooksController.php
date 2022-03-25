<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Comment;
use App\Services\V1\BookAPIResource;
use Illuminate\Http\Request;

class BooksController extends Controller
{ 
    /**
     * Show a listing of books from the external API from page 1
     * 
     * @return Response
     */
    public function index(Request $request){
        $params = [
            "page" => 1,
            "pageSize" => 10,
        ];

        if($request->has("page")){
            $params["page"] = $request->input("page");
        }
        if($request->has("pageSize")){
            $params["pageSize"] = $request->input("pageSize"); 
        }

        if($request->has("name")){
            $params += [ "name" => $request->input("name")]; 
        }

        $bookResource = new BookAPIResource('books');
        $books = $bookResource->getAllBooks($params);

        if($books){
            foreach( $books as $book ){
                $book_comments = Comment::getBookComments($book->isbn);
                $book->comments = $book_comments["comments"];
                $book->comments_count = $book_comments["count"];
                $book->released = date('Y-m-d', strtotime($book->released));
            }

            return response()->json([
                "success" => 1,
                "data" => (new BookResource($books, true))->withOnly(['name', 'isbn', 'authors', 'released', 'comments_count']),
                "pages" => $bookResource->getPagination(),
            ]);
        }
        else{
            return response()->json([
                "success" => 0,
                "message" => "Failed to get available books!",
                "error" => $bookResource->error_message,
            ]);
        }
    }

    /**
     * This will return a single book that matches the specified id supplied
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return JSON format
     */
    public function show($id) {
        $bookResource = new BookAPIResource('books');
        $book = $bookResource->getBook($id);

        if($book){
            $book_comments = Comment::getBookComments($book->isbn);
            $book->comments = $book_comments["comments"];
            $book->comments_count = $book_comments["count"];
            $book->released = date('Y-m-d', strtotime($book->released));

            return response()->json([
                "success" => 1,
                "data" => (new BookResource($book, false))->withOnly(['name', 'isbn', 'authors', 'released', 'comments_count', 'comments']),
            ]);
        }
        else{
            return response()->json([
                "success" => 0,
                "message" => "Failed to get available books!",
                "error" => $bookResource->error_message,
            ]);
        }
    }

    public function getCharacters($book_id){
        $bookResource = new BookAPIResource('books');

        $book = $bookResource->getBook($book_id);
        $characters = $bookResource->getBookCharacters($book_id);

        if($book){
            return response()->json([
                "success" => 1,
                "book" => (new BookResource($book, false))->withOnly(['name', 'isbn', 'url', 'authors']),
                "characters" => $characters,
            ]);
        }
        else{
            return response()->json([
                "success" => 0,
                "message" => "Failed to get characters!",
                "error" => $bookResource->error_message,
            ]);
        }
    }

}
