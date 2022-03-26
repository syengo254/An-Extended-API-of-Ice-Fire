<?php

namespace App\Http\Controllers\V1;

use App\Helpers\DateHelper;
use App\Helpers\URLHelper;
use App\Http\Controllers\Controller;
use App\Services\V1\CharacterAPIResource;
use Illuminate\Http\Request;

class CharactersController extends Controller
{
    /**
     * get a listing of all characters from external api service
     * 
     */
    public function index(Request $request){
        // define default values for url params: page and pageSize
        $params = [
            "page" => 1,
            "pageSize" => 10,
        ];

        // If page and pageSize params are set, override the defaults
        if($request->has("page")){
            $params["page"] = $request->input("page");
        }
        if($request->has("pageSize")){
            $params["pageSize"] = $request->input("pageSize"); 
        }

        // if gender param is set on request add it to params and set has filter to true so as to add matched_count attr
        if($request->has("gender")){
            $params += [ "gender" => $request->input("gender") ];
            $has_filter = true; 
        }

        // if name param is set on request add it to params
        if($request->has("name")){
            $params += ["name" => $request->input("name") ];
            $has_filter = true; 
        }

        $charactersResource = new CharacterAPIResource('characters');
        $characters = $charactersResource->getAllCharacters($params);

        if($characters !== FALSE) {
            //if empty return response
            if(count($characters) < 1){
                return response()->json([
                    "success" => 1,
                    "data" => $characters,
                    "metadata" => [
                        "matched_count" => count($characters),
                        "total_age" => [
                            "in_months" => 0,
                            "in_years" => 0,
                        ],
                    ],
                    "pages" => [],
                ]);
            }

            // if sortby param is specified we shall sort the return response object using usort()
            if($request->has("sortby")){
                $sortby = $request->input("sortby"); 
                $sortOrder =  'ASC';

                if($request->has("order")){
                    $sortOrder = $request->input("order");
                }
                
                usort($characters, function($a, $b) use ($sortby, $sortOrder){
                    if(strtoupper($sortOrder) === 'ASC'){
                        if($a->$sortby){
                            return strcmp($a->$sortby, $b->$sortby);
                        }
                    }
                    else{
                        if($a->$sortby){
                            return (strcmp($a->$sortby, $b->$sortby) * -1);
                        }
                    }
                });
            }

            $total_ages = 0;

            //calculate age for each character
            foreach( $characters as $character ) {
                $total_ages += DateHelper::getCharacterAge($character->born, $character->died);
            }
            
            return response()->json([
                "success" => 1,
                "data" => $characters,
                "metadata" => [
                    "matched_count" => count($characters),
                    "total_age" => [
                        "in_months" => $total_ages * 12,
                        "in_years" => $total_ages,
                    ],
                ],
                "pages" => $charactersResource->getPagination(),
            ]);
        }
        else{
            return response()->json([
                "success" => 0,
                "message" => "Failed to get available characters!",
                "error" => $charactersResource->error_message,
            ], 500);
        }
    }

    /**
     * This will return a single character that matches the specified id supplied
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return Response
     */
    public function show($id) {
        $is_valid = URLHelper::isNumber($id);

        if(!$is_valid){ //if user passed wrong param return
            return response()->json([
                "success" => -1,
                "message" => "Invalid identifier supplied.",
            ], 404);
        }

        $characterResource = new CharacterAPIResource('characters');
        $character = $characterResource->getCharacter($id);
        
        if($character){
            $age = DateHelper::getCharacterAge($character->born, $character->died);

            return response()->json([
                "success" => 1,
                "data" => $character,
                //add Metadata
                "metadata" => [
                    "matched_count" => 1,
                    "total_age" => [
                        "in_months" => $age * 12,
                        "in_years" => $age,
                    ],
                ],
            ]);
        }
        else{
            $is404 = strpos($characterResource->error_message, '404'); //The external API responds with status 404 if id doesn't exist.

            if($is404){
                return response()->json([
                    "success" => 0,
                    "message" => "The specified character id: {$id} doesn't exist.",
                    "error" => $characterResource->error_message,
                ]);
            }
            else{
                return response()->json([
                    "success" => 0,
                    "message" => "Failed to get characters!",
                    "error" => $characterResource->error_message,
                ]);
            }
        }
    }
}
