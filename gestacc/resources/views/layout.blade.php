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
                <h6> {{ $nombre ?? "Usuario externo" }}</h6>
            </div>

            <ul class="list-unstyled components">
                
                <li class ="{{ setActive('home') }}">
                    <a href=<?php echo route('home') ?>>Inicio</a>
                </li>

                <li>
                    <?php $rutas = array('nuevaActa', 'actasPendientes', 'buscarActas')?>
                    <a href="#actas-submenu" data-toggle="collapse" aria-expanded="{{setActiveGroup($rutas)}}" class="dropdown-toggle">Actas</a>
                    <ul class="list-unstyled {{setActiveGroupCollapse($rutas)}}" id="actas-submenu">
                        <li class ="{{ setActive('nuevaActa') }}">
                            <a href="<?php echo route('nuevaActa') ?>">Crear actas</a>
                        </li>
                        <li class ="{{ setActive('actasPendientes') }}">
                            <a href="<?php echo route('actasPendientes') ?>">Actas pendientes</a>
                        </li>
                        <li class ="{{ setActive('buscarActas') }}">
                            <a href="<?php echo route('buscarActas') ?>">Buscar actas</a>
                        </li>
                    </ul>
                </li>

                <li>
                <?php $rutas = array('reunion')?>
                    <a href="#reuniones-submenu" data-toggle="collapse" aria-expanded="{{setActiveGroup($rutas)}}" class="dropdown-toggle">Reuniones</a>
                    <ul class="list-unstyled {{setActiveGroupCollapse($rutas)}}" id="reuniones-submenu">
                        <li class ="{{ setActive('reunion') }}">
                            <a href="<?php echo route('reunion') ?>">Crear reunión</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <?php $rutas = array('tareas')?>
                    <a href="#tareas-submenu" data-toggle="collapse" aria-expanded="{{setActiveGroup($rutas)}}" class="dropdown-toggle">Tareas</a>
                    <ul class="list-unstyled {{setActiveGroupCollapse($rutas)}}" id="tareas-submenu">
                        <li class ="{{ setActive('tareas') }}">
                            <a href="<?php echo route('tareas') ?>">Ver mis tareas</a>
                        </li>
                    </ul>
                </li>

                <li class ="{{ setActive('usuarios') }}">
                    <a href="<?php echo route('usuarios') ?>">Usuarios</a>
                </li>
            </ul>
            <ul class="list-unstyled CTAs">
                <li>
                    <a href="<?php echo route('iniciarSesion') ?>" class="boton">Iniciar sesión</a>
                </li>
            </ul>
        </nav>
    
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
    </script>
    
</body>
</html>