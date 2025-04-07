<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen text-white font-[Brawler]">

@include('partials.headerLog') 

<main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-64">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6 text-center text-[#322411]">LIBROS</h1>
        <h2 class="text-xl mt-2 text-center mb-6">Realiza tu búsqueda según tipo o género</h2>
        <ul class="grid grid-cols-2 md:grid-cols-5 gap-5">
    @foreach ($generos as $genero)
        <li class="group bg-yellow-200 p-2 shadow hover:shadow-lg transition border-2 border-solid border-[#322411] flex items-center justify-center w-[170px] 
            hover:bg-[#322411] hover:border-yellow-200">
            <span class="text-lg text-[#322411] text-center font-bold group-hover:text-yellow-200">{{ $genero }}</span>
        </li>
    @endforeach
</ul>

    </div>

    <div class="max-w-4xl mx-auto mt-16 mb-24 px-4">
        <h2 class="text-xl mt-2 text-center mb-6">También puedes buscar por nombre del libro o por autor:</h2>
        <input class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-0.5" placeholder="Introduce libro o autor">
    </div>

    <div class="flex items-center gap-4 mb-16 mt-8">
            <h3 class="text-lg">Volver a Home:</h3>
            <a href="{{ route('home') }}" class="btnHome bg-yellow-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Home</a>
    </div>
    </main>
</body>

@include('partials.footer')
</html>
