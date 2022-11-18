<?php
require_once('Validar.php');

class CheckBox extends Validar{

    private $Hobbies =["DEPORTES","LECTURA","VIDEOJUEGOS","CINE"];
    private $nombre="hobbies[]";
    private $cadenas;
    
    function setCadenas($array){
        foreach($array as $valor){
            $this->cadenas.=$valor.",";
        }
    }
    function getCadenas(){return $this->cadenas;}

    function getNombre(){return substr($this->nombre,0,strlen($this->nombre)-2);}


    function crear($arrayEnviado){
        if(empty($arrayEnviado)){
            array_walk(
                $this->Hobbies,
                function($op, $k){
                    echo "$op<input type='checkbox' value='$op' name='$this->nombre' />&nbsp;";
                }
            );
        }else{
            if($this->comprobar($arrayEnviado,$this->getNombre())){
                array_walk(
                    $this->Hobbies,
                    function($op, $k, $data){
                        
                        if(in_array($op, $data)){
                            echo "$op<input type='checkbox' value='$op' name='$this->nombre' checked/>&nbsp;";
                        }else{
                            echo "$op<input type='checkbox' value='$op' name='$this->nombre'/>&nbsp;";
                        }
                    },$arrayEnviado[$this->getNombre()]);
            }else{
                array_walk(
                    $this->Hobbies,
                    function($op, $k){
                        echo "$op<input type='checkbox' value='$op' name='$this->nombre' />&nbsp;";
                    }
                );
                echo $this->error();
            }
        }
    }

    function comprobar($array,$nombre){
        if(array_key_exists($nombre,$array)){
            return true;
        }else{
            return false;
        }
    }

    function error(){
        return"<p>Error Deben Seleccionar al menos una CheckBox</p>";
    }
}
?>