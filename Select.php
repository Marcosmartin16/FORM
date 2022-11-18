<?php
require_once('Validar.php');

class Select extends Validar{

    //establecemos los valores del select en un array
    private $Provincia = [" ","MADRID","BARCELONA","VALENCIA","MURCIA","SEVILLA"];
    private $nombre="Provincia";
    function getNombre(){return $this->nombre;}


    function crear($valor){
            //si el post esta vacio se crea por defecto primero hacemos un echo de un select para hacer la estructura colocando el nombre y el id que usamos anteriormente luego hacemos un array walk para generar las distintas opciones del select pasando el array y dentro de la funcion un echo del option con el value con el op y el op dentro para que se vea y fuera del array walk un ultimo echo para cerrar el select
            if(empty($valor)){
                echo"<select name='$this->nombre' id='$this->nombre'>";
                    array_walk(
                        $this->Provincia,function($op,$k){
                            echo"<option value='$op'>$op</option>";
                    });
                    echo"</select>";
            }else{
                //si el post no esta vacio llamamos a la funcion comprobar si devuelve true hacemos un array_shift para elimiar el primer lemento del array que es el hueco en blanco luego creamos la cabecera del select de forma normal y hacemos un arraywalk pasandole el array de provincias, como tercer parametro la provincia que recuperamos del post y en la funcion se lo pasamos tambien como $seleccionado y hacemos la comparacion si el seleccionado es distinto que el op se pinta por defecto si no se pinta con selected
                if($this->comprobar($valor,$this->nombre)){
                    array_shift($this->Provincia);
                    echo"<select name='$this->nombre' id='$this->nombre'>";
                        array_walk($this->Provincia,function($op,$k,$seleccionado){
                            if($seleccionado!=$op){
                                echo "<option value='$op'>$op</option>";
                            }else{
                                echo "<option value='$op' selected>$op</option>";
                            }
                        },$valor[$this->nombre]);
                    echo"</select>";
                }else{
                    //si la funcion comprobar devuelve false se pinta el select por defecto y se llama a la funcion de error
                    echo"<select name='$this->nombre' id='$this->nombre'>";
                    array_walk($this->Provincia,function($op,$k){
                        print("<option value='$op'>$op</option>");
                    });
                    echo"</select>";
                    echo $this->error();
                }
            }
    }

    function comprobar($valor,$nombre){
        //array_key_exist comprueba si existe la clave provincia que pasamos en este caso en el array del post
        // tambien comprueba si la key de provincia que nos devuelve esta vacio 
        if(array_key_exists($nombre,$valor) && $valor[$nombre] != " "){
            return true;
        }else{
            return false;
        }
    }

    function error(){
        return "<p>Error deben Seleccionar un opcion</p>";
    }
}
?>