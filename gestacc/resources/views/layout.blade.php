<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GESTACC - Sistema de gestión de actas</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script> 
    <script src="https://kit.fontawesome.com/6dd0880117.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet"> 
    

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto&display=swap" rel="stylesheet">


</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="/">
                    <i class="fas fa-file-alt fa-5x"></i>
                    <br>
                    <br>
                    <h1>GESTACC</h1>
                </a>
                <br>
                @auth
                    <h6>{{ auth()->user()->name}} </h6>
                    <h6>{{ auth()->user()->getRoleNames()[0]}} </h6>
                @endauth
                @guest
                    <h6>Usuario externo</h6>
                @endguest
            </div>

            <ul class="list-unstyled components">
                
                <li class ="{{ setActive('home') }}">
                    <a href="{{ route('home') }}"> <i class="fas fa-home"></i> Inicio</a>
                </li>

                <li class="{{ setActive('actas') }}">
                    <?php $rutas = array('actas.nuevaActa', 'actas.actasPendientes', 'actas.buscarActas')?>
                    <a href="#actas-submenu" data-toggle="collapse" aria-expanded="{{setActiveGroup($rutas)}}" class="dropdown-toggle"> <i class="fas fa-folder-open"></i></i> Actas</a>
                    <ul class="list-unstyled {{setActiveGroupCollapse($rutas)}}" id="actas-submenu">
                        @can('nuevaActa')
                            <li class ="{{ setActive('actas.nuevaActa') }}">
                                <a href="{{ route('actas.create') }}">Crear actas</a>
                            </li>
                        @endcan
                        @can('actasPendientes')
                            <li class ="{{ setActive('actas.actasPendientes') }}">
                                <a href="{{ route('actas.actasPendientes') }}">Actas pendientes</a>
                            </li>
                        @endcan
                        <li class ="{{ setActive('actas.buscarActas') }}">
                            <a href="{{ route('actas.buscarActas') }}">Buscar actas</a>
                        </li>
                    </ul>
                </li>

                @can('reunion')
                    <li class="{{ setActive('reunion') }}">
                    <?php $rutas = array('reunion')?>
                        <a href="#reuniones-submenu" data-toggle="collapse" aria-expanded="{{setActiveGroup($rutas)}}" class="dropdown-toggle"> <i class="fas fa-handshake"></i> Reuniones</a>
                        <ul class="list-unstyled {{setActiveGroupCollapse($rutas)}}" id="reuniones-submenu">
                            <li class ="{{ setActive('reunion') }}">
                                <a href="{{ route('reunion') }}">Crear reunión</a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('tareas')
                    <li class="{{ setActive('tareas') }}">
                        <?php $rutas = array('tareas')?>
                        <a href="#tareas-submenu" data-toggle="collapse" aria-expanded="{{setActiveGroup($rutas)}}" class="dropdown-toggle"> <i class="fas fa-tasks"></i> Tareas</a>
                        <ul class="list-unstyled {{setActiveGroupCollapse($rutas)}}" id="tareas-submenu">
                            <li class ="{{ setActive('tareas') }}">
                                <a href="{{ route('tareas') }}">Ver mis tareas</a>
                                
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('usuarios')
                    <li class ="{{ setActive('usuarios') }}">
                        <a href="{{ route('usuarios.index') }}"><i class="fas fa-users"></i> Usuarios</a>
                    </li>
                @endcan
            </ul>
            @guest
                <ul class="list-unstyled CTAs">
                    <li>
                        <a href="{{ route('login') }}" class="boton"> <i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
                    </li>
                </ul>
            @else
            <ul class="list-unstyled CTAs">
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="boton"> <i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
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
            @yield('content')
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });

        function myFunction()
        {
            alert("funciona")
        };

    </script>
    
</body>
</html>