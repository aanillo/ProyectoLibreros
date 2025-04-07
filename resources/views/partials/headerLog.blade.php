<header class="fixed top-0 left-0 w-full bg-[#322411] flex items-center z-50 p-4">
    
    <div class="flex justify-center mt-4 ml-[20%] mb-2"> 
        <img src="{{ asset('img/LogoInicial.jpg') }}" width="120px" />
    </div>

    <div class="flex flex-col ml-[8%]">
        
        <div class="flex items-center gap-[30%]">
            <h1 class="text-4xl">Libreros</h1>
            <h2 class="text-xl whitespace-nowrap">El rincón de los lectores más apasionados</h2>
        </div>
        
        <nav class="flex mt-4"> 
            <div class="flex ml-[1%] gap-[45%]">
                <a href="{{ route('books') }}" class="text-white text-xl transition-transform duration-300 hover:scale-125">
                    Libros
                </a>
                <a href="#" class="text-white text-xl transition-transform duration-300 hover:scale-125">
                    Autores
                </a>
            </div>

            <div class="flex ml-[70%] gap-[45%] items-center">
    <a href="#" class="text-white text-xl transition-transform duration-300 hover:scale-125 flex items-center">
        <img src="{{ asset('img/perfil.png') }}" class="w-10 h-auto my-6" alt="Perfil">
        <span class="ml-2">{{ auth()->user()->username }}</span>
    </a>
    <a href="#" class="text-white text-xl transition-transform duration-300 hover:scale-125">
        Historial
    </a>
    <a href="{{ route("logout") }}" class="text-white text-xl transition-transform duration-300 hover:scale-125">
        Cerrar sesión
    </a>
</div>

        </nav>
    </div>

</header>

<div class="fixed mt-[170px] w-full bg-yellow-200 text-black py-2 flex justify-center items-center">
    <h2 class="text-2xl font-semibold">Bienvenid@ {{ auth()->user()->username }}</h2>
</div>

