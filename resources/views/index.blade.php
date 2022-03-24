<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500&display=swap" rel="stylesheet">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            width: 1024px;
            margin: 0 auto;
            background: #fcfcfc;
        }
        h1, h2, h3 {
            text-align: center;
        }
        header{
            margin: 1rem 0;
        }
        header > nav {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            margin-right: 5rem;
        }
        header > nav > a {
            margin: 1rem;
            text-decoration: none;
            font-size: 1rem;
        }

        a:visited, a:active {
            color: #0000ee;
        }

        header > nav > a:hover {
            text-decoration: underline;
        }

        code {
            line-height: 1.2rem;
            display: block;
            padding:.4rem .5rem;
            background: #eee;
            border-left: 3px solid green;
            margin: 1rem 0; 
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
    <title>Welcome to An Extended API of Ice & Fire | Home Page</title>
</head>
<body>
    <header>
        <nav>
            <a href="" style="text-decoration: underline;">Home</a>
            <a href="/api/docs">Docs</a>
        </nav>
    </header>
    <main>
        <h1>Welcome to Top Mama's Books API</h1>
        <p style="margin-top: 1rem">This API is open to the public! Read our <a href="/api/docs">documentation guide</a> to get started or use the starter request command below from your CLI terminal:<br />
            <code>curl {{ env('APP_URL')}}/api/books</code>
        </p>
    </main>
</body>
</html>