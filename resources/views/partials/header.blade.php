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
                <a href="#" class="text-white text-xl transition-transform duration-300 hover:scale-125">
                    Libros
                </a>
                <a href="#" class="text-white text-xl transition-transform duration-300 hover:scale-125">
                    Autores
                </a>
            </div>

            <div class="flex ml-[70%] gap-[45%]">
                <a href="{{ route('login.show') }}" class="text-white text-xl transition-transform duration-300 hover:scale-125">
                    Login
                </a>
                <a href="{{ route('register.show') }}" class="text-white text-xl transition-transform duration-300 hover:scale-125">
                    Registro
                </a>
            </div>
        </nav>
    </div>
</header>
