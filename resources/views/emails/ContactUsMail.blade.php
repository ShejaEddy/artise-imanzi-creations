<!DOCTYPE html>
<html>

<head>
    <title>Artise.africa</title>
</head>

<body>

    <article style="border-radius:10px;background-color:#000; color:#fff; padding:40px; margin:0 auto; width:80%; height: auto;">
        <h3>{{ $details['title'] }}</h3>
        <b style="color:orange">Names: </b>{{$details['names']}}<br>
        <b style="color:orange">Email: </b><span style="color:#fff !important;">{{$details['email']}}</span><br>
        <hr>
        <b style="color:orange">Message: </b>{{$details['message']}}
    </article>
</body>

</html>