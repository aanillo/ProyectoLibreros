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

<h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">COMPRA</h1>

    <div class="w-full max-w-4xl mx-auto px-4 mt-8">
        <div class="flex flex-col md:flex-row gap-6 bg-amber-200 shadow-lg rounded-xl p-6 md:p-10">

            <div class="flex flex-col md:w-1/2 text-center items-center md:items-start">
                <h2 class="text-2xl font-bold text-[#322411] mb-4">{{ $book->titulo }}</h2>
                <img src="{{ $book->imagen }}" alt="{{ $book->titulo }}" 
                     class="max-w-md max-h-[400px] md:max-w-md rounded-lg shadow-md object-cover mb-4">
            </div>

        
            <div class="flex flex-col md:w-1/2 space-y-4">

               
                <div class="text-xl font-semibold text-[#322411]">
                    <p><strong>Usuario:</strong> {{ auth()->user()->username }}</p>
                </div>

                
                <div class="text-xl font-semibold text-[#322411]">
                    <p><strong>Precio:</strong> {{ number_format($book->precio, 2) }} €</p>
                </div>

                
                <form action="{{ route('purchase.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                   
                    <div>
                        <label for="quantity" class="block mb-2 font-semibold">Cantidad:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" required
                               class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    
                    <div>
                        <label for="address" class="block mb-2 font-semibold">Dirección de envío:</label>
                        <textarea id="address" name="address" rows="2" required
                                  class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                   
                    <div>
                        <label for="payment_method" class="block mb-2 font-semibold">Método de pago:</label>
                        <select id="payment_method" name="payment_method" required
                                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="card">Tarjeta</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>

                   
                    <div class="flex justify-between gap-4">
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-green-800">
                            Realizar compra
                        </button>
                        
                        <button name="action" value="cart"
                            formaction="{{ route('cart.add') }}"
                            class="bg-blue-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-800">
                            Añadir al carrito
                        </button>
                    </form>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

</main>

@include('partials.footer')

</body>
</html>
