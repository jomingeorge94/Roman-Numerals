<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Roman Numerals API Task</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Task 1
        </div>

        <p>Accepts an integer, converts it to a roman numeral, stores it in the database and returns the response.</p>

        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <p style="color: crimson; font-weight: 900" class="font-weight-light pt-0">
                        {{$error}}
                    </p>
                </div>
            @endforeach
        @endif

        <form action="{{route('conversion_handler')}}" method="post">
            @csrf
            <label for="integer">Please enter a integer between 1 and 3999:</label><br><br>
            <input type="text" id="integer" name="integer"><br><br>
            <input type="submit" value="Convert">
        </form>

        @if(isset($response))
            <div style="margin-top: 50px">
                <h4 style="text-decoration: underline">Response: </h4>
                <p style="font-size: 12px">Chosen integer : {{$response['integer']}}</p>
                <p style="font-size: 12px">Roman numeral : {{$response['roman_numeral']}}</p>
                <p style="font-size: 12px">Number of times converted : {{$response['number_of_times_converted']}}</p>
                <p style="font-size: 12px">Last time converted : {{ \Carbon\Carbon::parse($response['last_time_converted'])->format('dS F Y H:i:s') }}</p>
            </div>

        @endif
    </div>
</div>
</body>
</html>
