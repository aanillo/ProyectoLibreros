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
        <h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">LIBROS</h1>
        <h2 class="text-xl mt-2 text-center mb-6">Realiza tu búsqueda según tipo o género</h2>

        <ul class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <li class="group bg-amber-200 p-2 shadow hover:shadow-lg transition border-2 border-solid border-[#322411] flex items-center justify-center w-[160px] 
                hover:bg-[#322411] hover:border-amber-200">
                <a href="{{ route('books', ['genero' => 'Todos']) }}" class="text-lg text-[#322411] text-center font-bold group-hover:text-amber-200">Todos</a>
            </li>
            @foreach ($generos as $genero)
                <li class="group bg-amber-200 p-2 shadow hover:shadow-lg transition border-2 border-solid border-[#322411] flex items-center justify-center w-[160px] 
                    hover:bg-[#322411] hover:border-amber-200">
                    <a href="{{ route('books', ['genero' => $genero]) }}" class="text-lg text-[#322411] text-center font-bold group-hover:text-amber-200">{{ $genero }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="max-w-4xl mx-auto mt-8 mb-8 px-4">
        <h2 class="text-xl mt-2 text-center mb-6">También puedes buscar por nombre del libro o por autor:</h2>
        <input class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-0.5" placeholder="Introduce libro o autor">
    </div>

    <div class="max-w-4xl mx-auto mt-8 mb-24 px-4 w-full"
         x-data="{
             currentPage: 1,
             booksPerPage: 15,
             get paginatedBooks() {
                 const start = (this.currentPage - 1) * this.booksPerPage;
                 const end = start + this.booksPerPage;
                 return this.allBooks.slice(start, end);
             },
             get totalPages() {
                 return Math.ceil(this.allBooks.length / this.booksPerPage);
             },
             allBooks: @js($librosPorGenero),
             baseUrl: '{{ url('books/libro') }}/'
         }">
        <h2 class="text-xl mt-2 text-center mb-6">
            Libros en el género: 
            <span>
                {{ request()->get('genero') ? request()->get('genero') : 'Todos' }}
            </span>
        </h2>

        <div x-show="allBooks.length === 0" class="text-center text-lg font-semibold text-red-500">
            No se encontraron libros en este género.
        </div>
      
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-4" x-show="allBooks.length > 0">
            <template x-for="libro in paginatedBooks" :key="libro.id">
                <div @click="window.location.href = baseUrl + libro.id"
                     class="cursor-pointer p-2 bg-white shadow-md rounded-lg hover:-translate-y-1 transition">
                    <img :src="libro.imagen" :alt="libro.titulo" class="w-full h-56 object-cover rounded-md">
                    <h2 class="text-l font-semibold mt-2 text-center" x-text="libro.titulo"></h2>
                </div>
            </template>
        </div>

        <div class="flex justify-center mt-6 gap-4 items-center text-[#322411] text-2xl">
            <button 
                @click="if (currentPage > 1) currentPage--"
                class="hover:text-amber-500 transition"
                :disabled="currentPage === 1"
                :class="{ 'opacity-30 cursor-not-allowed': currentPage === 1 }"
            >
                <i class="fas fa-chevron-left"></i>
            </button>

            <span class="font-bold text-lg">Página <span x-text="currentPage"></span> de <span x-text="totalPages"></span></span>

            <button 
                @click="if (currentPage < totalPages) currentPage++"
                class="hover:text-amber-500 transition"
                :disabled="currentPage === totalPages"
                :class="{ 'opacity-30 cursor-not-allowed': currentPage === totalPages }"
            >
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <div class="flex items-center gap-4 mb-16 mt-8">
        <h3 class="text-lg">Volver a Home:</h3>
        @auth
            <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Home</a>
        @else
            <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Home</a>
        @endauth
    </div>
</main>
</body>

@include('partials.footer')
</html>
