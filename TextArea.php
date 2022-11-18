<?php
require_once('Validar.php');

class TextArea extends Validar{

    private $nombre="Descripcion";
    function getNombre(){return $this->nombre;}

    function crear($valor){
            //si el post esta vacio se crea por defecto 
            if(empty($valor)){
                echo "<textarea placeholder='Escribe sobre el hobbie/s seleccionados u otro que te guste' rows='5' cols='50' name='$this->nombre'></textarea>";
            }else{
                //se llama a la funcion comprobar si devuelve true se pinta con el valor que se le ha pasado a la funcion
                if($this->comprobar($valor,$this->nombre)){
                    echo "<textarea placeholder='Escribe sobre el hobbie/s seleccionados u otro que te guste' rows='5' cols='50' name='$this->nombre'>".$valor[$this->nombre]."</textarea>";
                }else{
                    //si devuelve false se pinta por defecto y devuelve un error
                    echo "<textarea placeholder='Escribe sobre el hobbie/s seleccionados u otro que te guste' rows='5' cols='50' name='$this->nombre'></textarea>";
                    echo $this->error();
                }
            }
        
    }
    //$valor=POST
    function comprobar($valor,$nombre){
        //array_key_exist comprueba si existe la clave descripcion que pasamos en este caso en el array del post
        // tambien comprueba si la key de post que nos devuelve esta vacio 
        if(array_key_exists($nombre,$valor) && !empty($valor[$nombre])){
            return true;
        }else{
            return false;
        }
    }

    function error(){
        return "<p>Error deben escribir algo sobre tu hobbies u otros</p>";
    }
}
?>