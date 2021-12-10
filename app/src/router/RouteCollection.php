<?php
    /*
    *  Autor: Tiago de Oliveira Braga Gabriel
    *  Data: 07-12-2021
    *  Revisão:09-12-2021
    *  
    *   A função desta classe é salvar os callables de resposta a rota
    *   no array e prover métodos para cadastro desses callables e recuperação
    *   add($method,$route,$action) e where
    */

    class RouteCollection{
        //Array associativo salva rotas no modelo:
        // $routes['GET']['ola-mundo'] = function(){echo "ola mundo!";}
        private $routes=[];
        
        //UTILITÁRIOS
        //Parser da uri para expressão regular a ser buscada na rota. Ex.:
        // /ola-mundo/teste1/teste2 =>/^ola-mundo\/teste1\/teste2$/
        // ola-mundo/teste1/teste2 =>/^ola-mundo\/teste1\/teste2$/
        private function definePattern($pattern) { 
            $pattern = implode('/', array_filter(explode('/', $pattern)));
            return '/^' . str_replace('/', '\/', $pattern) . '$/';         
        }
        //Garante a remoção de / no início e no final da uri
        private function parseUri($uri){
            return implode('/', array_filter(explode('/', $uri)));
        }
        //Função pública de cadastro de rota
        public function addRoute(string $method,string $route,$action){
            $method=strtoupper($method);
            $route=parseUri($route);
            switch($method){
                case 'get':
                    $this->routes['GET'][$this->definePattern($route)]=$action;
                    break;
                case 'post':
                    $this->routes['POST'][$this->definePattern($route)]=$action;
                    break;
                case 'put':
                    $this->routes['PUT'][$this->definePattern($route)]=$action;
                    break;
                case 'delete':
                    $this->routes['DELETE'][$this->definePattern($route)]=$action;
                default:
                    throw new \Exception('Tipo de requisição não implementado');
            }
        }
        //Procura o callable referente ao método e rota desejado
        public function getRoute(string $method, string $route){
            $method=strtoupper($method);
            //padrão que vai ser utilizado no preg_match
            $route=definePattern($route);
            //se o método está vazio retorne exceção
            //senão se tem rota cadastrada então busque por métodos
            //compatíveis com o padrão informado iterando o array
            if(empty($this->routes[$method])){
                throw new \Exception('Sem ações cadastradas para esse método')
            }else{
                foreach($this->routes[$method] as $existent_route=>$callback){
                    if(preg_match($route,$existent_route)){
                        //TODO
                        //aqui eu tenho que retornar o callback e os parametros
                        //então eu vou precisar verificar na url quem é parametro
                        echo "+++>Achei a rota"
                    }else{
                        throw new \Exception('Rota inexistente')
                    }
                }
            }
        }  
    }