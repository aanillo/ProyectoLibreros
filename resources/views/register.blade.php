<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen text-white font-[Brawler]">

    @include('partials.header')

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-48">
        <h1 class="text-center text-3xl font-semibold mb-8">Registro</h1>

        <form method="POST" action="{{ route('doRegister') }}" class="register w-[650px] min-h-[500px] p-6 bg-yellow-300 border-2 border-solid border-[#322411] rounded-2xl flex flex-col justify-between items-center space-y-4">
            @csrf
            <label for="nombre" class="w-full text-center">
                <span class="block text-lg font-medium">Nombre:</span>
                <div class="relative w-[80%] mx-auto">
                    <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                    <input type="text" name="nombre" id="nombre" class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-1" placeholder="Escribe tu nombre">
                </div>
            </label>
            @error("nombre") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

            <label for="apellidos" class="w-full text-center">
                <span class="block text-lg font-medium">Apellidos:</span>
                <div class="relative w-[80%] mx-auto">
                    <i class="fas fa-user-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                    <input type="text" name="apellidos" id="apellidos" class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-1" placeholder="Escribe tus apellidos">
                </div>
            </label>
            @error("apellidos") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

            <label for="username" class="w-full text-center">
                <span class="block text-lg font-medium">Username:</span>
                <div class="relative w-[80%] mx-auto">
                    <i class="fas fa-user-tag absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                    <input type="text" name="username" id="username" class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-1" placeholder="Escribe tu username">
                </div>
            </label>
            @error("username") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

            <label for="email" class="w-full text-center">
                <span class="block text-lg font-medium">Correo:</span>
                <div class="relative w-[80%] mx-auto">
                    <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                    <input type="email" name="email" id="email" class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-1" placeholder="Escribe tu correo">
                </div>
            </label>
            @error("email") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

            <label for="fecha_nacimiento" class="w-full text-center">
                <span class="block text-lg font-medium">Fecha de nacimiento:</span>
                <div class="relative w-[80%] mx-auto">
                    <i class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-1">
                </div>
            </label>
            @error("fecha_nacimiento") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

            <label for="localidad" class="w-full text-center">
                <span class="block text-lg font-medium">Localidad:</span>
                <div class="relative w-[80%] mx-auto">
                    <i class="fas fa-map-marker-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                    <input type="text" name="localidad" id="localidad" class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-1" placeholder="Escribe la localidad">
                </div>
            </label>
            @error("localidad") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

            <label for="password" class="w-full text-center">
                <span class="block text-lg font-medium">Contraseña:</span>
                <div class="relative w-[80%] mx-auto">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                    <input type="password" name="password" id="password" class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-1">
                </div>
            </label>
            @error("password") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

            <label for="password_repeat" class="w-full text-center">
            <span class="block text-lg font-medium">Repita su contraseña:</span>
            <div class="relative w-[80%] mx-auto">
                <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="password" name="password_repeat" id="password_repeat" class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-1">
            </div>
            </label>
            @error("password") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

            <div class="flex space-x-4 mt-4">
                <button class="btnAceptar bg-green-500 text-white font-bold px-6 py-2 rounded-md hover:bg-green-600" type="submit" value="Registrarse">Registrarse</button>
                <button class="btnCancelar bg-red-500 text-white font-bold px-6 py-2 rounded-md hover:bg-red-600" type="reset" value="Cancelar">Cancelar</button>
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

<!--
<script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&libraries=places&callback=initAutocomplete" async defer></script>

<script>
    function initAutocomplete() {
        var input = document.getElementById('localidad');
        var options = {
            types: ['geocode'], 
            componentRestrictions: { country: 'es' }
        };
        var autocomplete = new google.maps.places.Autocomplete(input, options);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            console.log('Ubicación seleccionada:', place);
        });

        input.addEventListener('input', function() {
            console.log('Input detectado:', input.value);
        });
    }
</script>
-->

</html>
