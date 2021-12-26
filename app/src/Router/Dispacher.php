<?php

namespace app\Router;

class Dispacher{
    public function dispach($result){
            if(is_callable($result->callback)){
                if(isset($result->params)){                    
                    call_user_func_array($result->callback,$result->params);
                }else{
                    call_user_func($result->callback);
                }
            }elseif(is_string($result->callback)){
                echo $result->callback;
            }else{
                return false;
            }
    }
}