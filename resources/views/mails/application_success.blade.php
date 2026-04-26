<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>

    <h1>Thanks for your application.</h1>
    
    <p>Please use the below login credential to get the access of the site</p>
    <p>Application ID: {{$details['system_id']}}</p>
    <p>Password: {{ $details['password'] }}</p>
    <p>Login: {{route('login')}}</p>

    <span>--</span>
    <p>Regards</p>
    <p>Website: <a href="{{route('home')}}"> UPMS</a>  </p>
</body>
</html>