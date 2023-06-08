<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Next Level Animated Login Form</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap");

    * {
      box-sizing: border-box;
      padding: 0;
      margin: 0;
      font-family: "Quicksand", sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #000;
    }

    section {
      position: absolute;
      height: 100vh;
      width: 100vw;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 2px;
      flex-wrap: wrap;
      overflow: hidden;
    }

    section::before {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      background: linear-gradient(#000, #0f0, #000);
      animation: animate 5s linear infinite;
    }

    @keyframes animate {
      0% {
        transform: translateY(-100%);
      }

      100% {
        transform: translateY(100%);
      }
    }

    section span {
      position: relative;
      display: block;
      width: calc(6.25vw - 2px);
      height: calc(6.25vw - 2px);
      background-color: #181818;
      z-index: 2;
      transition: 1.5s;
    }

    section span:hover {
      background-color: #0f0;
      transition: 0s;
    }

    section .signin {
      position: absolute;
      width: 400px;
      background-color: #222;
      z-index: 1000;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
      border-radius: 4px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 5);
    }

    section .signin .content {
      position: relative;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      gap: 40px;
    }

    section .signin .content h2 {
      font-size: 2em;
      color: green;
      text-transform: uppercase;
    }

    section .signin .content .form {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 25px;
    }

    section .signin .content .form .inputBx {
      position: relative;
      width: 100%;
    }

    section .signin .content .form .inputBx input {
      position: relative;
      width: 100%;
      background-color: #333;
      border: none;
      outline: none;
      padding: 25px 10px 7.5px;
      border-radius: 4px;
      color: #fff;
      font-weight: 500;
      font-size: 1em;
    }

    section .signin .content .form .inputBx i {
      position: absolute;
      left: 0;
      padding: 15px 10px;
      font-style: normal;
      color: #aaa;
      transition: 0.5s;
      pointer-events: none;
    }

    .signin .content .form .inputBx input:focus~i,
    .signin .content .form .inputBx input:valid~i {
      transform: translateY(-7.5px);
      font-size: 0.8em;
      color: #fff;
    }

    .signin .content .form .links {
      position: relative;
      width: 100%;
      display: flex;
      justify-content: space-between;
    }

    .signin .content .form .links a {
      color: #fff;
      text-decoration: none;
    }

    .signin .content .form .links a:nth-child(2) {
      color: green;
      font-weight: 600;
    }


    .signin .content .form .inputBx input[type="submit"] {
      padding: 10px;
      background-color: #0f0;
      color: #111;
      font-weight: 600;
      font-size: 1.25em;
      letter-spacing: 0.05em;
      cursor: pointer;
    }

    @media (max-width: 900px) {
      section span {
        width: calc(10vw - 2px);
        height: calc(10vw - 2px);
      }
    }

    @media (max-width: 600px) {
      section span {
        width: calc(20vw - 2px);
        height: calc(20vw - 2px);
      }
    }
  </style>
</head>

<body>
  <section>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>



    <div class="signin">
      <div class="content">
        <h2>Sign In as {{ $type }}</h2>
        <form class="form" method="POST" action="{{ route('login', $type) }}">
          @csrf
          <div class="inputBx">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
              name="email" value="qusay@gmail.com" required autocomplete="email">
            <i>Email</i>
            @error('email')
              <div class="invalid-feedback" role="alert" style="color: red;">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>
          <div class="inputBx">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
              name="password" required autocomplete="current-password" value="123123123">
            <i>Password</i>
            <!--@error('password')-->
            <!--  <span class="invalid-feedback" role="alert">-->
            <!--    <strong>{{ $message }}</strong>-->
            <!--  </span>-->
            <!--@enderror-->
          </div>
          <div class="links">

            <!--@if (Route::has('password.request'))-->
            <!--  <a href="{{ route('password.request') }}">-->
            <!--    Forgot Password-->
            <!--  </a>-->
            <!--@endif-->

            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} >
            <a style="display: inline-block; margin-right: 60%;"> Remember Me </a>

          </div>
          <div class="inputBx">
            <input type="submit" value="Login">
          </div>
        </form>

      </div>
    </div>


  </section>
</body>

</html>
