@extends('layouts/userLO')

@section('main')
<!DOCTYPE html>
<html>
<head>
    <title>About Us</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        height: 100vh;
        width: 100%;
    }

    .container {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 100px;
    }

    .container:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: url("{{ asset('uploads/bg.jpg') }}") no-repeat center;
        background-size: cover;
        filter: blur(50px);
        z-index: -1;
    }

    .about-box {
        max-width: 850px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        justify-content: center;
        align-items: center;
        text-align: center;
        background-color: #fff;
        box-shadow: 0px 0px 19px 5px rgba(0,0,0,0.19);
        animation: fadeIn 2s ease-in-out;
    }

    .left {
        background: url("{{ asset('uploads/about.jpg') }}") no-repeat center;
        background-size: cover;
        height: 100%;
    }

    .right {
        padding: 25px 40px;
    }

    h2 {
        position: relative;
        padding: 0 0 10px;
        margin-bottom: 10px;
    }

    h2:after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        height: 4px;
        width: 50px;
        border-radius: 2px;
        background-color: #0066ff;
    }

    p {
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @media screen and (max-width: 880px) {
        .about-box {
            grid-template-columns: 1fr;
        }
        .left {
            height: 200px;
        }
    }
</style>
<body>
    <div class="container">
        <div class="about-box">
            <div class="left"></div>
            <div class="right">
                <h2>About Us</h2>
                <p>Welcome to our website! We are dedicated to providing the best service possible. Our team is made up of experienced professionals who are passionate about what they do. We believe in the power of education and strive to make learning accessible to everyone.</p>
                <p>Our mission is to empower individuals through knowledge and skills. We offer a wide range of courses and resources to help you achieve your goals. Thank you for choosing us as your learning partner.</p>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
