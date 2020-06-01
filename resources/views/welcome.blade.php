<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Evaluation Management System for PWU CDCEC</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <br>
    <h1 class="text-center">Student Evaluation Management System</h1>
    <div class="row justify-content-center">
        <div class="col-md-4 px-5 text-center">
           
            <img src="/img/welcome_logo.svg" alt="" class="img-fluid">
            <br>
            <br>
            @auth
                <a href="/home" class="btn btn-primary btn-lg btn-block">Go Home</a>
            @else
            <a href="/login" class="btn btn-primary btn-lg btn-block">Login</a>
            @endauth
            
        </div>
    </div>
</body>
</html>