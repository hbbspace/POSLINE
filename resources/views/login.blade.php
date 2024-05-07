<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>POSLINE</title>
</head>
<body class="h-full">
            
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-40 w-43" src="{{ url('img/logo.png')}}" alt="Your Company">
            <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login</h2>
            </div>
        
            <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('proses_login') }}" method="POST">
                @csrf
                <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                <div class="mt-2">
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" autofocus>
                </div>
                </div>
        
                <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <div class="text-sm">
                    <a href="/forgotPassword" class="font-semibold text-blue-600 hover:text-blue-500">Lupa Password?</a>
                    </div>
                </div>
                <div class="mt-2">
                    <input type="password" name="password" placeholder='*******' required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                </div>
                </div>
        
                <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Sign in</button>
                </div>
            </form>
        
            <p class="mt-10 text-center text-sm text-gray-500">
                Posyadu Selalu Ada Untukmu
            </p>
            </div>
        </div>
  
</body>
</html>