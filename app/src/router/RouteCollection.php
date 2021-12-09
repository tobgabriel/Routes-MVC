<?php
    /*
    *  Autor: Tiago de Oliveira Braga Gabriel
    *  Data: 07-12-2021
    *  Revisão:07-12-2021
    *  
    *   A função desta classe é salvar os callables de resposta a rota
    *   no array e prover métodos para cadastro desses callables e recuperação
    *   add($method,$route,$action) e where
    */

    class RouteCollection{
        //Variável que salva as rotas
        private $routes=[];

        //Parser da uri para expressão regular
        // /ola-mundo/teste1/teste2 =>/^ola-mundo\/teste1\/teste2$/
        // ola-mundo/teste1/teste2 =>/^ola-mundo\/teste1\/teste2$/
        private function definePattern($pattern) { 
            $pattern = implode('/', array_filter(explode('/', $pattern)));
            return '/^' . str_replace('/', '\/', $pattern) . '$/';         
        }
        //Funções privadas para adicionar os callables no array
        private function addGet(string $route,callable $action){
           $this->routes['GET'][$this->definePattern($route)]=$action;
        }
        private function addPost(string $route,callable $action){
            $this->routes['POST'][$this->definePattern($route)]=$action;
         }
        private function addPut(string $route,callable $action){
            $this->routes['PUT'][$this->definePattern($route)]=$action;
         }
         private function addDelete(string $route,callable $action){
            $this->routes['DELETE'][$this->definePattern($route)]=$action;
         }
        //Função pública de cadastro de rota
        public function add($method,$route,$action){
            switch($method){
                case 'post':
                    $this->addPost($route,$action);
                    break;
                case 'get':
                    $this->addGet($route,$action);
                    break;
                case 'put':
                    $this->addPut($route,$action);
                    break;
                case 'delete':
                    $this->addDelete($route,$action);
                default:
                    throw new \Exception('Tipo de requisição não implementado');
            }
        }  
    }