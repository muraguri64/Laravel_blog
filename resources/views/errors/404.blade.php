<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Blog | Page Not Found.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">


        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 62px;
                margin-bottom: 40px;
            }
            .title2{
                 font-size: 32px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">                
                <div class="title">Whoops!!</div>
                <div class="image">
                <img src="{{ asset('img/error/sad.png') }}" class="img-responsive" height="150px" width="200px" alt="sad-emoji">
                </div>
                <div class="title">Page not found !!</div>
                
                <div class="title2">
                    <div class="col-sm-4"><a href="{{route('pages.index')}}">Visit Homepage</a></div>                   
                </div>
            </div>
        </div>
    </body>
</html>