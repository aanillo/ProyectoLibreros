<header 
  class="fixed top-0 left-0 w-full bg-[#322411] z-50 p-4" 
  x-data="{ navOpen: false }"
>
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between w-full gap-4">

      
      <div class="flex-shrink-0">
        <img src="{{ asset('img/LogoInicial.jpg') }}" width="120px" />
      </div>

      
      <button 
        @click="navOpen = !navOpen" 
        class="text-white md:hidden focus:outline-none"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      
      <div 
        class="hidden md:flex md:items-center md:gap-8 w-full justify-between" 
        :class="{ 'flex flex-col mt-4': navOpen }"
      >

        
        <div class="flex flex-col text-left ml-48">
          <h1 class="text-3xl md:text-4xl text-white leading-tight">Libreros</h1>
          <div class="flex gap-12 mt-3">
            <a href="{{ route('books') }}" class="text-white text-lg md:text-xl transition-transform duration-300 hover:scale-125">
              Libros
            </a>
            <a href="{{ route('writers') }}" class="text-white text-lg md:text-xl transition-transform duration-300 hover:scale-125">
              Autores
            </a>
          </div>
        </div>

        
        <div class="flex flex-col md:mr-24 text-left mt-4 md:mt-0">
          <h2 class="text-lg md:text-xl text-white mb-1">El rincón de los lectores más apasionados</h2>
          <div class="flex gap-12 mt-3">
            <a href="{{ route('login.show') }}" class="text-white text-lg md:text-xl transition-transform duration-300 hover:scale-125">
              Login
            </a>
            <a href="{{ route('register.show') }}" class="text-white text-lg md:text-xl transition-transform duration-300 hover:scale-125">
              Registro
            </a>
          </div>
        </div>

      </div>

    </div>
  </div>
</header>