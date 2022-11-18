<?php
require_once('Validar.php');

class Radio extends Validar{

    //establecemos los valores de los radio buttons en un array
    private $sexo =['HOMBRE','MUJER','OTRO'];
    private $nombre="sexo";
    function getNombre(){return $this->nombre;}


    function crear($dato){
        //si el post esta vacio hacemos un array walk pasando por cada posicion del array sexo para crearlos por defecto colocando como nombre sexo y como value el op que le pasamos a la funcion
        if(empty($dato)){
            array_walk(
                $this->sexo,
                function($op, $k){
                    echo "$op<input type='radio' name='$this->nombre' value='$op'/>&nbsp;";
                });
        }else{
            //si la funcion comprobar devuelve true hacemos un array walk donde le pasamos el array de sexo, como tercer parametro le pasamos el radio button seleccionado y en la duncion tambien se lo pasamos como $data, dentro de la funcion comparamos si el elemento del array original es igual que el que recibimos y si es igual lo pintamos otra vez pero como checked y si no lo pintamos por defecto
            if($this->comprobar($dato,$this->nombre)){
                array_walk(
                    $this->sexo,
                    function($op, $k, $data){
                        
                        if(($op == $data)){
                            echo "$op<input type='radio' name='$this->nombre' value='$op' id='$op' checked/>&nbsp;";
                        }else{
                            echo "$op<input type='radio' name='$this->nombre' value='$op' id='$op'/>&nbsp;";
                        }
                    },$dato[$this->nombre]);
            }else{
                //si la funcion comprobar devuelve false se generara por defecto y saltara el error
                array_walk(
                    $this->sexo,
                    function($op, $k){
                        echo "$op<input type='radio' name='$this->nombre' value='$op' id='$op'/>&nbsp;";
                    });
                    echo $this->error();
            }

        }
    }

    function comprobar($array,$nombre){
        //array_key_exist comprueba si existe la clave sexo que pasamos en este caso en el array del post
        if(array_key_exists($nombre,$array)){
            return true;
        }else{
            return false;
        }
    }

    //nos devuelve el error
    function error(){
        return "<p>Error deben seleccionar una opcion de radio</p>";
    }
}
?>