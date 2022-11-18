<?php
require_once('Validar.php');

class Numero extends Validar{

    private $nombre;

    function crear($dato,$max,$min,$valor){
        //hacemos el setter del nombre del input para usarlo para el label y para el error
        $this->nombre=$dato;
        //si $valor que es el post esta vacio lo crea por defecto por que no se ha enviado ninguna vez
        if(empty($valor)){
            echo "$dato <input type='number' size='1' max='$max' min='$min' name='$dato' value='' id='$dato'>";
        }else{
            //si la funcion comprobar devuelve true se coloca en el value el valor que le hemos pasado
            if($this->comprobar($valor,$dato)){
                echo "$dato <input type='number' size='1' max='$max' min='$min' name='$dato' value='".$valor[$dato]."' id='$dato'>";
            }else{
                //si la funcion comprobar devuelve false salta el error y lo crea por defecto
                echo "$dato <input type='number' size='1' max='$max' min='$min' name='$dato' value='' id='$dato'>";
                //llamamos aqui a la funcion error
                echo $this->error();
            }
        }
    }

    function comprobar($array,$numero){
        //array_key_exist comprueba si existe la clave edad que pasamos en este caso en el array del post
        // tambien comprueba si el array de edad que nos devuelve esta vacio 
        if(array_key_exists($numero,$array) && !empty($array[$numero])){
            return true;
        }else{
            return false;
        }
    }

    //nos devuelve el error con el nombre del label que introducimos en el main y utilizamos para crear los input
    function error(){
        return "<p>Error deben introducir $this->nombre </p>";
    }
}
?>