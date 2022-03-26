# Welcome to An Extended API of Ice & Fire 
## Documetation Page

#### Navigation

*   [Introduction](#intro)
*   [Versions](#versions)
*   [Available Endpoints](#endpoints)
*   [General Structure](#structure)
*   [Resources Usage](#usage)
*   [Limitations](#limits)
*   [Licensing](#license)

Documetation
============

Introduction
------------

This documentation is meant to enable you to consume our API and get you started right away using your favourite programming language. All endpoints and HTTP methods to be used have been detailed with a sample example for each.

Requirements
------------
1. PHP 8.0 and above.
1. PostgreSQL, MySQL or MariaDB server
1. Composer dependency manager for PHP.
1. Access to a terminal prompt (or any other means to access and edit the .env.example variables to match your setup).
1. Git & Git Bash to run git commands.

Installation
------------

1. Clone this repository using the command 
```git
git clone https://github.com/syengo254/An-Extended-API-of-Ice-Fire.git
 ```
2. Copy the .ev.example file and rename the copy to .env and edit the entry keys in the next step.
3. Create a database named 'topup_mama' on your MySQL server. If the server is not local, edit the .env DB_HOST=127.0.0.1 entry to DB_HOST=\<your server name\>; as well as DB_USERNAME & DB_PASSWORD keys.
4. Navigate to the project folder and open a terminal window from that directory or use cd command.
5. Run the composer update command to install all project dependencies
```CMD
composer update
```
6. Run the PHP artisan migration command
```CMD
php artisan migrate
```
7. Run the below command to finally run a deveopment PHP server to serve the project on http://localhost:8000/
```CMD
php -S localhost:8000 -t public
```
8. Access the URL endpoints as defined on the Endpoints section below.


Versioning
----------

A a consumer of this API, versioning has been abstracted and need not to worry about it when making requests.

Endpoints
---------

The following table below highlights the available endpoints, HTTP method and a description.

|  \# 	|   Endpoint URL	|   HTTP Verb	|   Description	|   	|
|---	|---	|---	|---	|---	|
|   1.	|   [/api/books](http://localhost:8000/api/books)	| GET 	|   This will return a JSON response of an object with a list of all available books.	|   	|
|   2.	|   [/api/books/1](http://localhost:8000/api/books/1)	| GET 	|   This will return a JSON response of the book with and **id** of 1.	|   	|
|   3.	|   [/api/books/1/comments](http://localhost:8000/api/books/1/comments)	|   GET	|   This will return a JSON response of comments for the book with an **id** of 1.	|   	|
|   4.	|   [/api/books/1/characters](http://localhost:8000/api/books/1/characters)	|   GET	|   This will return a JSON response of the characters for the book with an **id** of 1.	|   	|
|   5.	|   [/api/characters](http://localhost:8000/api/characters)	|   GET	|   Returns a JSON response of all available book characters.	|   	|
|   6.	|   [/api/characters/23](http://localhost:8000/api/characters/23)	|   GET	|   Return a JSON response with the character details with an **id** of 23.	|   	|
|   7.	|   [/api/comments](http://localhost:8000/api/comments)	|   POST	|   Send a POST request to this endpoint to add a comment for a particular book that is identified by its ISBN number. Required params are:  
1.  isbn - ISBN number - text
1.  comment - The comment text - limited to 500 characters	|   	|


Response Structure
------------------

*   All responses for the endpoints defined will be in _JSON_ format and a header for _Content-Type: 'Application/json'_ will be sent.
*   All response objects with have an object named **data** that will hold the payload e.g. an array of characters or books, a book, a comment, etc.
*   All response objects with have an object named **success** that will hold either 1 representing success, 0 represnting failed and -1 representing and invalid request type.
*   Incase of an error, a data object named **message** will be included to show the specific error details.

See below example:

```json
{
	"success": 1,
	"data": {
		"book": {
			"name": "A Game of Thrones",
			"isbn": "978-0553103540",
			"url": "http://localhost:8000/api/books/1",
			"comment_count": 1,
			"authors": [
			"George R. R. Martin"
			]
		},
		"comments": [
			{
			"id": 1,
			"isbn": "978-0553103540",
			"comment": "Best book I've ever read so far!",
			"user_ip": "192.168.100.10",
			"created_at": "2022-03-23 19:18:17"
			}
		]
	}
}

```

Pagination
----------

Results for requests that respond with lists e.g. books' list and characters' list, will be paginated. You can make a request and specify a page and pageSize as GET URL parameters. The pagination links are also included by default in the JSON object response named "pages". The 'pages' object has links with the keys 'prev', 'first' & 'last' and a 'total\_pages' object. You can use to create pagination for your app that will consume our API.

An example like below: ```CMD
curl http://localhost:8000/api/books?page=2&pageSize=10
``` 
The results will look like below:
```JSON
{
	"success": 1,
	"data": [
		{
		"name": "The World of Ice and Fire",
		"isbn": "978-0553805444",
		"authors": [
		"Elio Garcia",
		"Linda Antonsson",
		"George R. R. Martin"
		],
		"released": "2014-10-28",
		"comments": [...]
		},
	...],
	"pages": {
		"prev": "http://localhost:8000/api/books?page=1&pageSize=10",
		"first": "http://localhost:8000/api/books?page=1&pageSize=10",
		"last": "http://localhost:8000/api/books?page=2&pageSize=10",
		"total_pages": 2
	}
}
```                        

Result Filters
--------------

You can specify filters via URL GET params for specific results. Available filters for every resource are listed in the next [section](#usage).


Usage
-----

### 1\. Books

*   To get a list of all books use make an HTTP GET request to: http://localhost:8000/api/books Example: 
```CMD
curl "http://localhost:8000/api/books"
```
	Available filters: _<name>_ `e.g. http://localhost:8000/api/books?name=A Game of Thrones` This will return:
	```JSON
		{
			"success": 1,
			"data": \[
			{
			"name": "A Game of Thrones",
			"isbn": "978-0553103540",
			"authors": \[
			"George R. R. Martin"
		...}
	```
*   To get the details of a particular book, make a GET request to the URL: http://localhost:8000/api/books/<id> Replace <id> with an integer representing the books id e.g. 1, 2, 3, ... as show below: 
```CMD
curl "http://localhost:8000/api/books/23"
```

### 2\. Book Characters

*   To get a list of **all characters** make an HTTP GET request to: http://localhost:8000/api/characters Example: 
```CMD
curl "http://localhost:8000/api/characters"
```
Available filters: _<name>_, _<gender>_, `e.g. http://localhost:8000/api/characters?name=Nysterica` This will return:
    ```JSON
	{
		"success": 1,
		"data": [
			{
			"url": "http://localhost:8000/api/characters/21",
			"name": "Nysterica",
			"gender": "Female",
			...}
		...],                                                
		...},
		"metadata": {
			"matched_count": 1,
			"total_age": {...}
		},
		"pages": {...}
	}								
	```
Another example: `curl http://localhost:8000/api/characters?gender=Female`

*   To get the **details of a particular character**, make a GET request to the URL: http://localhost:8000/api/characters/<id> Replace <id> with an integer representing the characters id e.g. 1, 2, 3, ... as show below: 
```CMD
curl "http://localhost:8000/api/characters/2"
```
*   To get a list **of all characters in a particular book** e.g. 2, make a GET request to the URL: http://localhost:8000/api/books/<id>/characters Replace <id> with an integer representing the characters id e.g. 1, 2, 3, ... as show below: 
```CMD
curl "http://localhost:8000/api/books/2/characters"
```
Available filters: _<name>_, _<gender>_ `e.g. http://localhost:8000/books/2/characters?name=Nysterica` `e.g. http://localhost:8000/books/2/characters?gender=Female`
    

All character list request are sortable by name in both ascending and descending order. This can be specified via GET URL params: _<sortby>_ & _<order>_ `e.g. http://localhost:8000/characters?gender=Male&sortby=name&order=desc` `e.g. http://localhost:8000/books/2/characters?page=12&pageSize=7&sortby=name&order=asc` Default sort order will default to asc (ascending) if not specified.

### 3\. Book Comments

*   To get a list of **all comments made for a particular book**, make an HTTP GET request to: http://localhost:8000/api/books/<id>/comments Replace <id> with a book id e.g. 1, 2, 3, etc. Example: 
```CMD
curl "http://localhost:8000/api/books/2/comments"
``` 
	The above command will return a list of comments for the book with an id of 2.

*   To **add a comment to a particular book**, send your POST request to the URL: http://localhost:8000/api/comments and include the parameters **isbn** and **comment**.  
    Both isbn and comment parameters should of type string and the isbn should be valid for a particular book. The comment parameter is limited to a maximum of 500 characters.  
    Generally, a POST request is sent via an HTML form. The data send to the form is usually encoded in either **multipart/form-data, application/json or application/x-www-form-urlencoded** content type.

Limitations
-----------

You can unlimited requests in a day to the API as long you don't exceed 60 requests per minute. Exceeding this minute limit will have your requests rejected for a preiod of 5 minutes.

Licensing & Copyright
---------------------

We make no ownership of the data we provide via our API. This is an API extension of the **'AN API OF ICE AND FIRE'** by [Joakim Skoog.](https://github.com/joakimskoog/)  
More details on the API are available at [AN API OF ICE AND FIRE](https://anapioficeandfire.com/)

This project uses a MIT license.

© 2022 - David Syengo. [![GitHub profile link icon](https://github.com/syengo254/An-Extended-API-of-Ice-Fire/blob/master/public/img/icons8-github-30.png?raw=true)](https://github.com/syengo254)


# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/lumen)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
