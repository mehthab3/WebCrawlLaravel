<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Data</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #000000 ;
                font-family: 'Raleway', sans-serif;
                font-weight: 150;
                height: 100vh;
                margin: 0;
            }
            .button {
              background-color: #4CAF50; /* Green */
              border: none;
              color: white;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin: 4px 2px;
              cursor: pointer;
            }
            
        </style>
    </head>
    
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <body>
        

        <div class="container" align="center">

                 <form method="POST" action="/home">
                {{ csrf_field() }}                                    
                   <label> Enter URL</label>
                   <input type="text" name="url">
                   <input type="submit" class="button" value="Submit">
                </form>
        </div>
    </body>
</html>
