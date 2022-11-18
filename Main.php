<?php

//EN LA FUNCION COMPROBAR EL $VALOR ES LA PARTE DEL POST Y EL $THIS ES EL VALOR REAL


//Funcion Autoload
spl_autoload_register(function ($class){
    $classPath ="./";
    require("$classPath${class}.php");
});

$select = new Select();
$check = new CheckBox();
$radio = new Radio();
$numero = new Numero();
$textoN = new Texto();
$textoAp = new Texto();
$textA = new TextArea();
$labelNumber = "Edad";
$labelNombre = "Nombre";
$labelApellido = "Apellido";

/*function cleanData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}*/

//si se ha enviado
if(isset($_POST['enviar'])){
    //comprobamos con cada funcion si cada elemento de el post es valido
    if(
        $textoN->comprobar($_POST,$labelNombre) &&
        $textoAp->comprobar($_POST,$labelApellido) &&
        $textA->comprobar($_POST,$textA->getNombre()) &&
        $select->comprobar($_POST,$select->getNombre()) &&
        $radio->comprobar($_POST,$radio->getNombre()) &&
        $check->comprobar($_POST,$check->getNombre()) &&
        $numero->comprobar($_POST,$labelNumber)
    ){
        $check->setCadenas($_POST[$check->getNombre()]);
        file_put_contents(
            "datoPesona.csv",
            $_POST[$labelNombre].";".$_POST[$labelApellido].";".$_POST[$labelNumber].";".$_POST[$radio->getNombre()].";".$_POST[$select->getNombre()].";".$check->getCadenas().";".$_POST[$textA->getNombre()]."\n",
            FILE_APPEND
           );
        //cleanData($_POST);
        //$_POST=array();

        //pdf
        //requerimos la carpeta que contiene todos los elementos para generar el pdf
        require('fpdf184/fpdf.php');
        $pdf = new FPDF();
        //creamos una nueva pagina
        $pdf -> AddPage();
        
        //colocamos la fuente el tamaño de la letra
        $pdf -> SetFont('Arial', '', 10);
        //colocamos el mensaje
        $pdf -> MultiCell(0,5, 'Hola mi nombre es ' . $_POST[$labelNombre] . ' ' . $_POST[$labelApellido] . ' actualmente vivo en ' . $_POST[$select->getNombre()] . '. Tengo ' .  $_POST[$labelNumber] . ' anios y mis aficiones son ' .  $check->getCadenas() . ' en especial ' . $_POST[$textA->getNombre()]);
        $pdf -> Output();
    }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p{
            margin-top: 5px;
            margin-bottom: -5px;
            color:red;
            font-weight: bolder;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <h1>DATOS PERSONALES</h1>
    <form action="" method="post">
        <fieldset><legend>DATOS PERSONALES</legend>
            <?php $textoN->crear($labelNombre,20,4,$_POST);?><br>
            <?php $textoAp->crear($labelApellido,20,4,$_POST);?><br>
            <?php $numero->crear($labelNumber,99,18,$_POST);?><br>
            <b>SEXO: </b> <br>
                <?php $radio->crear($_POST); ?><br>

            <b>SELECCIONE PROVINCIA:</b><br>
                <?php $select->crear($_POST); ?>

        </fieldset>
        <fieldset><legend>HOBBIES</legend>
            <?php $check->crear($_POST);?><br>
            <?php $textA->crear($_POST);?><br>
        </fieldset>
        <input type="submit" value="enviar" name="enviar"/>
    </form>
</body>
</html>