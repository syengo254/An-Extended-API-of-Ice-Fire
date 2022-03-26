<?php
namespace App\Helpers;

class URLHelper {

    /**
     * modify characters url from external domain to our applications domain
     * i.e from https://anapioficeandfire.com/api/characters/ to http://localhost:8000/api/characters/
     * 
     */
    public static function modifyBooksURLs($books) {
        foreach($books as $book) {
            $book->url = str_replace('https://anapioficeandfire.com', env('APP_URL'), $book->url);

             // Extract book's id from it's url property
             $url = $book->url;
             $s = strpos($url, 'books/', 5) + 6;
             $val = (int) substr($url, $s, strlen($url) - $s );
             $book->id = $val;

            $characters = [];

            foreach($book->characters as $character){
                $character = str_replace('https://anapioficeandfire.com', env('APP_URL'), $character);
                $characters[] = $character;
            }

            $book->characters = $characters;

            $povCharacters = [];

            foreach($book->povCharacters as $character){
                $character = str_replace('https://anapioficeandfire.com', env('APP_URL'), $character);
                $povCharacters[] = $character;
            }

            $book->povCharacters = $povCharacters;
        }

        return $books;
    }

    /**
     * modify characters url from external domain to our applications domain
     * i.e from https://anapioficeandfire.com/api/characters/ to http://localhost:8000/api/characters/
     * 
     */
    public static function modifyCharactersURLs($characters) {
        /**
         * NOTE: str_replace is done twice because some character instances have www. in the url
         */
        foreach($characters as $character) {
            $character->url = str_replace('https://anapioficeandfire.com', env('APP_URL'), $character->url);
            $character->url = str_replace('https://www.anapioficeandfire.com', env('APP_URL'), $character->url);

            // Extract character's id from it's url property
            $url = $character->url;
            $s = strpos($url, 'characters/', 5) + 11;
            $val = (int) substr($url, $s, strlen($url) - $s );
            $character->id = $val;

            if($character->spouse){
                $character->spouse = str_replace('https://anapioficeandfire.com', env('APP_URL'), $character->spouse);
                $character->spouse = str_replace('https://www.anapioficeandfire.com', env('APP_URL'), $character->spouse);
            }

            $books = [];

            foreach($character->books as $book){
                $book = str_replace('https://anapioficeandfire.com', env('APP_URL'), $book);
                $book = str_replace('https://www.anapioficeandfire.com', env('APP_URL'), $book);

                $books[] = $book;
            }

            $character->books = $books;
        }

        return $characters;
    }

    /**
     * 
     * Validate that Id's passed via get are numbers and not malicious code.
     * Will help reduce load to external API server with garbage input
     * 
     * @return TRUE if valid
     * @return FALSE if invalid
     */
    static public function isNumber($param){
        $num = (int) $param;

        if($num === 0) return FALSE;
        else return TRUE;
    }
}