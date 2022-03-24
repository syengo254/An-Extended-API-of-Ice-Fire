<?php
namespace App\Services\V1;

use App\Helpers\PaginationHelper;
use App\Helpers\URLHelper;

class BookAPIResource extends APIResource {
    private $books;
    private $pagination_headers;
    private $bookCharacters;

    public function __construct(string $resource)
    {
        parent::__construct($resource);
    }

    // returns an array of book objects
    public function getAllBooks($params) {
        $response = $this->get($params);

        if(!$this->error){
            $books = $response["body"];
            $this->books = URLHelper::modifyBooksURLs($books);
            $this->pagination_headers = $response["headers"]["Link"][0];
        }
        else{
            $this->books = FALSE;
        }

        return $this->books;
    }

    // returns one book object
    public function getBook($id) {
        $response = $this->getOne($id);

        if(!$this->error){
            $book = $response["body"];
            $book = URLHelper::modifyBooksURLs([$book])[0];
            $this->bookCharacters = $book->characters;

            return  $book;
        }
        else{
            return FALSE;
        }
    }

    //get book characters
    public function getBookCharacters($id){
        if($this->bookCharacters){
            return $this->bookCharacters;
        }
        else{
            $this->getBook($id);
            return $this->bookCharacters; 
        }
    }

    //get pages for pagination
    public function getPagination () {
        return PaginationHelper::getPaginationData( $this->pagination_headers );
    }
}