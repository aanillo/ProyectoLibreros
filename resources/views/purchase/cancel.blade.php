@extends('layouts.app')

@section('content')
<main class="flex flex-col items-center justify-center min-h-screen bg-red-100 text-red-800">
    <h1 class="text-4xl font-bold mb-4">Pago cancelado</h1>
    <p class="text-lg">Parece que cancelaste el proceso de pago.</p>
    <a href="{{ route('home') }}" class="mt-6 text-blue-600 underline">Volver a la tienda</a>
</main>
@endsection
