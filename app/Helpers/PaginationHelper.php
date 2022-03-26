<?php
namespace App\Helpers;

class PaginationHelper {

    /**
     * this function takes in the header data with pagination links from the external api and tranforms
     * the data into an array with the link as the app domain and link-text
     * 
     * @param string $pagination_links
     * @return array
     * 
     */
    public static function getPaginationData( $pagination_links ){
        $page_values = explode(",", $pagination_links);
		
		if(count($page_values) < 1) return [];

        // array initialized as empty to hold the links and their key name 
        // e.g. ["last" => "http://example.com/api/books?page=2"]
        $data = [];

        foreach( $page_values as $pv ){
            $pv_data = explode(";", $pv);
            $link_raw = str_replace(["<", ">", ""], "", trim($pv_data[0]));
            $link_name = str_replace(["rel", "\\", "\"", "="], "", trim($pv_data[1])); // convert rel=\"first\" to "first"

            $data += [
                $link_name => str_replace("https://anapioficeandfire.com", env('APP_URL'), $link_raw), //replace ext api domain with app domain
            ];
        }

        $total_pages = 1;

        // Calc total pages from the page number of the item with key 'last'
        foreach( $data as $key => $value){
            if($key == 'last') {
                $startpos = ( strpos($value, 'page=')) + 5;
                $endpos = ( strpos($value, '&', $startpos));
                $length = $endpos - $startpos;

                $total_pages = (int) substr($value, $startpos, $length);
            }
        }

        $data += [ "total_pages" => $total_pages ];

        return $data;
    }
}