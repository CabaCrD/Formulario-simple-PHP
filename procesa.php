<?php

//author: cabaCrd

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type= "text/css" href="bootstrap.css"> <!-- MODIFICADO DE ORIGEN REMOTO A ORIGEN LOCAL -->
    <title>procesa.php</title>
</head>

<body>
    <?php
        

    ?>

    <header>
        <div class="container">
            <div class="d-flex justify-content-center col-12 mt-1 mb-1">
                <div class="p-3 mb-4 bg-primary text-white col-md-12 col-xs-12 m-1">
                    <h3 title="Puntos de acceso" class="mt-1 text-center "> PUNTUACION DE ACCESO </h3>

                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="col-12">
                <?php
                    //ARRAY ESTATICO CON LAS PUNTUACIONES DE CADA CASILLA
                    $baremo=array(  "Universitario Superior" => 10, 
                                    "Universitario Medio" => 8, 
                                    "FP" => 6,
                                    "Bachillerato" => 6, 
                                    "Prueba Acceso" => 4, 
                                    "Familia Numerosa" => 4, 
                                    "Renta" => 4,
                                    "Paro" =>6,
                                    "Minusvalia"=>5, 
                                    "Monoparental"=>3);
                    //DECLARAMOS VARIABLES
                    $contador =  intval($_POST["contador"]);
                    $nombre =  $_POST['nombre'];  
                    $apellidos = $_POST['apellidos']; 
                    $tipo =  $_POST["tipo"];
                    $documento =  $_POST['documento'];
                    $fechaNacimiento =  $_POST['Fnacimiento'];
                    $edad =  intval(date("Y") -  $fechaNacimiento);      
                    $correo =  $_POST["email"];
                    $fecha =  $_POST["fecha"];
                    $titulo =  $_POST['acceso'];
                    $puntosTitulo = intval($baremo[$titulo]);//PUNTOS POR TITULACION  
                    $preferente =  $_POST['preferencia']; 

                    /** ERRORES **/
                    $errorNombre = ""; 
                    $errorApellido = "";
                    $errorCorreo = "";
                    $errorDocumento = "";
                    $errorFecha = "";
                    $errorTitulo = "";
                    /**
                    * SI HAY ALGUN ERROR NOS DEVOLVERA A LA PAGINA Y NOS DIRÁ QUE HA PASADO
                    */    
                    validarNifNie($documento , $tipo);
                    validarEmail($correo);
                    validarVariables($edad, $nombre,$apellidos,$fechaNacimiento, $titulo);

                    if(validarNifNie($documento , $tipo) != true || validarEmail($correo) != true || validarVariables($edad, $nombre,$apellidos,$fechaNacimiento, $titulo) !=true){
                        echo '<form class="col-md-12 text-center" action="datos.php" method="post">';
                            echo "<h1>Tu formulario tiene algunos errores</h1>";
                            echo "<h2>Por favor, revíselo de nuevo</h2>";
                            
                            echo '<input type="submit" title="Enviar formulario" tabindex="1" class="btn btn-success  m-3" id="volver" name="volver" value="Volver al formulario">'; 
                            /*** INPUTS OCULTOS QUE SE VAN A ENVIAR ***/
                            echo '<input type="hidden" value=" '.   $contador       . ' " id="contador" name="contador">';
                                                            /*** LOS ERRORES ***/
                            echo '<input type="hidden" value="' .   $errorNombre    . '" id="errorNombre" name="errorNombre">';
                            echo '<input type="hidden" value="' .   $errorApellido  . '" id="errorApellido" name="errorApellido">';
                            echo '<input type="hidden" value="' .   $errorCorreo    . '" id="errorCorreo" name="errorCorreo">';
                            echo '<input type="hidden" value="' .   $errorDocumento . '" id="errorDocumento" name="errorDocumento">';
                            echo '<input type="hidden" value="' .   $errorFecha     . '" id="errorFecha" name="errorFecha">';
                            echo '<input type="hidden" value="' .   $errorTitulo    . '" id="errorTitulo" name="errorTitulo">';
                                                            /*** LOS DATOS INTRODUCIDOS ***/
                            echo '<input type="hidden" value="' .     $nombre          . '" id="nombre" name="nombre">';
                            echo '<input type="hidden" value="' .     $apellidos       . '" id="apellidos" name="apellidos">';
                            echo '<input type="hidden" value="' .     $correo          . '" id="email" name="email">';
                            echo '<input type="hidden" value="' .     $tipo            . '" id="tipo" name="tipo">';
                            echo '<input type="hidden" value="' .     $documento       . '" id="documento" name="documento">';
                            echo '<input type="hidden" value="' .     $fechaNacimiento . '" id="Fnacimiento" name="Fnacimiento">';
                            echo '<input type="hidden" value="' .     $titulo          . '" id="acceso" name="acceso">';
                            
                            if(!empty($preferente)){//SI PREFERENTE NO ESTÁ VACIO ...
                                foreach ($preferente as $preferentes) {//BUCLE QUE MUESTRA TODOS LOS ELEMENTOS DEL CHECKBOX
                                    echo '<input type="hidden" value="' . $preferentes . '" name="preferencia[]">';
                                }
                            }

                        echo "</form>";
                        return;
                    }
                ?>
                <fieldset>
                    <legend title="Baremacion"class="text-center">BAREMACION AL <?php echo $fecha ?></legend>
                        <div class="d-flex flex-column ">
                            <h5 title="Solicitante" >SOLICITANTE: <?php echo $nombre." ". $apellidos. " <b>" . $tipo ."</b>: " .  $documento ?></h5>
                            <h5 title="Edad" >Edad en el año <?php echo date("Y")?>: <?php echo $edad ?></h5>
                            <h5 title="Correo electronico" >Correo : <?php echo $correo ?></h5>
                            <h5 title="Puntos por titulacion" >Puntos por titulacion:</h5>
                                <?php 
                                    /**
                                     * MOSTRAMOS POR PANTALLA EL TITULO Y LOS PUNTOS QUE TE DA
                                     */

                                    echo "<ul>";
                                    echo "<li>".$titulo.": ".$puntosTitulo."</li>";
                                    echo "</ul>";

                                ?>
                            <h5 title="Acceso Preferente" >Acceso Preferente:</h5>

                                <?php 

                                    $puntosPreferencia = 0; //DECLARAMOS LOS PUNTOS A 0
                                    echo "<ul>"; //SERA UNA LISTA DESORDENADA

                                        if(empty($preferente)){ //SI NO SELECCIONAMOS NINGUN ACCESO PREFERENTE
                                            $preferente = "No se selecciono ninguna opción";
                                            print "<p>" . $preferente . "</p>";

                                        }else{ // SI SELECCIONAMOS ALGUNO

                                            foreach ($preferente as $preferentes) {//BUCLE QUE MUESTRA TODOS LOS ELEMENTOS DEL CHECKBOX
                                                $puntosPreferencia += intval($baremo[$preferentes]);//SUMA LOS PUNTOS DE TODOS LOS CHECKBOX
                                                print "<li>" . $preferentes . ": " . $baremo[$preferentes] . "</li>";//MUESTRA LOS PUNTOS DE CADA OPCION SELECCIONADA     
                                            
                                            }

                                        }

                                      echo "</ul>";
                                ?>

                            <h5 title="Puntos por Acceso Preferente" >Puntos por Acceso Preferente: <?php echo $puntosPreferencia ?></h5>
                            <h2 title="Total Puntos Obtenidos" >Total Puntos Obtenidos: <?php echo $puntosPreferencia + $puntosTitulo ?> </h2>
                        </div>
                        <div class="d-flex justify-content-center">
                            <form action="datos.php" method="post">
                                <input title="volver" tabindex="1" type="submit" id="volver" name="volver" value="Volver al formulario" class="btn btn-success">
                                <!-- ENVIAMOS EL CONTADOR DE SOLICITUDES SUMANDOLE UNO A ESTA -->
                                <input type="hidden" value="<?php echo $contador + 1 ; ?>" id="contador" name="contador">
                                <?php

                                    /*** 
                                     * 
                                    echo '<input type="hidden" value="'   .     $nombre          . '" id="nombre" name="nombre">';
                                    echo '<input type="hidden" value="'   .     $apellidos       . '" id="apellidos" name="apellidos">';
                                    echo '<input type="hidden" value="'   .     $correo          . '" id="email" name="email">';
                                    echo '<input type="hidden" value="'   .     $tipo            . '" id="tipo" name="tipo">';
                                    echo '<input type="hidden" value="'   .     $documento       . '" id="documento" name="documento">';
                                    echo '<input type="hidden" value="'   .     $fechaNacimiento . '" id="Fnacimiento" name="Fnacimiento">';
                                    echo '<input type="hidden" value="'   .     $titulo          . '" id="acceso" name="acceso">';
                                    
                                    if(!empty($preferente)){
                                        foreach ($preferente as $preferentes) {
                                            echo '<input type="hidden" value="' . $preferentes . '" name="preferencia[]">';
                                        }
                                    }

                                    ***/

                                ?>
                            </form>
                        </div>
                    </fieldset>
            </div>
        </div>
    </main>
