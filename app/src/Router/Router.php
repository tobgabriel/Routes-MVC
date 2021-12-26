<?php

namespace app\Router;

class Router{
    protected $route_collection;
    protected $dispacher;

    public function __construct(){
        $this->route_collection= new RouteCollection();
        $this->dispacher= new Dispacher;
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
    public function find($request){
        $result=$this->route_collection->getRoute($request->method(),$request->uri());
        if($result){
            return $this->dispacher->dispach($result);
        }else{
            http_response_code(404);
            require dirname(__DIR__,2). '/public/my404.php';
            die();
        }
    }
}
    ?>