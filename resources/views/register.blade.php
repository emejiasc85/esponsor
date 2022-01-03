<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro - Sponsor</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="h-screen bg-indigo-100 flex justify-center items-center">
            <div class="lg:w-2/5 md:w-1/2 w-2/3">
                <form class="bg-white p-10 rounded-lg shadow-lg min-w-full" action="/register" method="POST" >
                    @csrf
                    <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Formulario de Registro</h1>
                    <div>
                        <label class="text-gray-800 font-semibold block my-3 text-md" for="name">Nombre</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="name" id="name" placeholder="Nombre Completo" />
                        @error('name')
                            <span class="text-sm text-red-500 ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 font-semibold block my-3 text-md" for="username">Usuario</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="username" id="username" placeholder="username" />
                        @error('username')
                            <span class="text-sm text-red-500 ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 font-semibold block my-3 text-md" for="email">Email</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="email" name="email" id="email" placeholder="@email" />
                        @error('email')
                            <span class="text-sm text-red-500 ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 font-semibold block my-3 text-md" for="password">Contraseña</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="password" id="password" placeholder="password" />
                        @error('password')
                            <span class="text-sm text-red-500 ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 font-semibold block my-3 text-md" for="confirm">Confirmar Contraseña</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="password_confirmation" id="confirm" placeholder="confirm password" />
                    </div>
                    <div>
                        <button type="submit" class="w-full mt-6 bg-indigo-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Registrarme</button>
                    </div>
                    <div class="w-full mt-6 mb-3 text-center">
                        <a href="/login" class=" mt-6 mb-3   px-4 py-2 text-lg text-gray-800 font-semibold font-sans">Iniciar sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>