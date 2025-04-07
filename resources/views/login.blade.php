<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen text-white font-[Brawler]">

    @include('partials.header')

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-48">
        <h1 class="text-center text-3xl font-semibold mb-8">Login</h1>

        <form method="POST" action="{{ route('doLogin') }}" class="login w-[650px] min-h-[400px] p-6 bg-yellow-300 border-2 border-solid border-[#322411] rounded-2xl flex flex-col justify-between items-center space-y-2">
            @csrf

            <label for="email" class="w-full text-center">
                <span class="block text-lg font-medium">Correo:</span>
                <div class="relative w-[80%] mx-auto">
                    <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                    <input type="email" name="email" id="email" class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-0.5" placeholder="Escribe tu correo">
                </div>
            </label>
            @error("email") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

            <label for="password" class="w-full text-center">
                <span class="block text-lg font-medium">Contraseña:</span>
                <div class="relative w-[80%] mx-auto">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                    <input type="password" name="password" id="password" class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-0.5">
                </div>
            </label>
            @error("password") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

            <div class="flex space-x-4 mt-2">
                <button class="btnAceptar bg-green-500 font-bold text-white px-6 py-2 rounded-md hover:bg-green-600" type="submit">Login</button>
                <button class="btnCancelar bg-red-500 font-bold text-white px-6 py-2 rounded-md hover:bg-red-600" type="reset">Cancelar</button>
            </div>

            <div class="flex space-x-4 mt-2">
                <p>Si aún no estás registrado, pulsa el siguiente botón</p>
                <a href="{{ route('register.show') }}" class="btnRegistro bg-blue-500 text-white font-bold px-6 py-2 rounded-md hover:bg-blue-600">Registrarse</a>
            </div>
        </form>



        <div class="flex items-center gap-4 mt-8">
            <h3 class="text-lg">Volver a Home:</h3>
            <a href="{{ url('/') }}" class="btnHome bg-yellow-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Home</a>
        </div>

        <img src="{{ asset('img/libros.jpg') }}" class="w-80 h-auto my-6" alt="Libros" />

    </main>

    @include('partials.footer')

</body>


</html>
