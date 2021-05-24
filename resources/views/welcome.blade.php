<!DOCTYPE html>
<html>
<style>
    body, html {
        height: 100%;
        margin: 0;
    }

    .topleft {
        position: absolute;
        top: 0;
        left: 16px;
    }

    .middle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    hr {
        margin: auto;
        width: 40%;
    }
</style>
<body>

<div class="bgimg">
    <div class="topleft">
        <p>ASPIRE MINI</p>
    </div>
    <div class="middle">
        <h1>Welcome to Aspire</h1>
        <hr>
        <p><a href="{{route('login')}}">Login</a></p>
        <p><a href="{{route('register')}}">Register</a></p>
    </div>
</div>

</body>
</html>
