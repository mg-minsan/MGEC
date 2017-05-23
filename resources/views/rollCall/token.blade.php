<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>


    </head>
    <body>
        <form action="/generateToken" method="POST">
            {{ csrf_field() }}
            <button> Generate </button>
        </form>
    </body>
</html>
