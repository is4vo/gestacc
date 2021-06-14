<?php
function setActive($ruta) {
    return request()->routeIs($ruta) ? 'active' : '';
}; 

function setActiveGroup($rutas) {
    $active = false;
    foreach($rutas as $ruta) {
        if(request()-> routeIs($ruta)){
            $active = true;
        };
    };
    return $active;
};
function setActiveGroupCollapse($rutas) {
    $active = false;
    foreach($rutas as $ruta) {
        if(request()-> routeIs($ruta)){
            $active = true;
        };
    };
    return $active ? '' : 'collapse';
}
?>