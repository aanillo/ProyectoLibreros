<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen text-white font-[Brawler]">

@auth
    @include('partials.headerLog')
@else
    @include('partials.header')
@endauth

<main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-56">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">LIBRO</h1>
        <h2 class="text-2xl font-bold mb-2 text-center text-[#322411]">{{ $book->titulo }}</h2>
        <div class="flex justify-center">
            <img src="{{ $book->imagen }}" alt="{{ $book->titulo }}" 
                class="max-w-md max-h-[400px] w-90% object-cover rounded-md shadow-md mt-8 mb-16">
        </div>
    
        <div class="flex flex-col justify-center">
            <div class="flex flex-row justify-between w-full">
                <p class="mb-2"><strong>Autor:</strong> {{ $book->writer->nombre }}</p>
                <p class="mb-2"><strong>Género:</strong> {{ $book->genero }}</p>
                <p class="mb-2"><strong>Año:</strong> {{ $book->fecha_creacion }}</p>
            </div>
            
            <p class="mt-4 text-justify"><strong>Descripción:</strong> {{ $book->descripcion }}</p>
        
            <div class="mt-6"> 
                <p class="mt-2"><strong>Valoración:</strong> {{ number_format($book->valoracion, 1) }} / 5</p>
            </div>

            
            @auth
            <div x-data="{ valoracion: {{ isset($book->valoracion) ? $book->valoracion : 0 }} }" class="mt-6 flex flex-row space-x-4">
                <strong>Valora este libro:</strong>
                <div class="flex space-x-1">
                    <template x-for="star in 5" :key="star">
                        <i class="fas fa-star text-yellow-300 cursor-pointer"
                        @click="valoracion = star"
                        :class="valoracion >= star ? 'text-yellow-500' : 'text-gray-300'"></i>
                    </template>
                </div>
                <form action="{{ route('rateBook', $book->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="valoracion" x-bind:value="valoracion">
                    <button type="submit" class="bg-blue-500 text-black font-bold border-2 border-solid border-black px-6 py-2 rounded-md hover:bg-blue-700">Enviar valoración</button>
                </form>
                </div>
            @endauth
        </div>
        </div>

        <div class="flex items-center gap-4 mb-8 mt-16">
        <h3 class="text-lg">Volver a Libros:</h3>
            <a href="{{ url()->previous() }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Volver</a>
        </div>

        <div class="flex items-center gap-4 mb-16 mt-8">
        <h3 class="text-lg">Volver a Home:</h3>
        @auth
            <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Home</a>
        @else
            <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Home</a>
        @endauth
    </div>
    </div>
</main>

</body>

@include('partials.footer')
</html>