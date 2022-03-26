<?php

namespace App\Http\Controllers\V1;

use App\Helpers\URLHelper;
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

        if($books !== FALSE){
            foreach( $books as $book ){
                $book_comments = Comment::getBookComments($book->isbn);
                $book->comments = $book_comments["comments"];
                $book->comments_count = $book_comments["count"];
                $book->released = date('Y-m-d', strtotime($book->released));
            }

            return response()->json([
                "success" => 1,
                "data" => (new BookResource($books, true))->withOnly(['id', 'name', 'url', 'isbn', 'authors', 'released', 'comments_count']),
                "pages" => $bookResource->getPagination(),
            ]);
        }
        else{
            return response()->json([
                "success" => 0,
                "message" => "Failed to get available books or resource not found!",
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
        $is_valid = URLHelper::isNumber($id);

        if(!$is_valid){ //if user passed wrong param return
            return response()->json([
                "success" => -1,
                "message" => "Invalid identifier supplied.",
            ], 404);
        }

        $bookResource = new BookAPIResource('books');
        $book = $bookResource->getBook($id);

        if($book){
            $book_comments = Comment::getBookComments($book->isbn);
            $book->comments = $book_comments["comments"];
            $book->comments_count = $book_comments["count"];
            $book->released = date('Y-m-d', strtotime($book->released));

            return response()->json([
                "success" => 1,
                "data" => (new BookResource($book, false))->withOnly(['id', 'name', 'isbn', 'authors', 'released', 'comments_count', 'comments']),
            ]);
        }
        else{
            $is404 = strpos($bookResource->error_message, '404'); //The external API responds with status 404 if id doesn't exist.

            if($is404){
                return response()->json([
                    "success" => 0,
                    "message" => "The specified book id: {$id} doesn't exist.",
                    "error" => $bookResource->error_message,
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

    public function getCharacters($book_id){
        $is_valid = URLHelper::isNumber($book_id);

        if(!$is_valid){ //if user passed wrong param return
            return response()->json([
                "success" => -1,
                "message" => "Invalid identifier supplied.",
            ], 404);
        }

        $bookResource = new BookAPIResource('books');

        $book = $bookResource->getBook($book_id);
        $characters = $bookResource->getBookCharacters($book_id);

        if($book){
            return response()->json([
                "success" => 1,
                "data" => [
                    "book" => (new BookResource($book, false))->withOnly(['name', 'isbn', 'url', 'authors']),
                    "characters" => $characters,
                ],
            ]);
        }
        else{
            $is404 = strpos($bookResource->error_message, '404'); //The external API responds with status 404 if id doesn't exist.

            if($is404){
                return response()->json([
                    "success" => 0,
                    "message" => "The specified book id: {$book_id} doesn't exist.",
                    "error" => $bookResource->error_message,
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
}
