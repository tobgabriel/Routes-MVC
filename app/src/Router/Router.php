<?php

namespace app\Router;

class Router{
    protected $route_collection;
    //protected $dispacher;

    public function __construct(){
        $this->route_collection= new RouteCollection();
        //$this->$dispacher= new Dispacher();
    }
    public function get(string $route,$action){
        try{
            $this->route_collection->addRoute('GET',$route,$action);
        }catch(Exception $e){
            echo $e->getMessage();
        }
        
    }
    public function post(string $route,$action){
        try{
            $this->route_collection->addRoute('POST',$route,$action);
        }catch(Exception $e){
            echo $e->getMessage();
        }
        
    }
    public function put(string $route,$action){
        try{
            $this->route_collection->addRoute('PUT',$route,$action);
        }catch(Exception $e){
            echo $e->getMessage();
        }
        
    }
    public function delete(string $route,$action){
        try{
            $this->route_collection->addRoute('DELETE',$route,$action);
        }catch(Exception $e){
            echo $e->getMessage();
        }
        
    }
    public function find($method,$route){
        $result=$this->route_collection->getRoute($method,$route);
        if($result){
            //é aqui que vou entregar pro dispacher pra ele se virar
            if(is_callable($result)){
            	$result();
                return true;
            }elseif(is_string($result)){
            	echo $result;
                return true;
            }
        }else{
            echo "<br>não achou";
        }
    }
}
    ?>