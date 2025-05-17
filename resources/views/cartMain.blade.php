<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen text-white font-[Georgia]">

@auth
    @include('partials.headerLog')
@else
    @include('partials.header')
@endauth

<main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-56">
<h1 class="text-4xl font-bold mb-4 text-center text-[#322411]">CARRO</h1>
<h2 class="text-xl mt-2 text-center mb-6">Carrito de la compra de {{ auth()->user()->username }}</h2>

@if ($cart && $cart->cartItems->count() > 0)
    <div class="w-[130%] max-w-5xl bg-amber-200 rounded-xl shadow-lg p-6 px-12 py-8 space-y-6">

        @foreach ($cart->cartItems as $item)
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 bg-white p-4 rounded-md shadow">
                <div class="flex items-center gap-4">
                    <img src="{{ $item->book->imagen }}" alt="{{ $item->book->titulo }}" class="w-24 h-42 object-cover rounded shadow">
                    <div>
                        <h2 class="text-xl font-semibold text-[#322411]">{{ $item->book->titulo }}</h2>
                        <p class="text-lg">Cantidad: {{ $item->quantity }}</p>
                        <p class="text-lg">Precio unitario: {{ number_format($item->book->precio, 2) }} €</p>
                        <p class="font-bold text-lg">Subtotal: {{ number_format($item->book->precio * $item->quantity, 2) }} €</p>
                    </div>
                </div>

                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-800 transform transition-transform duration-1000 ease-in-out hover:scale-110">
                        Eliminar
                    </button>
                </form>
            </div>
        @endforeach

        <div class="text-right text-xl font-bold text-[#322411]">
            Total: €{{ number_format($cart->totalPrice(), 2) }}
        </div>

        <div class="flex justify-end">
            <a href="{{ route('purchaseCheckoutAll') }}" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-800 font-semibold transform transition-transform duration-1000 ease-in-out hover:scale-110">
                Proceder al pago
            </a>
        </div>
    </div>
@else
    <p class="text-center text-lg text-gray-600">Tu carrito está vacío.</p>
@endif

<div class="flex flex-row items-center gap-16">
    <div class="flex items-center gap-4 mb-16 mt-16">
            <h3 class="text-lg">Volver atrás:</h3>
            <a href="{{ url()->previous() }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Volver</a>
        </div>

        <div class="flex items-center gap-4 mb-16 mt-16">
            <h3 class="text-lg">Volver a Home:</h3>
            @auth
                <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
            @else
                <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
            @endauth
        </div>
   </div> 
</main>

</body>

@include('partials.footer')
</html>



