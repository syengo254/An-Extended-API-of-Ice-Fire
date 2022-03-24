<?php
namespace App\Services\V1;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Exception;
use RuntimeException;

class APIResource {
    protected string $resource, $url;
    public $error = false;
    public $error_message = '';

    public function __construct(string $resource='')
    {
        $this->resource = $resource;
        $this->url = env('EXT_API_URL', "https://anapioficeandfire.com/api");
    }

    private function getUrl() : string {
        return $this->url . "/" . $this->resource;
    }

    //get all resources
    public function get($params = []){
        //clear any previous errors when executing the request
        if($this->error){
            $this->error = false;
        }

        $url = $this->getUrl();

        if(count($params) > 0){
            $url .= '?';

            // append other url params
            $first = true;
            foreach( $params as $key => $param){
                $url .= ($first ? '' : '&') . $key . '=' . $param;
                $first = false;
            }
        }

        try {
            $client = new Client();

            $response = $client->request('GET', $url);
            
            if($response->getStatusCode() == 200){
                return [
                    "headers" => $response->getHeaders(),
                    "body" => json_decode($response->getBody()),
                ];
            }
            else{
                return ["error" => "Failed to fetch resource at: ". $this->getUrl()];
            }
        }
        catch(RuntimeException $e){
            $this->handleError($e);
        }
    }

    //get one resource
    public function getOne($resource_id) {
        $url = $this->getUrl() . '/' . $resource_id;

        try {
            $client = new Client();

            $response = $client->request('GET', $url);
            
            if($response->getStatusCode() == 200){
                return [
                    "body" => json_decode($response->getBody()),
                ];
            }
            else{
                return ["error" => "Failed to fetch resource at: ". $this->getUrl()];
            }
        }
        catch(RuntimeException $e){
            $this->handleError($e);
        }
    }

    public function post($data){
        // This can be implemented if the API supports a post for this resource route.
    }

    private function handleError(Exception $e){
        $this->error = true;
        $this->error_message = $e->getMessage();

        $logMsg = date('d-m-YY H:i:s') . ": API { " . $this->url . " } error: ". $e->getMessage();

        Log::error($logMsg);
    }

    public function __destruct()
    {
        $this->resource = '';
        $this->url = '';
    }
}