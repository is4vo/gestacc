<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GESTACC - Sistema de gestión de actas</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/6dd0880117.js" crossorigin="anonymous"></script>
    {{-- <script src="https://csn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto&display=swap" rel="stylesheet">


</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="/">
                    <i class="fas fa-file-alt fa-3x"></i>
                    <br>
                    <br>
                    <h1>GESTACC</h1>
                </a>
            </div>
            <ul class="list-unstyled components">
                <li class = "{{ setActive('home') }}">
                    <a href="{{ route('home') }}"> <i class="fas fa-home"></i> Inicio</a>
                </li>
                <li>
                    <?php $rutas = array('actas.pendientes', 'actas.index')?>
                    <a href="#actas-submenu" data-toggle="collapse" aria-expanded="{{setActiveGroup($rutas)}}" class="dropdown-toggle"> <i class="fas fa-folder-open"></i> Actas</a>
                    <ul class="list-unstyled {{setActiveGroupCollapse($rutas)}}" id="actas-submenu">
                        @can('actas')
                            <li class ="{{ setActive('actas.pendientes') }}">
                                <a href="{{ route('actas.pendientes') }}"><i class="fas fa-angle-right"></i> Actas pendientes</a>
                            </li>
                        @endcan
                        <li class ="{{ setActive('actas.index') }}">
                            <a href="{{ route('actas.index') }}"><i class="fas fa-angle-right"></i> Buscar actas</a>
                        </li>
                    </ul>
                </li>

                @can('reunion')
                    <li>
                    <?php $rutas = array('reuniones.index', 'reuniones.create')?>
                        <a href="#reuniones-submenu" data-toggle="collapse" aria-expanded="{{setActiveGroup($rutas)}}" class="dropdown-toggle"> <i class="fas fa-handshake"></i> Reuniones</a>
                        <ul class="list-unstyled {{setActiveGroupCollapse($rutas)}}" id="reuniones-submenu">
                            <li class ="{{ setActive('reuniones.index') }}">
                                <a href="{{ route('reuniones.index') }}"><i class="fas fa-angle-right"></i> Reuniones</a>
                            </li>
                            <li class ="{{ setActive('reuniones.create') }}">
                                <a href="{{ route('reuniones.create') }}"><i class="fas fa-angle-right"></i> Crear reunión</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('tareas')
                    <li class="{{ setActive('tareas') }}">
                        <a href="{{ route('tareas.index') }}"><i class="fas fa-tasks"></i> Mis Tareas</a>
                    </li>
                @endcan

                @can('usuarios')
                    <li class ="{{ setActive('usuarios') }}">
                        <a href="{{ route('usuarios.index') }}"><i class="fas fa-users"></i> Usuarios</a>
                    </li>
                @endcan
            </ul>

            <div class="text-center">
                @auth
                    {{ auth()->user()->name}}
                    <br>
                    <i>{{ auth()->user()->getRoleNames()[0]}}</i>
                @endauth
                @guest
                    <i>Usuario externo</i>
                @endguest
            </div>
            @guest
                <ul class="list-unstyled CTAs">
                    <li>
                        <a href="{{ route('login') }}" class="boton" style="border-radius: 5px"> <i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
                    </li>
                </ul>
            @else
            <ul class="list-unstyled CTAs">
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="boton" style="border-radius: 5px"> <i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                </li>
            </ul>
            @endguest

        </nav>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <h2>@yield('titulo')</h2>
            </nav>
            <div class="whole-page-overlay" id="whole_page_loader">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border text-light m-5" role="status">
                        <span class="sr-only">Cargando...</span>
                    </div>
                </div>
            </div>
            @include('alertas')
            @yield('content')

        </div>
    </div>
    
</body>
</html>