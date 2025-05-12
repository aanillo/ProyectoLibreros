<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreros</title>
    <link rel="icon" type="image/x-icon" href="../public/img/LogoInicial.jpg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Brawler]">

    @include('partials.headerLog') 

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-52">
        
    <h1 class="text-center text-3xl font-semibold mb-8">Editar Usuario</h1>

    <h2 class="text-center text-2xl font-semibold mb-6">{{ $user->nombre }} {{ $user->apellidos }}</h2>

    <form method="POST" action="{{ route('updatePsw', $user->id) }}"
        class="w-full max-w-2xl min-h-[300px] p-6 bg-amber-200 border-2 border-[#322411] rounded-2xl flex flex-col space-y-4">
        @csrf
        @method('PUT')

        <label for="password" class="w-full text-center" x-data="{ show: false }">
                <span class="block text-lg font-medium">Contraseña:</span>
                <div class="relative w-full sm:w-4/5 mx-auto">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                    <input :type="show ? 'text' : 'password'" name="password" id="password"
                        class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1">
                    <button type="button" @click="show = !show"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600 text-sm">
                        <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </button>
                </div>
            </label>
            @error("password") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

            
            <label for="password_repeat" class="w-full text-center mb-8" x-data="{ repeat: '', original: '' }"
                x-init="original = document.getElementById('password').value">
                <span class="block text-lg font-medium">Repita su contraseña:</span>
                <div class="relative w-full sm:w-4/5 mx-auto">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                    <input type="password" name="password_repeat" id="password_repeat"
                        x-model="repeat"
                        class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                        @input="original = document.getElementById('password').value">
                    <template x-if="repeat && repeat === original">
                        <i class="fas fa-check-circle absolute right-3 top-1/2 transform -translate-y-1/2 text-green-500"></i>
                    </template>
                    <template x-if="repeat && repeat !== original">
                        <i class="fas fa-times-circle absolute right-3 top-1/2 transform -translate-y-1/2 text-red-500"></i>
                    </template>
                </div>
            </label>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-16">
                <button class="bg-green-500 font-bold text-black border-2 border-black px-6 py-2 rounded-md hover:bg-green-700"
                    type="submit">Actualizar Contraseña</button>
                <button class="bg-red-500 font-bold text-black border-2 border-black px-6 py-2 rounded-md hover:bg-red-700"
                    type="reset">Cancelar</button>
            </div>
    </form>

        <div class="flex flex-row items-center gap-16">
        <div class="flex items-center gap-4 mb-16 mt-16">
            <h3 class="text-lg">Volver atrás:</h3>
            <a href="{{ url()->previous() }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Volver</a>
        </div>

        <div class="flex items-center gap-4 mb-16 mt-16">
            <h3 class="text-lg">Volver a Home:</h3>
            @auth
                <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Home</a>
            @else
                <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Home</a>
            @endauth
        </div>
   </div> 

        <img src="{{ asset('img/book2.jpg') }}" class="w-80 h-auto my-6 mb-16" alt="Libro" />

    </main>

    @include('partials.footer')

</body>
</html>
