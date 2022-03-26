<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <title>Welcome to An Extended API of Ice & Fire | Documetation Page</title>
</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a>
            <a href="">Documentation</a>
            <a href="https://github.com/syengo254/An-Extended-API-of-Ice-Fire" target="_blank">GitHub</a>
        </nav>
    </header>
    <main>
        <div class="side-panel">
            <h4 style="margin-bottom: 1rem;">Navigation</h4>
            <ul id="side-panel-menu">
                <li><a href="#intro">Introduction</a></li>
                <li><a href="#versions">Versions</a></li>
                <li><a href="#endpoints">Available Endpoints</a></li>
                <li><a href="#structure">General Structure</a></li>
                <li><a href="#pagination">Pagination</a></li>
                <li><a href="#filters">Request Filters</a></li>
                <li>
                    <div><a href="#usage">Resources Usage</a></div>
                    <div>
                        <ol style="list-style-position: inside; padding-left: 1rem">
                            <li><a href="#books">Books</a></li>
                            <li><a href="#characters">Characters</a></li>
                            <li><a href="#comments">Comments</a></li>
                        </ol>
                    </div>
                </li>
                <li><a href="#limits">Limitations</a></li>
                <li><a href="#license">Licensing</a></li>
            </ul>
        </div>
        <div class="main-panel">
            <h1>An Extended API of Ice & Fire Documetation</h1>
            <div class="doc-item" id="intro">
                <div class="doc-item-title">
                    <h2>Introduction</h2>
                </div>
                <div class="doc-item-body">
                    <p>This documentation is meant to enable you to consume our API and get you started right away using your favourite programming language.
                        All endpoints and HTTP methods to be used have been detailed with a sample example for each.</p>
                </div>
            </div>
            <div class="doc-item" id="versions">
                <div class="doc-item-title">
                    <h2>Versioning</h2>
                </div>
                <div class="doc-item-body">
                    <p>A a consumer of this API, versioning has been abstracted and need not to worry about it when making requests.</p>
                </div>
            </div>
            <div class="doc-item" id="endpoints">
                <div class="doc-item-title">
                    <h2>Endpoints</h2>
                </div>
                <div class="doc-item-body">
                    <p>
                        The following table below highlights the available endpoints, HTTP method and a description.
                    </p>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Endpoint URL</th>
                                <th style="width: 100px;">HTTP Verb</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td><a href="{{ env('APP_URL')}}/api/books" target="_blank">{{ env('APP_URL')}}/api/books</a></td>
                                <td style="text-align:center;">GET</td>
                                <td>
                                    <p>
                                        This will return a JSON response of an object with a list of all available books.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td><a href="{{ env('APP_URL')}}/api/books/1" target="_blank">{{ env('APP_URL')}}/api/books/1</a></td>
                                <td style="text-align:center;">GET</td>
                                <td>
                                    <p>
                                        This will return a JSON response of the book with and <b>id</b> of 1.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td><a href="{{ env('APP_URL')}}/api/books/1/comments" target="_blank">{{ env('APP_URL')}}/api/books/1/comments</a></td>
                                <td style="text-align:center;">GET</td>
                                <td>
                                    <p>
                                        This will return a JSON response of comments for the book with an <b>id</b> of 1.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td><a href="{{ env('APP_URL')}}/api/books/1/characters" target="_blank">{{ env('APP_URL')}}/api/books/1/characters</a></td>
                                <td style="text-align:center;">GET</td>
                                <td>
                                    <p>
                                        This will return a JSON response of the characters for the book with an <b>id</b> of 1.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td><a href="{{ env('APP_URL')}}/api/characters" target="_blank">{{ env('APP_URL')}}/api/characters</a></td>
                                <td style="text-align:center;">GET</td>
                                <td>
                                    <p>
                                        Returns a JSON response of all available book characters.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td><a href="{{ env('APP_URL')}}/api/characters/23" target="_blank">{{ env('APP_URL')}}/api/characters/23</a></td>
                                <td style="text-align:center;">GET</td>
                                <td>
                                    <p>
                                        Return a JSON response with the character details with an <b>id</b> of 23.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td><a href="{{ env('APP_URL')}}/api/comments" target="_blank">{{ env('APP_URL')}}/api/comments</a></td>
                                <td style="text-align:center;">POST</td>
                                <td>
                                    <p>
                                        Send a POST request to this endpoint to add a comment for a particular book that is identified by its ISBN number. Required params are: <br />
                                        <ol style="list-style-position: inside">
                                            <li>isbn - ISBN number - text</li>
                                            <li>comment - The comment text - limited to 500 characters</li>
                                        </ol>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="doc-item" id="structure">
                <div class="doc-item-title">
                    <h2>Response Structure</h2>
                </div>
                <div class="doc-item-body">
                    <p>
                        <ul style="font-weight: 300; list-style-position:inside;">
                            <li>All responses for the endpoints defined will be in <em>JSON</em> format and a header for <em>Content-Type: 'Application/json'</em> will be sent.</li>
                            <li>All response objects with have an object named <b>data</b> that will hold the payload e.g. an array of characters or books, a book, a comment, etc.</li>
                            <li>All response objects with have an object named <b>success</b> that will hold either 1 representing success, 0 represnting failed and -1 representing and invalid request type.</li>
                            <li>Incase of an error, a data object named <b>message</b> will be included to show the specific error details.</li>
                        </ul>
                        See below example:
                        <pre style="padding: 1rem; font-weight:300; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif ">
                            {
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
                        </pre>
                    </p>
                </div>
            </div>
            <div class="doc-item" id="pagination">
                <div class="doc-item-title">
                    <h2>Pagination</h2>
                </div>
                <div class="doc-item-body">
                    <p>Results for requests that respond with lists e.g. books' list and characters' list, will be paginated. You can make a request and specify a page and pageSize as GET URL parameters. The pagination links are also included
                        by default in the JSON object response named "pages". The 'pages' object has links with the keys 'prev', 'first' & 'last' and a 'total_pages' object. You can use to create pagination for your app that
                        will consume our API.
                    </p>
                    <p>
                        An example like below:
                        <code>
                            curl {{ env('APP_URL') }}/api/books?page=2&pageSize=10
                        </code>
                        The results will look like below:
                        <pre>
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
                                    "comments": []
                                    },
                                ...],
                                "pages": {
                                    "prev": "http://localhost:8000/api/books?page=1&pageSize=10",
                                    "first": "http://localhost:8000/api/books?page=1&pageSize=10",
                                    "last": "http://localhost:8000/api/books?page=2&pageSize=10",
                                    "total_pages": 2
                                }
                            }
                        </pre>
                    </p>
                </div>
            </div>
            <div class="doc-item" id="filters">
                <div class="doc-item-title">
                    <h2>Result Filters</h2>
                </div>
                <div class="doc-item-body">
                    <p>
                        You can specify filters via URL GET params for specific results. Available filters for every resource are listed in the next <a href="#usage">section</a>.
                    </p>
                </div>
            </div>
            <div class="doc-item" id="usage">
                <div class="doc-item-title">
                    <h2>Usage</h2>
                </div>
                <div class="doc-item-body">
                    <div class="resource">
                        <h3 id="books">1. Books</h3>
                        <p>
                            <ul>
                                <li>
                                    To get a list of all books use make an HTTP GET request to: {{env('APP_URL')}}/api/books
                                    Example:
                                    <code>
                                        curl "{{env('APP_URL')}}/api/books"
                                    </code>
                                    <div class="filters">
                                        Available filters: <em>&lt;name&gt;</em> <code>e.g. {{env('APP_URL')}}/api/books?name=A Game of Thrones</code>
                                        This will return:
                                        <pre>
                                            {
                                                "success": 1,
                                                "data": [
                                                {
                                                "name": "A Game of Thrones",
                                                "isbn": "978-0553103540",
                                                "authors": [
                                                "George R. R. Martin"
                                            ...}
                                        </pre>
                                    </div>
                                </li>
                                <li>
                                    To get the details of a particular book, make a GET request to the URL: {{env('APP_URL')}}/api/books/&lt;id&gt;
                                    Replace &lt;id&gt; with an integer representing the books id e.g. 1, 2, 3, ... as show below:
                                    <code>
                                        curl "{{env('APP_URL')}}/api/books/1"
                                    </code>
                                    This will return:
                                    <pre>
                                        {
                                            "url": "{{ env('APP_URL') }}api/books/1",
                                            "name": "A Game of Thrones",
                                            "isbn": "978-0553103540",
                                            "authors": [
                                                "George R. R. Martin"
                                            ],
                                            "numberOfPages": 694,
                                            "publisher": "Bantam Books",
                                            "country": "United States",
                                            "mediaType": "Hardcover",
                                            "released": "1996-08-01T00:00:00",
                                            "characters": [...],
                                            "povCharacters": [...]
                                        }
                                    </pre>
                                </li>
                            </ul>
                        </p>
                    </div>
                    <div class="resource">
                        <h3 id="characters">2. Book Characters</h3>
                        <p>
                            <ul>
                                <li>
                                    To get a list of <b>all characters</b> make an HTTP GET request to: {{env('APP_URL')}}/api/characters
                                    Example:
                                    <code>
                                        curl "{{env('APP_URL')}}/api/characters"
                                    </code>
                                    <div class="filters">
                                        Available filters: <em>&lt;name&gt;</em>, <em>&lt;gender&gt;</em>,
                                        <code>e.g. {{env('APP_URL')}}/api/characters?name=Nysterica</code>
                                        This will return:
                                        <pre>
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
                                        </pre>
                                        Another example:
                                        <code>
                                            curl {{env('APP_URL')}}/api/characters?gender=Female
                                        </code>
                                    </div>
                                </li>
                                <li>
                                    To get the <b>details of a particular character</b>, make a GET request to the URL: {{env('APP_URL')}}/api/characters/&lt;id&gt;
                                    Replace &lt;id&gt; with an integer representing the characters id e.g. 1, 2, 3, ... as show below:
                                    <code>
                                        curl "{{env('APP_URL')}}/api/characters/2"
                                    </code>
                                    The response will be:
                                    <pre>
                                        {
                                            "success": 1,
                                            "data": {
                                            "url": "http://localhost:8000/api/characters/2",
                                            "name": "Walder",
                                            "gender": "Male",
                                            "culture": "",
                                            "born": "",
                                            "died": "",
                                            "titles": [...],
                                            ...},
                                            "metadata": {}
                                            }
                                    </pre>
                                </li>
                                <li>
                                    To get a list <b>of all characters in a particular book</b> e.g. 2, make a GET request to the URL: {{env('APP_URL')}}/api/books/&lt;id&gt;/characters
                                    Replace &lt;id&gt; with an integer representing the characters id e.g. 1, 2, 3, ... as show below:
                                    <code>
                                        curl "{{env('APP_URL')}}/api/books/2/characters"
                                    </code>
                                    <div class="filters">
                                        Available filters: <em>&lt;name&gt;</em>, <em>&lt;gender&gt;</em>
                                        <code>e.g. {{env('APP_URL')}}/books/2/characters?name=Nysterica</code>
                                        <code>
                                            e.g. {{env('APP_URL')}}/books/2/characters?gender=Female
                                        </code>
                                        Sample results will be:
                                        <pre>
                                            {
                                                "success": 1,
                                                "data": {
                                                    "book": {
                                                        "name": "A Clash of Kings",
                                                        "isbn": "978-0553108033",
                                                        "url": "http://localhost:8000/api/books/2",
                                                        "authors": [
                                                        "George R. R. Martin"
                                                        ]
                                                    },
                                                    "characters": [ /// all characters in this array will be female
                                                        "{{env('APP_URL')}}/api/characters/2",
                                                        "{{env('APP_URL')}}/api/characters/12",
                                                        "{{env('APP_URL')}}/api/characters/13",
                                                    ]
                                                }
                                            }
                                        </pre>
                                    </div>
                                </li>
                            </ul>
                            <div class="filters">
                                All character list requests are sortable by name in both ascending and descending order. This can be specified via GET URL params:
                                <em>&lt;sortby&gt;</em> & <em>&lt;order&gt;</em>
                                <code>e.g. {{env('APP_URL')}}/characters?gender=Male&sortby=name&order=desc</code>
                                <code>
                                    e.g. {{env('APP_URL')}}/books/2/characters?page=12&pageSize=7&sortby=name&order=asc
                                </code>
                                <small>Default sort order will default to asc (ascending) if not specified.</small>
                            </div>
                        </p>
                    </div>
                    <div class="resource">
                        <h3 id="comments">3. Book Comments</h3>
                        <p>
                            <ul>
                                <li>
                                    To get a list of <b>all comments made for a particular book</b>, make an HTTP GET request to: {{env('APP_URL')}}/api/books/&lt;id&gt;/comments
                                    Replace &lt;id&gt; with a book id e.g. 1, 2, 3, etc.
                                    Example:
                                    <code>
                                        curl "{{env('APP_URL')}}/api/books/2/comments"
                                    </code>
                                    The above will return a list of comments for the book with an id of 2 as below:
                                    <pre>
                                        {
                                            "success": 1,
                                            "data": {
                                                "book": {
                                                    "name": "A Clash of Kings",
                                                    "isbn": "978-0553108033",
                                                    "url": "http://localhost:8000/api/books/2",
                                                    "comment_count": 2,
                                                    "authors": [
                                                        "George R. R. Martin"
                                                    ]
                                                },
                                                "comments": [
                                                    {
                                                    "id": 2,
                                                    "isbn": "978-0553108033",
                                                    "comment": "A good read. This takes you into the real things.",
                                                    "user_ip": "::1",
                                                    "created_at": "2022-03-23 19:34:40"
                                                    },
                                                    {
                                                    "id": 3,
                                                    "isbn": "978-0553108033",
                                                    "comment": "Nice! This takes you into the real thingss.",
                                                    "user_ip": "::1",
                                                    "created_at": "2022-03-23 19:41:59"
                                                    }
                                                ]
                                            }
                                        }
                                    </pre>
                                    <br/>
                                </li>
                                <li>
                                    To <b>add a comment to a particular book</b>, send your POST request to the URL: <code> {{env('APP_URL')}}/api/comments</code> and include the parameters <b>isbn</b> and <b>comment</b>.<br />
                                    Both isbn and comment parameters should of type string and the isbn should be valid for a particular book. The comment parameter is limited to a maximum of 500 characters.<br/>
                                    Generally, a POST request is sent via an HTML form. The data send to the form is usually encoded in either multipart/form-data, application/json or application/x-www-form-urlencoded content type.
                                </li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="doc-item" id="limits">
                <div class="doc-item-title">
                    <h2>Limitations</h2>
                </div>
                <div class="doc-item-body">
                    <p>You can unlimited requests in a day to the API as long you don't exceed 60 requests per minute. Exceeding this minute limit will have your requests rejected for a preiod of 5 minutes.</p>
                </div>
            </div>
            <div class="doc-item" id="license">
                <div class="doc-item-title">
                    <h2>Licensing & Copyright</h2>
                </div>
                <div class="doc-item-body">
                    <p>We make no ownership of the data we provide via our API. This is an API extension of the <b>'AN API OF ICE AND FIRE'</b> by <a href="https://github.com/joakimskoog/">Joakim Skoog.</a><br />
                    More details on the API are available at <a href="https://anapioficeandfire.com/">AN API OF ICE AND FIRE</a>
                    </p>
                    <p>This project uses a MIT license.</p>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <span>&copy; 2022 - David Syengo. {{env('APP_URL')}}</span>
        <span><a href="https://github.com/syengo254">
            <img style="background: white; margin-left:2rem;" src="{{ URL::asset('img/icons8-github-30.png') }}" alt="GitHub profile link icon" />
        </a></span>
    </footer>
</body>
</html>