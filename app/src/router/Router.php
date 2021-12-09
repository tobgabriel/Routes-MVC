<?php

class Router{
    private $route_collection = new RouteCollection();
    private $dispacher = new Dispacher();

    public function __construct(){
        $this->route_collection= new RouteCollection;
        $this->$dispacher= new Dispacher;
    }
    public function resolve($request){
        //Vai pegar o callback e os parametros baseado no request passado
        $route=$this->route_collection->getRoute();
        //Depois vai entregar ao despachante
    }
}