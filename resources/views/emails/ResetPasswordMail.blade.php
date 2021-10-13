<!DOCTYPE html>
<html>

<head>
    <title>Artise.africa</title>
</head>

<body>
    <h3>{{ $details['title'] }}</h3>
    <p>Enter this verification code on the reset password page to complete your reset password process:</p>
    <div style="background-color:#000;padding:20px">
        <span style="font-size:20px; color: #FBAD02 !important">
            <strong>{{ $details['code'] }}</strong>
        </span>
    </div>


    <p>Thank you</p>
</body>

</html>