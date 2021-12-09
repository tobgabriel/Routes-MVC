<?php

class Dispacher{
    dispach($callback,$params=[]){
        //aqui ele vai verificar se é um callable ou entregar para o controller correto
        if(is_callable($callback)){
            return call_user_func($callback,array_values($params));
        }elseif(is_string($callback)){
            //XXX
            return false;
        }
    }
}