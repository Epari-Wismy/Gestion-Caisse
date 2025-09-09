<?php
Use Illuminate\Support\Str;


function setMenuClass($route, $class){

    $routeActuel = request()->route()->getName();

    if (containss($routeActuel,$route)){
        return $class;
    }
    return "";
}

function setMenuActive($route){
    $routeActuel = request()->route()->getName();

    if ($routeActuel === $route){
        return "active";
    }
    return "";

}

function containss($container,$contenu){
    return Str::contains($container,$contenu);
}
