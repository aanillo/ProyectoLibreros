<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreros</title>
    <link rel="icon" type="image/x-icon" href="../public/img/LogoInicial.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Brawler]">

    @include('partials.headerLog') 

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-52">
        
        <section class="text-center mb-8">
            <h1 class="text-4xl font-bold">PERFIL</h1>
            <div class="flex flex-col md:flex-row items-center md:items-start bg-amber-200 shadow-lg rounded-xl p-6 md:p-10 gap-8 mt-8">
                
                
                <div class="w-60 h-60 flex-shrink-0 mt-4">
                    <img src="{{ asset('img/default-profile.png') }}" alt="Foto de perfil" class="w-full h-full object-cover rounded-full border border-gray-300">
                </div>

                
                <div class="text-left text-black space-y-4 text-xl">
                    <p><strong>Nombre: </strong>{{ $user->nombre }}</p>
                    <p><strong>Apellidos: </strong>{{ $user->apellidos }}</p>
                    <p><strong>Username: </strong>{{ $user->username }}</p>
                    <p><strong>Correo: </strong>{{ $user->email }}</p>
                    <p><strong>Localidad: </strong>{{ $user->localidad }}</p>
                    <p><strong>Fecha nacimiento: </strong>{{ \Carbon\Carbon::parse($user->fecha_nacimiento)->format('d/m/Y') }}</p>
                    <p><strong>Fecha de registro: </strong>{{ $user->created_at->format('d/m/Y') }}</p>
                </div>

            </div>

        </section>

        <div class="flex items-center gap-16 mb-8 mt-8">
            <div class="flex flex-col items-center">
                <h3 class="text-lg">Editar perfil:</h3>
                <a href="{{ route('editProfile', ['id' => $user->id]) }}" class="btnHome bg-blue-500 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-blue-600">Editar</a>
            </div>
            <div class="flex flex-col items-center">
                <h3 class="text-lg">Cambiar contraseña:</h3>
                <a href="{{ route('editPsw', ['id' => $user->id]) }}" class="btnHome bg-yellow-500 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Reestablecer</a>
            </div>
            <div class="flex flex-col items-center">
                <h3 class="text-lg">Eliminar cuenta:</h3>
                <a href="{{ route('deleteShow', ['id' => $user->id]) }}" class="btnHome bg-red-500 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-red-600">Eliminar</a>
            </div>
        </div>

        <div class="flex items-center gap-4 mb-16 mt-8">
            <h3 class="text-lg">Volver atrás:</h3>
            <a href="{{ route('home') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Volver</a>
        </div>

    </main>

    @include('partials.footer')

</body>
</html>
