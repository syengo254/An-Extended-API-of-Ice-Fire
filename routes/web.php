<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function(){
    return view('index');
});

$router->get('/api/docs', function(){
    return 'This is the api docs';
});


/* 
|--------------------------------------------------------------------------
| API ENDPOINTS
|--------------------------------------------------------------------------
|
| Routes prefixed with '/api' for the api specific routes.
|
*/

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/', function(){
        return response()->json([
            "success" => -1,
            "message" => "Kindly specify a resource on your URL e.g. to get books, use ". env('APP_URL'). "/api/books as your request URL.",
        ], 404);
    });

    $router->group(['namespace' => 'V1'], function() use ($router) {

    $router->get('books', [
        'as' => 'books', 
        'uses' => 'BooksController@index',
    ]);

    $router->get('books/{id}', [
        'as' => 'books', 
        'uses' => 'BooksController@show',
    ]);

    $router->get('characters', [
        'as' => 'characters',
        'uses' => 'CharactersController@index',
    ]);

    $router->get('characters/{id}', [
        'uses' => 'CharactersController@show'
    ]);

    $router->post('comments', [
        'as' => 'add-comment',
        'uses' => 'CommentsController@store'
    ]);

    //get a book's comments
    $router->get('books/{book_id}/comments', [
        'uses' => 'CommentsController@show'
    ]);

    // get a book's characters
    $router->get('books/{book_id}/characters', [
        'uses' => 'BooksController@getCharacters'
    ]);
   });
});

/** END API ENDPOINTS */
