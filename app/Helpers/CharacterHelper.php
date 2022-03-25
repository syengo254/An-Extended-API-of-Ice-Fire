<?php
namespace App\Helpers;

class CharacterHelper {

    public static function GetCharacterBooks($characters) {
        foreach($characters as $character) {
            $books = $character->books;
            foreach( $books as $book){
                //to be rethinked later as this will cause a connection bump to the external API for each book just to get it's name.
                //Source API is a bit lacking in it's design.
            }
        }
    }
}