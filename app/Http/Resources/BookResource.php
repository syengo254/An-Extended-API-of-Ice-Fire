<?php
namespace App\Http\Resources;

use FastRoute\RouteParser\Std;
use stdClass;

class BookResource {
    private $bookCollection;
    private $isCollection;

    public function __construct($bookCollection, $isCollection = true)
    {
        $this->bookCollection = $bookCollection;
        $this->isCollection = $isCollection;
    }

    public function withOnly(array $props) {
       if($this->isCollection){
            $newBookCollection = [];

            foreach($this->bookCollection as $bookItem){
                array_push($newBookCollection, $this->mapNewObject($bookItem, $props));
            }

            return $newBookCollection;
       }
       else{
            return $this->mapNewObject($this->bookCollection, $props);
       }
    }

    private function mapNewObject($obj, $props){
        $newBookItem =  new stdClass();

        foreach($props as $prop){
            if($obj->$prop){
                $newBookItem->$prop = $obj->$prop;
            }
        }

        return $newBookItem;
    }
}