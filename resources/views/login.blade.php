<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>歡迎</title>
    <link rel="stylesheet" href={{ asset('css/login.css') }}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class='top-box'>
        <div class='pic'>
            <img src={{ asset('image/nijisanji.png') }}></img>
        </div>
        <div class='welcome'>welcome to nijisanji en schedule</div>
    </div>

    <div class='body'>
        <div class='account'>
            <input type="text" placeholder="&#61447; Username">
        </div>
        <div class='pwd'>
            <input type="password" placeholder="&#128274; Password">
        </div>
        <div class='submit'>
            <input type="submit" value="登入">
        </div>
    </div>
</body>

</html>
