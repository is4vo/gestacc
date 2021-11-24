<?php
function setActive($ruta) {
    $pattern = $ruta . "*";
    return request()->routeIs($pattern) ? 'active' : '';
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