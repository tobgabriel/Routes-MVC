<?php

namespace app\Router;

class Dispatcher{
    public function dispatch($result,$namespace= "app\\MVC\\"){
        if (is_callable($result->callback)) {
            if (isset($result->params)) {
                call_user_func_array($result->callback, $result->params);
            } else {
                call_user_func($result->callback);
            }
        } elseif (is_string($result->callback)) {
            if(strpos($result->callback,"@")!==false){
                $callback=explode("@",$result->callback);
                $controller=$namespace.$callback[0];
                $method=$callback[1];
                $instance=new \ReflectionClass($controller);
                if($instance->isInstantiable() && $instance->hasMethod($method)){
                    if (isset($result->params)){
                        call_user_func_array(array(new $controller,$method), $result->params);
                    } else{
                        call_user_func(array(new $controller,$method));
                    }
                }

            }else{
                throw new \Exception(
                    "ERROR 0X003:falha na busca do controller"
                );
            }
        } else {
            throw new \Exception(
                "ERROR 0x004: falha no callback da função."
            );
        }
    }
}
?>