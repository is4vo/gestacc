<?php
function setActive($ruta) {
    return request()->routeIs($ruta) ? 'active' : '';
} 
function setActiveGroup($rutas) {
    foreach($rutas as $ruta) {
        if (request()-> routeIs($ruta)) {
            return 'true';
        }
        else {
            return 'false';
        }
    }
}
?>