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

    @include('partials.headerAdmin') 

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-48">
        
        <section class="text-center mb-8">
            <h1 class="text-3xl font-bold">USUARIOS</h1>
        </section>

        <div class="flex-grow flex flex-row items-center gap-4 mb-8">
            <h3 class="text-lg">Registrar usuario:</h3>
            <a href="#" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Registrar</a>
        </div>

        <section>
        <div class="overflow-x-auto">
            <h2 class="text-2xl text-center font-bold mb-6">Lista de usuarios</h2>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-[#322411] text-left text-lg">
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Apellidos</th>
                            <th class="px-4 py-2">Username</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Fecha nacimiento</th>
                            <th class="px-4 py-2">Localidad</th>
                            <th class="px-4 py-2">Rol</th>
                            <th class="px-4 py-2">Fecha registro</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b text-black text-lg">
                                <td class="px-4 py-2 font-bold">{{ $user->id }}</td>
                                <td class="px-4 py-2 font-bold">{{ $user->nombre }}</td>
                                <td class="px-4 py-2">{{ $user->apellidos }}</td>
                                <td class="px-4 py-2">{{ $user->username }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">{{ $user->fecha_nacimiento }}</td>
                                <td class="px-4 py-2">{{ $user->localidad }}</td>
                                <td class="px-4 py-2">{{ $user->rol }}</td>
                                <td class="px-4 py-2">{{ $user->fecha_registro }}</td>
                                <td class="px-4 py-2">
                                    <a href="#" class="text-blue-500 hover:underline font-bold">Editar</a> | 
                                    <a href="#" class="text-red-500 hover:underline font-bold">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <div class="flex items-center gap-4 mb-16 mt-8">
        <h3 class="text-lg">Volver a la vista principal:</h3>
            <a href="{{ route('admin') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Volver</a>
        </div>

    </main>

    @include('partials.footer')

</body>
</html>
