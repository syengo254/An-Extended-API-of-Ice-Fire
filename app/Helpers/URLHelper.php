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
}