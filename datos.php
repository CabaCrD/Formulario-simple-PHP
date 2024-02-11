<?php

// author: cabaCrd

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
    <link rel="stylesheet" type= "text/css" href="bootstrap.css"> <!-- MODIFICADO DE ORIGEN REMOTO A ORIGEN LOCAL -->
    <title>Datos.php</title>
</head>

<body>
    <header>
        <div class="container">
            <div class="d-flex justify-content-center col-12 mt-1 mb-1">
                <div class="p-3 mb-4 bg-primary text-white col-md-12 m-1">
                    <h2 class="mt-1 text-center "> Tarea 2: Desarrollo Web Entorno Cliente </h3>

                </div>
            </div>
        </div>
    </header>
    <?php
         //DECLARAMOS VARIABLES
        $contador = ($_POST["contador"]);
        if(empty($contador)){
            $contador = 1;
        }
        /** VARIABLES **/
        $nombre =  $_POST['nombre'];  
        $apellidos = $_POST['apellidos']; 
        $tipo =  $_POST["tipo"];
        $documento =  $_POST['documento'];
        $fechaNacimiento =  $_POST['Fnacimiento'];
        $correo =  $_POST["email"];
        $fecha =  date('d-m-Y');
        $titulo =  $_POST['acceso'];
        $preferente =  $_POST['preferencia']; 
        /** ERRORES **/
        $errorNombre = $_POST['errorNombre']; 
        $errorApellido = $_POST['errorApellido'];
        $errorCorreo = $_POST['errorCorreo'];
        $errorDocumento = $_POST['errorDocumento'];
        $errorFecha = $_POST['errorFecha'];
        $errorTitulo = $_POST['errorTitulo'];
        ?>
    <main>
        <div class="container">

            <div class="col-12">

                <fieldset>
                    
                    <!-- MOSTRAMOS LA FECHA Y EL NUMERO DE SOLICITUD -->
                    <legend title="fecha y número de solicitud" class="col-md-12 text-center">
                        Datos al <?php echo $fecha ?> Número de solicitud <?php echo $contador?>
                    </legend>

                        

                    <form title="Formulario de acceso" method="POST" action="procesa.php">

                        <div class="d-flex justify-content-md-center align-items-md-center col-md-12 mb-3">

                            <!-- PARTE DEL FORMULARIO CON LOS DATOS PERSONALES -->
                            <div class="col-md-6 " >
                                       
                                <h4 title="Datos personales">Datos Personales</h4>

                                <label for="nombre">Nombre</label>
                                <input type="text" title="Nombre" tabindex="1" id="nombre" name="nombre" class="form-control" value="<?php echo $nombre ?>" required>
                                <div class="text-danger"><?php echo $errorNombre ?></div>

                                <label for="apellidos">Apellidos</label>
                                <input type="text" title="Apellidos" tabindex="2" id="apellidos" name="apellidos" class="form-control" value="<?php echo $apellidos ?>" required> 
                                <div class="text-danger"><?php echo $errorApellido ?></div>

                                <label for="tipo">Tipo</label>
                                <select id="tipo" title="Tipo de documento" tabindex="3" name="tipo" class="form-control" placeholder="Seleccione una opción" required> 
                                    <option disabled selected hidden value="">Seleccione una opcion </option>
                                    <option value="NIF" <?php if ($tipo === 'NIF') echo 'selected'; ?>>NIF </option>
                                    <option value="NIE" <?php if ($tipo === 'NIE') echo 'selected'; ?>>NIE </option>
                                </select>
                                

                                <label for="documento">Documento</label>
                                <input type="text" title="Numero de documento" tabindex="4" id="documento" name="documento" class="form-control" maxlength="9" pattern="?[XYZ]\d{7,8}[TRWAGMYFPDXBNJZSQVHLCKE]{1}" value="<?php echo $documento ?>" required> 
                                <div class="text-danger"><?php echo $errorDocumento ?></div>

                                <label for="Fnacimiento">Fecha de nacimiento</label>
                                <input type="date" title="Fecha de nacimiento" tabindex="5" id="Fnacimiento" name="Fnacimiento" class="form-control" value="<?php echo $fechaNacimiento ?>" required> 
                                <div class="text-danger"><?php echo $errorFecha ?></div>

                                <label for="email">Correo Electronico</label>
                                <input type="email" title="Correo Electronico" tabindex="6" id="email" name="email" class="form-control" value="<?php echo $correo ?>" required> 
                                <div class="text-danger"><?php echo $errorCorreo ?></div>

                            </div>

                            <!-- PARTE DEL FORMULARIO CON LA TITULACION REQUERIDA -->

                            <div class="col-md-3 " >
                                
                                <h4 title="Forma de acceso" >Forma de acceso: </h4>
                                <div class="form-check">
                                    <input type="radio" title="Estudios universitarios superiores" tabindex="7" name ="acceso" id="Universitario Superior" value="Universitario Superior" class="form-check-input" <?php if ($titulo === 'Universitario Superior') echo 'checked'; ?> required>
                                    <label for="Universitario Superior" class="form-check-label">Estudios universitarios superiores</label>
                                </div>

                                <div class="form-check">
                                    <input type="radio" title="Estudios universitarios medios" tabindex="8" name ="acceso" id="Universitario Medio" value="Universitario Medio" class="form-check-input" <?php if ($titulo === 'Universitario Medio') echo 'checked'; ?>>
                                    <label for="Universitario Medio" class="form-check-label">Estudios universitarios medios</label>
                                </div>

                                <div class="form-check">   
                                    <input type="radio" title="Formación profesional" tabindex="9" name ="acceso" id="FP" value="FP" class="form-check-input" <?php if ($titulo === 'FP') echo 'checked'; ?>>
                                    <label for="FP" class="form-check-label">Formación profesional</label>
                                </div>

                                <div class="form-check">
                                    <input type="radio" title="Bachillerato" tabindex="10" name ="acceso" id="Bachillerato" value="Bachillerato" class="form-check-input" <?php if ($titulo === 'Bachillerato') echo 'checked'; ?>>
                                        <label for="Bachillerato" class="form-check-label">Bachillerato</label>           
                                </div>

                                <div class="form-check">
                                    <input type="radio" title="Prueba de acceso" tabindex="11" name ="acceso" id="Prueba Acceso" value="Prueba Acceso" class="form-check-input" <?php if ($titulo === 'Prueba Acceso') echo 'checked'; ?>> 
                                    <label for="Prueba Acceso" class="form-check-label">Prueba de acceso</label>
                                </div> 
                                <div class="text-danger"><?php echo $errorTitulo ?></div>

                                    <h4 class="mt-3" title="Vías de acceso preferente">Acceso preferente por: </h4>

                                    <div class="form-check">
                                        <input type="checkbox" title="Familia numerosa" tabindex="12" name ="preferencia[]" id="Familia Numerosa" value="Familia Numerosa" class="form-check-input" <?php if (is_array($preferente) && in_array('Familia Numerosa', $preferente)) echo 'checked'; ?> >
                                        <label for="Familia Numerosa" class="form-check-label">Familia numerosa</label>
                                    </div> 

                                    <div class="form-check">
                                        <input type="checkbox" title="Renta baja" tabindex="13" name ="preferencia[]" id="Renta" value="Renta" class="form-check-input" <?php if (is_array($preferente) && in_array('Renta', $preferente)) echo 'checked'; ?> >
                                        <label for="Renta" class="form-check-label">Renta baja</label>
                                    </div> 

                                    <div class="form-check">
                                        <input type="checkbox" title="Familia en paro" tabindex="14" name ="preferencia[]" id="Paro" value="Paro" class="form-check-input" <?php if (is_array($preferente) && in_array('Paro', $preferente)) echo 'checked'; ?> >
                                        <label for="Paro" class="form-check-label">Familia en paro</label>
                                    </div> 

                                    <div class="form-check">
                                        <input type="checkbox" title="Minusvalía" tabindex="15" name ="preferencia[]" id="Minusvalia" value="Minusvalia" class="form-check-input" <?php if (is_array($preferente) && in_array('Minusvalia', $preferente)) echo 'checked'; ?> >
                                        <label for="Minusvalia" class="form-check-label">Minusvalía</label>
                                    </div> 

                                    <div class="form-check">
                                        <input type="checkbox" title="Familia Monoparental" tabindex="16" name ="preferencia[]" id="Monoparental" value="Monoparental" class="form-check-input" <?php if (is_array($preferente) && in_array('Monoparental', $preferente)) echo 'checked'; ?> >
                                        <label for="Monoparental" class="form-check-label">Familia Monoparental</label>
                                    </div> 

                                </div>

                            </div>

                            <!-- PARTE DEL FORMULARIO CON LOS BOTONES DE BORRAR Y ENVIAR FORMULARIO -->
                            <div class="d-flex justify-content-center align-items-center text-center col-md-12">

                                <input type="reset" title="Borrar Formulario" tabindex="17" class="btn btn-danger m-3" id="borrar" name="borrar" value="Borrar todo">
                                <input type="submit" title="Enviar formulario" tabindex="18" class="btn btn-success  m-3" id="enviar" name="enviar" value="Enviar"> 

                                <!-- ENVIAMOS LA FECHA -->
                                <input type="hidden" value="<?php echo $fecha; ?>" id="fecha" name="fecha">  

                                <!-- ENVIAMOS EL CONTADOR -->
                                <input type="hidden" id="contador" name="contador" value="<?php echo $contador ?>"> 
                                
                            </div>

                        </div>

                    </form>

                </fieldset>

            </div>

        </div>
    </main>

</body>

</html>
