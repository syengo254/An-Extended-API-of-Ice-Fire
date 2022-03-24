<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [ 
        'isbn', 
        'comment', 
        'user_ip',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'updated_at',
    ];

    /**
     * Cast attributes to specified format
     * created_at will be cast to UTC date time format
     * 
     */
    protected $casts = [
        "created_at" => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * This function retrieves the comments for a particular book using its isbn code
     * 
     * @param string $isbn
     * @return array
     */
    public static function getBookComments( $isbn ){
        $comments = self::where('isbn', '=', $isbn)->orderBy('created_at', 'asc')->get();

        foreach($comments as $comment){
            $comment->username = 'Anonymous@' . $comment->user_ip;
        }
        
        return [
            "comments" => $comments,
            "count" => $comments->count(),
        ];
    }
}
