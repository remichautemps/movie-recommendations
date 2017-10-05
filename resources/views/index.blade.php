<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Favcon -->
        <link rel="icon" href="favicon.ico" type="image/x-icon" />

        <style type="text/css">

            ::selection { background-color: #E13300; color: white; }
            ::-moz-selection { background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #body {
                margin: 15px;
            }

            #container {
                margin: 10px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }

            input[type="submit"] {
                margin-top: 10px;
            }
        </style>

    </head>
    <body>
        <div id="container">
            <h1>Movie Recommendations</h1>
            <div id="body">
                <form role="form" method="GET" action="/search">
                    <div>
                        <label>Genre</label>
                        <div>
                            <input type="text" placeholder="Animation" name="genre">
                            @if ($errors->has('genre'))
                                <span>
                                    <strong>{{ $errors->first('genre') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <label>Showing</label>
                        <div>
                            <input type="text" placeholder="07:00" name="showing">
                            @if ($errors->has('showing'))
                                <span>
                                    <strong>{{ $errors->first('showing') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <input type="submit" value="Search">
                    </div>
                </form>
                @if(isset($movies) && count($movies) > 0)
                    @foreach ($movies as $movie)
                        <p>{{ $movie }}</p>
                    @endforeach
                @endif
            </div>
        </div>
    </body>
</html>
