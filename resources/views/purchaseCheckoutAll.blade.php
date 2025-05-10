<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros - Pago</title>
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
        <div class="flex flex-col bg-amber-200 shadow-lg rounded-xl p-6 md:p-10">

            @foreach ($cart->cartItems as $item)
                <div class="flex flex-col md:flex-row gap-8 mb-4 bg-white p-4 rounded-lg shadow">
                    <div class="flex flex-row gap-4 md:w-1/2 items-center md:items-start">
                        <h2 class="text-xl font-bold text-[#322411] mb-4 text-center">{{ $item->book->titulo }}</h2>
                        <img src="{{ $item->book->imagen }}" alt="{{ $item->book->titulo }}" class="max-w-md max-h-[150px] rounded-lg shadow-md object-cover mb-4">
                    </div>

                    <div class="flex flex-col md:w-1/2 space-y-4">
                        <p><strong>Precio unitario:</strong> {{ number_format($item->book->precio, 2) }}€</p>
                        <p><strong>Cantidad:</strong> {{ $item->quantity }}</p>
                        <p><strong>Subtotal:</strong> {{ number_format($item->book->precio * $item->quantity, 2) }}€</p>
                    </div>
                </div>
            @endforeach

            <div class="text-xl font-semibold text-[#322411] mt-8 mb-8">
                    <p><strong>Total:</strong> {{ number_format($cart->totalPrice(), 2) }} €</p>
                </div>

            <div class="flex flex-col md:flex-row justify-between items-center space-y-4">

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('purchase.storeAll') }}" method="POST" class="space-y-4 w-full">
                    @csrf

                    @foreach ($cart->cartItems as $item)
                        <input type="hidden" name="book_ids[]" value="{{ $item->book->id }}">
                        <input type="hidden" name="quantities[]" value="{{ $item->quantity }}">
                    @endforeach

                    <div>
                        <label for="address" class="block mb-2 font-semibold">Dirección de envío y localidad:</label>
                        <textarea id="address" name="address" rows="2" required
                                  class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <input type="hidden" name="payment_method" value="card">

                    <div class="flex justify-between gap-4">
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-green-800">
                            Realizar compra
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="flex flex-row items-center gap-16 mt-16 mb-16">
        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver atrás:</h3>
            <a href="{{ url()->previous() }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Volver</a>
        </div>

        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver a Home:</h3>
            <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Home</a>
        </div>
    </div>
</main>

@include('partials.footer')

</body>
</html>
