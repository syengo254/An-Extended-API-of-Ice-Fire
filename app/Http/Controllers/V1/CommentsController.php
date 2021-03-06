<?php

namespace App\Http\Controllers\V1;

use App\Helpers\URLHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Comment;
use App\Services\V1\BookAPIResource;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * return comment list for a particular book
     */
    public function show($book_id){
        $is_valid = URLHelper::isNumber($book_id);

        if(!$is_valid){ //if user passed wrong param return
            return response()->json([
                "success" => -1,
                "message" => "Invalid identifier supplied.",
            ], 404);
        }

        $bookResource = new BookAPIResource('books');
        $book = $bookResource->getBook($book_id);

        if($book){
            $comments = Comment::where('isbn', "=", $book->isbn)->get();
            $book->comments_count = $comments->count();

            return response()->json([
                "success" => 1,
                "data" => [
                    "book" => (new BookResource($book, false))->withOnly(['name', 'isbn', 'url', 'comments_count', 'authors']),
                    "comments" => $comments->toArray(),
                ],
            ]);
        }
        else {
            // return response()->json([
            //     "success" => 0,
            //     "message" => "Failed to get book comments!",
            //     "error" => $bookResource->error_message,
            // ]);

            $is404 = strpos($bookResource->error_message, '404'); //The external API responds with status 404 if id doesn't exist.

            if($is404){
                return response()->json([
                    "success" => 0,
                    "data" => [
                        "book" => [ "name" => "Book id: {$book_id} doesn't exist."],
                        "comments" => [],
                    ],
                    "message" => "Resource not found."
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

    /**
     * Store a new comment to the database
     * 
     * @param Request 
     * @return JSON - with the added comment on the database
     * 
     * request data should have book_name and the comment text
     */
    public function store(Request $request){
        $comments_data = $this->validate($request, [
            'isbn' => 'required|string',
            'comment' => 'required|string|min:10|max:500'
        ]);
        $comments_data["user_ip"] = $request->ip();

        /**
         * If duplicate comment data from same ip address, return duplicate message
         */
        if($this->commentExists($comments_data)){
            return response()->json([
                "success" => -1,
                "message" => "duplicate comments for the same book not allowed",
            ]);
        }

        $comment = new Comment($comments_data);
        $comment->save();

        if($comment && $comment->id){
            return response()->json([
                "success" => 1,
                "message" => "comment added",
                "data" => $comment,
            ]);
        }
        else{
            return response()->json([
                "success" => 0,
                "message" => "Failed to save comment!",
                "data" => NULL,
            ]);
        }
    }

    /**
     * This function checks if same comment with incoming data exists and returns true or false
     * @param array data
     * @return bool
     * 
     */
    private function commentExists($data) : bool {
        $comment = Comment::where('isbn', "=", $data['isbn'])
            ->where('user_ip', "=",$data['user_ip'])
            ->where('comment', "LIKE", '%' . $data['comment'] . '%')->first();

        if($comment && $comment->id) return true;

        return false;
    }
}
