<?php
namespace App\Services\V1;

//use App\Helpers\CharacterHelper;
use App\Helpers\PaginationHelper;
use App\Helpers\URLHelper;

class CharacterAPIResource extends APIResource {
    private $characters, $pagination_links;

    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    public function getAllCharacters($params) {
        $response = $this->get($params);

        if(!$this->error){
            $characters = $response["body"];

            //$characters = CharacterHelper::GetCharacterBooks($characters);

            $this->pagination_links = $response["headers"]["Link"][0];
            $this->characters = URLHelper::modifyCharactersURLs($characters);
            
            return $this->characters;
        }
        else{
            return FALSE;
        }
    }

    public function getCharacter($id) {
        $response = $this->getOne($id);

        if(!$this->error){
            $character = $response["body"];
            $character = (URLHelper::modifyCharactersURLs([$character]))[0];

            return  $character;
        }
        else{
            return response()->json([
                "success" => 0,
                "message" => "Failed to get available books!",
                "error" => $this->error_message,
            ], 500);
        }
    }

    public function getPagination(){
        return PaginationHelper::getPaginationData( $this->pagination_links );
    }
}