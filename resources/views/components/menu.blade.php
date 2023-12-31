<nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: hsl(208, 72%, 31%)">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
			<h2 class="fw-bold text-white">EasyCommerce</h2>
        </a>

        <!-- Hamburguesa -->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" href="{{ route('register') }}">Registro</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white fw-bold" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->full_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            @role('admin')
                                {{-- Users --}}
                                <a class="dropdown-item" href="{{ route('users') }}">
                                    Usuarios
                                </a>

                                {{-- Products --}}
                                <a class="dropdown-item" href="{{ route('products') }}">
                                    Productos
                                </a>

                                {{-- Categories --}}
                                <a class="dropdown-item" href="{{ route('categories') }}">
                                    Categorias
                                </a>
                            @endrole


                            {{-- Logout --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            	document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>


                        </div>
                    </li>
                @endguest

                {{-- Cart icon --}}
                <li class="nav-item">
                    <button class="nav-link" onClick=handleClick()>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" fill="currentColor"
                            class="bi bi-cart3 text-white" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    // Obtener el elemento del enlace del carrito
    function handleClick() {
        @guest
        // Si el usuario no está autenticado, redirigir al login
        window.location.href = "{{ route('login') }}";
    @else
        // redirigir al carrito
        window.location.href = `/ShoppingCart/MyCart`;
    @endguest
    }
</script>
<style>
.navbar-brand {
  text-decoration: none;
}

.navbar-brand h2 {
  position: relative;
  overflow: hidden;
}

.navbar-brand h2::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background-image: linear-gradient(to right, transparent, rgba(58, 141, 243, 0.624));
  transition: left 1s linear;
}

.navbar-brand h2:hover::before {
  left: 100%;
}
</style>