</body>
</html>

<?php

/** 
 * CON ESTA FUNCION VALIDAREMOS EL RESTO DE LAS ENTRADAS DE DATOS
*/

function validarVariables($edad, $nombre,$apellidos,$fechaNacimiento, $titulo){
    global $errorNombre, $errorApellido, $errorFecha, $errorTitulo;

    if(empty($nombre)){//SI SE ENCUENTRA VACIO
        
        $errorNombre = "El campo 'nombre' es obligatorio";
        return false;

    } 
    
    if(empty($apellidos)){//SI SE ENCUENTRA VACIO 

        $errorApellido = "El campo 'apellidos' es obligatorio";
        return false;

    }if(empty($fechaNacimiento)){//SI SE ENCUENTRA VACIO

        $errorFecha = "La fecha de nacimiento es obligatoria";
        return false;

    }if(intval($edad) < 18){//SI ES MENOR DE EDAD

        $errorFecha = "No cumples con la edad legal para poder acceder al curso";
        return false;

    }if(empty($titulo)){//SI SE ENCUENTRA VACIO

        $errorTitulo = "Es obligatorio tener alguna de estas titulaciones";
        return false;

    }

        return true;

}

/**
 * CON ESTA FUNCION VALIDAREMOS QUE EL DNI/NIE SEA CORRECTO 
 */

