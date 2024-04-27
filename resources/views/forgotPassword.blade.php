<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login Form Design | CodeLab</title>
      @vite('resources/css/loginPage.css') 
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
             Repassword
         </div>
         <form action="#">
            <div class="field">
               <input type="text" required>
               <label>Username</label>
            </div>
            <div class="field">
               <input type="password" required>
               <label>Old Password</label>
            </div>
            <div class="field">
               <input type="password" required>
               <label>New Password</label>
            </div>
            <div class="content">
               <a href="{{ url('/login') }}">Login Page</a>
            </div>
            <div class="field">
               <input type="submit" value="Verify">
            </div>
            {{-- <div class="signup-link">
               Not a member? <a href="#">Signup now</a>
            </div> --}}
         </form>
      </div>
   </body>
</html>