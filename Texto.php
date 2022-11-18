<?php
require_once('Validar.php');

class Texto extends Validar{
    private $cadena;

    function crear($dato,$max,$min,$valor){
        $this->cadena=$dato;
        //si el post esta vacio crea el input por defecto con el max y el min length pasado por parametro ademas de el nombre de el label
        if(empty($valor)){
            echo "$dato <input type='text' maxlength='$max' minlength='$min' name='$dato' value='' id='$dato'><br>";
        }else{
            //llamamos a la funciion comprobar si esta devuelve true se pinta con el valor
            if($this->comprobar($valor,$dato)){
                echo "$dato <input type='text' maxlength='$max' minlength='$min' name='$dato' value='".$valor[$dato]."' id='$dato'><br>";
            }else{
                //si hay un error se pint apor defecto con el error 
                echo "$dato <input type='text' maxlength='$max' minlength='$min' name='$dato' value='' id='$dato'><br>";
                echo $this->error();

            }
        }
    }

    function comprobar($array,$cadena){
        //array_key_exists comprueba si existe la key de la cadena en el array del post 
        //tambien verificas si esa key esta vacia
        if(array_key_exists($cadena,$array) && !empty($array[$cadena])){
            return true;
        }else{
            return false;
        }
    }


    function error(){
        return "<p>Error deben introducir $this->cadena </p>";
    }
}
?>