function validarNifNie($documento, $tipo) {

    global $errorDocumento;

    $RegExNIF = '/^\d{8}[TRWAGMYFPDXBNJZSQVHLCKE]{1}$/'; //EXPRESION REGULAR PARA EL DNI
    $RegExNIE = '/^[XYZ]{1}\d{7}[TRWAGMYFPDXBNJZSQVHLCKE]{1}$/'; //EXPRESION REGULAR PARA EL NIE
    $letrasValidas="TRWAGMYFPDXBNJZSQVHLCKE"; //LETRAS VALIDAS

    switch ($tipo) {

        case "NIF":

            if (preg_match($RegExNIF, $documento)) {//SI SE CUMPLE EL PATRON

                $numero = substr($documento, 0, 8);//ELIMINAMOS LA LETRA DEL DNI
                $numero = intval($numero);//TRANSFORMAMOS A INT
                $indice = $numero % 23; //CALCULAMOS EL INDICE
                $letraCalculada = $letrasValidas[$indice]; //CALCULAMOS LA LETRA VALIDA EN EL INDICE
                $letra = $documento[8]; // OBTENEMOS LA LETRA DEL NIF

                if ($letra === $letraCalculada) { //SI COINCIDE

                    return true;

                } else { //SI NO COINCIDE

                    $errorDocumento = "La letra de control del NIF es incorrecta";
                    return false;
                }

            }else{

                $errorDocumento = "El NIF no es válido";
                return false;

            }

            break;

        case "NIE":

            if (preg_match($RegExNIE, $documento)) {//SI SE CUMPLE EL PATRON

                $letraNIE = substr($documento, 0, 1);//OBTENEMOS LA LETRA DEL NIE
                $numero = substr($documento, 1, 7);//ELIMINAMOS LAS LETRAS DEL NIE
                //SI EL NIF CONTIENE LA X
                if($letraNIE == "X"){ $numero = "0" . $numero; }
                //SI EL NIF CONTIENE LA Y
                if($letraNIE == "Y"){ $numero = "1" . $numero; }
                //SI EL NIF CONTIENE LA Z
                if($letraNIE == "Z"){ $numero = "2" . $numero; }
                $numero = intval($numero);//TRANSFORMAMOS A INT
                $indice = $numero % 23; //CALCULAMOS EL INDICE
                $letraCalculada = $letrasValidas[$indice]; //CALCULAMOS LA LETRA VALIDA EN EL INDICE
                $letra = $documento[8]; // OBTENEMOS LA LETRA DEL NIF

                if ($letra === $letraCalculada) { //SI COINCIDE

                    return true;

                } else { //SI NO COINCIDE

                    $errorDocumento = "La letra de control del NIE es incorrecta";

                    return false;

                }

            }else{

                $errorDocumento = "El NIE no es válido";
                return false;

            }

            break;

        default:

            $errorDocumento = "Tipo de documento inválido";
            return false;

        }   
}
/**
 * CON ESTA FUNCION VALIDAREMOS QUE EL CORREO ELECTRONICO SEA CORRECTO 
 */

function validarEmail($email){

    global $errorCorreo;

    if (empty($email)){

        $errorCorreo = "El campo 'Correo Electronico' es obligatorio";
        return false;

    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //LA FORMA MAS SENCILLA DE VALIDAR UN EMAIL
        return true;

    }else{

        $errorCorreo = "correo electrónico invalido";
        return false;

    }

}

?>
