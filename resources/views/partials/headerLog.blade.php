<header class="fixed top-0 left-0 w-full bg-[#322411] z-50 p-4" x-data="{ navOpen: false }">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between w-full gap-4">
      
      <div class="flex-shrink-0">
        <img src="{{ asset('img/LogoInicial.jpg') }}" width="120px" />
      </div>

      
      <button @click="navOpen = !navOpen" class="text-white md:hidden focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      
      <div class="hidden md:flex md:items-center md:gap-8 w-full justify-between">
        <div class="flex flex-col text-left ml-48">
          <a href="{{ route('home') }}" class="text-white">
            <h1 class="text-3xl md:text-4xl text-white leading-tight">Libreros</h1>
          </a>
          <div class="flex gap-12 mt-3">
            <a href="{{ route('books') }}" class="text-white text-lg md:text-xl transition-transform duration-300 hover:scale-125">Libros</a>
            <a href="{{ route('writers') }}" class="text-white text-lg md:text-xl transition-transform duration-300 hover:scale-125">Autores</a>
          </div>
        </div>

        
        <div class="flex flex-col md:mr-24 text-left">
          <h2 class="text-lg md:text-xl text-white mb-1">El rincón de los lectores más apasionados</h2>
          <div class="flex items-center gap-6 mt-3">
            <div class="flex items-center gap-2">
              <img src="{{ asset('img/perfil.png') }}" class="w-10 h-auto" alt="Perfil">
              <a href="{{ route('profile', ['id' => auth()->user()->id]) }}" class="text-white text-lg transition-transform duration-300 hover:scale-125">
                  {{ auth()->user()->username }}
              </a>
            </div>
            <a href="#" class="text-white text-xl transition-transform duration-300 hover:scale-125">Historial</a>
            <a href="{{ route('logout.confirm') }}" class="text-white text-xl transition-transform duration-300 hover:scale-125">Cerrar sesión</a>
          </div>
        </div>
      </div>
    </div>

    
    <div x-show="navOpen" class="md:hidden mt-4 flex flex-col gap-4 text-white">
      <a href="{{ route('books') }}" class="text-lg transition-transform duration-300 hover:scale-110">Libros</a>
      <a href="{{ route('writers') }}" class="text-lg transition-transform duration-300 hover:scale-110">Autores</a>
      <hr class="border-white my-2" />
      <div class="flex items-center gap-2">
        <img src="{{ asset('img/perfil.png') }}" class="w-8 h-auto" alt="Perfil">
        <span class="text-lg">{{ auth()->user()->username }}</span>
      </div>
      <a href="#" class="text-lg transition-transform duration-300 hover:scale-110">Historial</a>
      <a href="{{ route('logout.confirm') }}" class="text-lg transition-transform duration-300 hover:scale-110">Cerrar sesión</a>
    </div>

  </div>
</header>


<div class="fixed mt-[135px] w-full bg-amber-200 text-black py-2 flex justify-center items-center">
    <h2 class="text-2xl font-semibold">Bienvenid@ {{ auth()->user()->username }}</h2>
</div>

