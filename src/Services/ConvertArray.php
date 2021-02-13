<?php

namespace App\Services;

class ConvertArray
{
    public function __construct(){}

    public function subsArray(array $arrayEntrada, array $keys):array
    {
        $respuesta = array();
        for($i=0; $i < count($arrayEntrada); $i++){
            foreach($keys as $key){
                if(isset($arrayEntrada[$i][$key])){
                    $respuesta[$i][$key] = $arrayEntrada[$i][$key];
                }                
            }
        }
        return $respuesta;
    }
}