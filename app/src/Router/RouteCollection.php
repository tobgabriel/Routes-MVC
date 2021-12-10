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

    namespace app\Router;

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
            $route=$this->parseUri($route);
            switch($method){
                case 'GET':
                    $this->routes['GET'][$route]=$action;
                    break;
                case 'POST':
                    $this->routes['POST'][$route]=$action;
                    break;
                case 'PUT':
                    $this->routes['PUT'][$route]=$action;
                    break;
                case 'DELETE':
                    $this->routes['DELETE'][$route]=$action;
                    break;
                default:
                    throw new \Exception('Tipo de requisição não implementado');
            }
        }
        //Procura o retorno da rota
        public function getRoute(string $method, string $route){
            $method=strtoupper($method);
            $route=$this->definePattern($route);            
            //Se existe rota cadastrada para o método
            if(array_key_exists($method,$this->routes)){
                //se tem rota cadastrada então procure o que se encaixa no padrão passado
            	foreach($this->routes[$method] as $existent_path=>$callback){
                	if(preg_match($route,$existent_path)){
                    	return $callback;
                    }
                }
            }
            return false;
    	}
    }
?>