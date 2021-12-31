<?php
    namespace app\Router;

    class RouteCollection{
        private $routes=[];
         //UTILITÁRIOS        
        private function definePattern($pattern) { 
            $pattern = $this->parseUri($pattern);
            return '/^' . str_replace('/', '\/', $pattern) . '$/';         
        }
        private function parseUri($uri){
            return $uri=="/" ? "/" : trim($uri,'/');
        }
        private function checkUrl($route,$pattern){
			$route= $this->parseUri($route);
			if(preg_match_all('/\{[\w]+\}/',$pattern,$matches)){
            	$fixPart=str_replace('/','\/',$pattern);
            	foreach($matches[0] as $variablePart){
                	$fixPart=str_replace($variablePart,'[\w]+',$fixPart);
            	}
                $fixPart="/^".$fixPart."$/";
                if(preg_match($fixPart,$route)){
                	return 2;
                }
            }elseif(preg_match($this->definePattern($route),$pattern)){
                return 1;
            }
            return 0;
        }
        private function getParams($route,$pattern){
            $fixedPartsToRemove=$pattern;
            if(preg_match_all('/\{[\w]+\}/',$pattern,$matches)){
                foreach($matches[0] as $variablePart){
                    $fixedPartsToRemove=str_replace($variablePart,'|',$fixedPartsToRemove);
                }
                $values=$this->parseUri($route);
                foreach(explode('|',$fixedPartsToRemove) as $part){
                    $values=str_replace($part,'|',$values);
                }
                    preg_match_all('/(?!\{)[\w]+(?=\})/',$pattern,$matches);
                    $params=array_combine($matches[0],explode('|',trim($values,'|')));
                    return $params;   
            }
        }
        //Acessores
        public function addRoute(string $method,string $route,$action){
            $route= $this->parseUri($route);
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
                    throw new \Exception('ERROR 0x0001:cadastro de requisições para este método não implementada.');
            }
        }
        public function getRoute($method, $route){
            $result= new stdClass;
            //Se existe rota cadastrada para o método
            if(array_key_exists($method,$this->routes)){
                foreach($this->routes[$method] as $existent_path=>$callback){
                    switch($this->checkUrl($route,$existent_path)){
                    	case 2:
                        	$result->params=$this->getParams($route,$existent_path);
                            $result->callback=$callback;
                            return $result;
                        break;
                        case 1:
                        	$result->callback=$callback;
                            return $result;
                        break;
                        case 0:
                        	continue;
                        break;
                        default:                        	
                        	throw new \Exception('ERROR 0x0002:falha na recuperação da rota.');
                    }
                }
            }
            return false;
        }
}
?>