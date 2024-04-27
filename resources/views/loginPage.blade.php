<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login</title>
      @vite('resources/css/loginPage.css') 
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Login
         </div>
         <form action="#">
            <div class="field">
               <input type="text" required>
               <label>Email Address</label>
            </div>
            <div class="field">
               <input type="password" required>
               <label>Password</label>
            </div>
            <div class="content">
               <div class="checkbox">
                  <input type="checkbox" id="remember-me">
                  <label for="remember-me">Remember me</label>
               </div>
               <div class="pass-link">
                  <a href="{{ url('/forgotPassword') }}">Forgot password?</a>
               </div>
            </div>
            <div class="field">
               <input type="submit" value="Login">
               <a href="{{ url('/home') }}">Langsungan!!</a>
            </div>
            {{-- <div class="signup-link">
               Not a member? <a href="#">Signup now</a>
            </div> --}}
         </form>
      </div>
   </body>
</html>