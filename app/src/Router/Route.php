<?php

namespace app\Router;

class Route{
    public static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance=new Router();
        }
        return self::$instance;
    }

    public static function get(string $route,$action){
        self::getInstance()->get($route,$action);
    }
    public static function post(string $route,$action){
        self::getInstance()->post($route,$action);
    }
    public static function put(string $route,$action){
        self::getInstance()->put($route,$action);
    }
    public static function delete(string $route,$action){
        self::getInstance()->get($route,$action);
    }
    public static function find($request){
        self::getInstance()->find($request);
    }

}