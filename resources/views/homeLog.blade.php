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
        
        <section class="text-center mb-8">
            <h1 class="text-3xl font-bold">Libreros, un espacio para los amantes de la lectura</h1>
            <h2 class="text-xl mt-2">Aquí podrás encontrar tus libros favoritos y compartir tus vivencias</h2>
            <hr class="mt-8 border-[#F5D074] w-9/10 border-2 mx-auto">
        </section>

        <section class="w-full text-center mb-8">
            <h3 class="text-2xl font-semibold mb-4">Libros</h3>
            <p class="mb-4">Disfruta de nuestro amplio catálogo de libros, podrás buscar por géneros y por autores.</p>
            
            <div class="flex flex-wrap justify-center gap-4">
                @foreach ($randomBooks as $book)
                    <div class="flex flex-col items-center w-32">
                        <img src="{{ $book->imagen }}" alt="Imagen libro" class="w-32 h-50 object-cover rounded-lg shadow-md">
                        <p class="mt-2 text-sm font-medium">{{ $book->titulo }}</p>
                    </div>
                @endforeach
            </div>
            <hr class="mt-8 border-[#F5D074] w-3/4 border-2 mx-auto">
        </section>

        <section class="w-full text-center">
            <h3 class="text-2xl font-semibold mb-4">Autores</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mx-auto max-w-5xl">
                @foreach ($randomWriters as $writer)
                    <div class="bg-gray-100 p-3 rounded-lg shadow-md text-black mx-auto">
                        <p class="font-medium">{{ $writer->nombre }}</p>
                    </div>
                @endforeach
            </div>
            <hr class="mt-8 border-[#F5D074] w-3/4 border-2 mx-auto">
        </section>

        <section class="section_frases flex gap-6 mt-6 mb-6">
            <div class="bg-yellow-200 p-4 rounded-md flex items-center justify-center">
                <h3 class="text-black text-center">
                    Un lector vive mil<br> vidas antes de morir.<br>
                    <br>
                    <i>George R. R. Martin</i>
                </h3>
            </div>

            <img src="../public/img/biblio.jpeg" class="w-96 h-auto" alt="Libros">

            <div class="bg-yellow-200 p-4 rounded-md flex items-center justify-center">
                <h3 class="text-black text-center">
                    La lectura es para la<br> mente lo que el ejercicio<br> es para el cuerpo.<br>
                    <br>
                    <i>Richar Steele</i>
                </h3>
            </div>
        </section>

    </main>

    @include('partials.footer')

</body>
</html>
