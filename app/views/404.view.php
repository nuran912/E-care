<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            background-color: #f9f9f9;
            color: #0E2F56;
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        h1 {
            font-size: 6em;
            margin: 0;
            color: #0d62cb;
        }
        p {
            font-size: 1.5em;
            color: #5FBDB0;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #0d62cb;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #93DEFF;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>Oops! The page you are looking for cannot be found.</p>
        <a href="<?= ROOT ?>">Go to Homepage</a>
    </div>
</body>
</html>