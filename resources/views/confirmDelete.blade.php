<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreros</title>
    <link rel="icon" type="image/x-icon" href="../public/img/LogoInicial.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Brawler]">
    @include('partials.headerLog')

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-64">
        <h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">¿Seguro que deseas eliminar la cuenta?</h1>
        <div class="flex justify-center mt-8 gap-24">
            <div class="flex flex-col items-center">
                <h3 class="text-lg">Eliminar usuario:</h3>
                <form action="{{ route('deleteProfile', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btnHome bg-red-500 text-black font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-red-600">Eliminar</button>
                </form>
            </div>

            <div class="flex flex-col items-center">
                <h3 class="text-lg">Volver atrás:</h3>
                <a href="{{ route('profile', ['id' => $user->id]) }}"
                class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-700">
                Usuarios
                </a>
            </div>

            <div class="flex flex-col items-center">
                <h3 class="text-lg">Volver a Home:</h3>
                <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-700">Home</a>
            </div>
        </div>
        <h3 class="text-lg mt-16">En <strong>Libreros</strong> estaremos encantados de volver a recibirle</h3>
        <img class="mt-16 mb-16" src="{{ asset('img/LogoInicial.jpg') }}" width="200px" />
    </main>

    @include('partials.footer')
</body>