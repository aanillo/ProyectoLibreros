<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreros</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">

@include('partials.headerLog') 

<main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-52">

    <div class="max-w-6xl mx-auto px-4" x-data="{
        currentPage: 1,
    purchasesPerPage: 5,
    allPurchases: @js($purchases),
    get totalPages() {
        return Math.ceil(this.allPurchases.length / this.purchasesPerPage);
    },
    get paginatedPurchases() {
        const start = (this.currentPage - 1) * this.purchasesPerPage;
        return this.allPurchases.slice(start, start + this.purchasesPerPage);
    }
    }">

        <h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">HISTORIAL</h1>
        <h2 class="text-xl mt-2 text-center">Compras realizadas por {{ $user->username }}</h2>

        <template x-if="paginatedPurchases.length === 0">
            <p class="text-center text-red-500 font-bold text-lg">No hay compras registradas.</p>
        </template>

        <ul class="space-y-3 p-4 text-lg">
        <template x-for="(purchase, index) in paginatedPurchases" :key="index">
            <li class="bg-amber-200 border border-[#322411] rounded-md p-6 shadow text-black">
                <p><strong>Libros:</strong></p>
                <ul class="list-disc list-inside pl-4">
                    <template x-for="(title, i) in purchase.books" :key="i">
                        <li x-text="title"></li>
                    </template>
                </ul>
                <p><strong>Precio total:</strong> <span x-text="purchase.amount + ' €'"></span></p>
                <p><strong>Dirección:</strong> <span x-text="purchase.address"></span></p>
                <p><strong>Fecha:</strong> <span x-text="purchase.date"></span></p>
            </li>
        </template>
    </ul>

        
        <div class="flex justify-center items-center gap-6 mt-6 text-[#322411] text-xl" x-show="totalPages > 1">
            <button 
                @click="if (currentPage > 1) currentPage--" 
                :disabled="currentPage === 1"
                :class="{ 'opacity-30 cursor-not-allowed': currentPage === 1 }"
                class="hover:text-amber-500 transition"
            >
                <i class="fas fa-chevron-left"></i>
            </button>
            <span class="font-bold text-lg">Página <span x-text="currentPage"></span> de <span x-text="totalPages"></span></span>
            <button 
                @click="if (currentPage < totalPages) currentPage++" 
                :disabled="currentPage === totalPages"
                :class="{ 'opacity-30 cursor-not-allowed': currentPage === totalPages }"
                class="hover:text-amber-500 transition"
            >
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

   
    <div class="flex flex-row items-center gap-16 mt-16 mb-12">
        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver atrás:</h3>
            <a href="{{ url()->previous() }}"
               class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Volver</a>
        </div>
        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver a Home:</h3>
            @auth
                <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Home</a>
            @else
                <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Home</a>
            @endauth
        </div>
    </div>

    <img src="{{ asset('img/book2.jpg') }}" class="w-80 h-auto my-6 mb-16" alt="Libro" />

</main>

@include('partials.footer')

</body>
</html>
