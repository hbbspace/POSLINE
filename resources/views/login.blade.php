<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>POSLINE</title>
    <style>
        .custom-border {
            border-color: #098DB3;
            border-radius: 3px;
        }
        .custom-button {
            background-color: #098DB3;
        }
        .custom-button:hover {
            background-color: #086b8c;
        }
        .focus-custom-button:focus {
            outline-color: #098DB3;
        }
    </style>
</head>
<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-40 w-43" src="{{ url('img/logo.png') }}" alt="Your Company">
            <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login</h2>
        </div>

        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm border-2 custom-border p-6">
            <form class="space-y-6" action="{{ route('proses_login') }}" method="POST">
                @csrf
                
                <!-- Pesan Sukses -->
                @if(session('success'))
                    <div class="alert alert-success relative bg-green-100 border border-green-400 text-green-600 px-4 py-3 rounded" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <button type="button" class="absolute top-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                            <span class="text-green-600">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger relative bg-red-100 border border-red-400 text-red-600 px-4 py-3 rounded" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <button type="button" class="absolute top-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                            <span class="text-red-600">&times;</span>
                        </button>
                    </div>
                @endif

                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                    <div class="mt-2">
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#098DB3] sm:text-sm sm:leading-6" autofocus>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="/forgotPassword" class="font-semibold text-[#098DB3] hover:text-[#086b8c]">Lupa Password?</a>
                        </div>
                    </div>
                    <div class="mt-2 relative">
                        <input id="password" type="password" name="password" placeholder='*******' required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#098DB3] sm:text-sm sm:leading-6">
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                            <svg id="eyeIcon" class="h-5 w-5 text-gray-500" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <button type="submit" class="custom-button flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-[#086b8c] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-custom-button">Sign in</button>
                </div>
            </form>

        </div>
        <p class="mt-10 text-center text-sm text-gray-500">
            Posyandu Selalu Ada Untukmu
        </p>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            } else {
                passwordField.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.98 8.928A9.956 9.956 0 002.458 12c1.274 4.057 5.065 7 9.542 7 4.477 0 8.268-2.943 9.542-7a9.956 9.956 0 00-1.522-3.072M3.98 8.928A4.978 4.978 0 017.747 7.62m2.001-1.746A4.978 4.978 0 0112 5c1.032 0 2.016.313 2.817.874m2.001 1.746A4.978 4.978 0 0117.623 8.93m0 6.142A4.978 4.978 0 0116.253 16.38m-2.001 1.746A4.978 4.978 0 0112 19a4.978 4.978 0 01-2.817-.874m-2.001-1.746A4.978 4.978 0 017.747 15.07M7 12h.01" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12h.01" />
                `;
            }
        }
    </script>
</body>
</html>
