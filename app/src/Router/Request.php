<?php

namespace app\Router;

class Request{
    private $uri;
    private $method;
    private $data=[];
    public function __construct(){
        $this->method=strtoupper($_SERVER['REQUEST_METHOD'])    ;
        //Remove o query string se houver do uri
        //Deve ser armazenado em $data
        $this->uri=preg_replace('/\/\?([\w\W\s]+(=|\&)?)+/i','/',$_SERVER['REQUEST_URI']);
        $this->setData();
    }
    private function setData(){
        //Aqui cabe a proteção de dados
        switch($this->method){
            case 'POST':
                $this->data=$_POST;
                break;
            case 'GET':
                $this->data=$_GET;
                break;
        }  
    }
    public function uri(){
        return $this->uri;
    }
    public function method(){
        return $this->method;
    }
}