<?php
    $codigo = base64_decode($_GET['id']);
    $codigoM = base64_decode($_GET['cm']);

    include('conexion.php');
    include('header.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta de paciente</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/alta_pacientes.css" />

    <link rel="stylesheet" href="assets/css/ace-fonts.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/ace.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="assets/css/estilos.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>
<body>

<script type="text/javascript">
window.onload = function(){
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
  document.getElementById('inputFechaNac').value=ano+"-"+mes+"-"+dia;
}
</script>

<?php 
$fecha_actual = date("Y-m-d");
?>

        <div class="principal">
            <form method="POST" class="form-alta" id="register-form" action="insertar_paciente.php">
              
            <div class="title">
                <p id="lblCita" style="color: white;"> Alta Paciente </p>
            </div>
              <div class="form-row">
                <?php 
                $sql = "SELECT * FROM CatMedico WHERE iCodEmpresa = '$codigo' AND iCodMedico = '$codigoM'";
                $query = mysqli_query($conn,$sql);
                $datos = mysqli_fetch_assoc($query);
                ?>
                <input type="hidden" name="correo" value="<?php echo $datos['vchCorreo'] ?>">
                <input type="hidden" name="empresa" value="<?php echo $datos['iCodEmpresa'] ?>">
                <input type="hidden" name="pais" value="<?php echo $datos['vchPais'] ?>">
                <input type="hidden" name="estado" value="<?php echo $datos['vchEstado'] ?>">
                <input type="hidden" name="ciudad" value="<?php echo $datos['vchCiudad'] ?>">
                <input type="hidden" name="codigoM" value="<?php echo $datos['iCodMedico'] ?>">
                <input type="hidden" name="fecha_hoy" value="<?php echo $fecha_actual ?>">

                            <div class="form-paciente">
                              <span class="title-paciente"> Paciente </span>

                                <div class="form-input">
                                    <!--:->
                                    <label for="nombrePaciente" id="lblNombre" class="required">Nombre</label>
                                    <!-:-->
                                    <input type="text" name="nombrePaciente" id="nombrePaciente" placeholder="Nombre" required/>
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label class="required" id="lblEspecie">Especie</label>
                                    <!-:-->
                                    <select id="sltEspecie" name="codigoEspecie" onchange="ShowSelected();"> 
                                    <option id="optEspecie" value="" selected="selected">Seleccionar Especie</option>
                                        <?php
                                          $consulta = "SELECT iCodEspecie, vchEspecie FROM CatEspecies WHERE iCodEmpresa = '$codigo' ORDER BY vchEspecie ASC";
                                          $result = mysqli_query($conn,$consulta); 
                                        while($especies = $result->fetch_assoc()) { ?>
                                        <option id="optEspecie" value="<?php echo $especies['iCodEspecie']; ?>"> <?php echo $especies['vchEspecie']; ?> </option>
                                        <?php } ?>
                                    </select>

                                <script type="text/javascript">    
                                function validar() {
                                    var select = document.getElementById("sltEspecie").value;
                                    var raza = document.getElementById("sltRaza").value;

                                if(select == ""  || raza == ""){
                                    alert("Faltan datos");
                                    return false;
                                }
                                else {
                                    return true;
                                    }
                                }    
                                </script>
                                

                                <script type="text/javascript">
                                    function ShowSelected(){
                                    var cod = document.getElementById("sltEspecie").value;
                                    var id = <?= json_encode($codigo) ?>;
                                    $.post('obtener_Raza.php', { iCodEspecie: cod, id: id }, function(data){
                                                $('#sltRaza').html(data);
                                                });
                                        }
                                </script>

                                <script>
                                    function soloLetras(e){
                                        key = e.keyCode || e.which;
                                        tecla = String.fromCharCode(key).toLowerCase();
                                        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                                        especiales = "8-37-39-46";

                                        tecla_especial = false
                                        for(var i in especiales){
                                            if(key == especiales[i]){
                                                tecla_especial = true;
                                            break;
                                            }
                                        }
                                        if(letras.indexOf(tecla)==-1 && !tecla_especial){
                                            return false;
                                        }
                                    }
                                </script>

                                <!--<script type="text/javascript">
                                function validaNumericos(event) {
                                    if(event.charCode >= 48 && event.charCode <= 57){
                                        return true;
                                        }
                                    return false;        
                                }
                                </script>-->

                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="sltRaza" class="required" id="lblRaza">Raza</label>
                                    <!-:-->
                                    <select id="sltRaza" placeholder="Selecciona Raza" name="codigoRaza">
                                    <option id="optRaza" value="0">SELECCIONA RAZA</option>   
                                    </select>
                                </div>

                                <div class="form-input">
                                    <!--:->
                                    <label for="sltColor" class="required" id="lblColor">Color</label>
                                    <!-:-->
                                    <select id="sltColor" name="iCodColor" required="true"> 
                                    <option value="0">COLOR</option>
                                        <?php
                                          $consulta = "SELECT * FROM CatColor ORDER BY vchColor ASC";
                                          $result = mysqli_query($conn,$consulta);
                                          while ($color = mysqli_fetch_array($result)) {
                                            ?>
                                         <option id="optColor" value="<?php echo $color['iCodColor'];?>"><?php echo $color['vchColor']; ?></option>;
                                         <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                    <div class="form-input">
                                    <label for="radioGenero" class="required" id="lblGenero">Macho</label>

                                    <!--Radio original->
                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="tipoServicio" id="radioGenero">
                                    <!-Radio original-->

                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sexo" value="MACHO" id="radio-one" class="form-radio" checked><label for="radio-one"></label>



                                    <label for="radioGenero" class="required" id="lblGenero" value="HEMBRA">Hembra</label>

                                    <!--Radio original->
                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="tipoServicio" id="radioGenero">
                                    <!-Radio original-->

                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sexo" value="HEMBRA" id="radio-one" class="form-radio"><label for="radio-one"></label>
                                  </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputMeses" class="required" id="lblMeses">Meses</label>
                                    <!-:-->
                                    <input type="text" name="tipoServicio" id="inputMeses" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="MESES">
                                    <!--:->
                                    <label for="inputAnios" class="required" id="lblAnios">Años</label>  
                                    <!-:-->
                                    <input type="text" name="tipoServicio" id="inputAnios" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="AÑOS">        
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputFechaNac" class="required" id="lblFNac">Fecha Nac</label>
                                    <!-:-->
                                    <input type="date" name="fechaNac" id="inputFechaNac" />
                                </div>

                                <div class="form-input">
                                    <!--:->
                                    <label for="inputChip" class="required" id="lblChip">Chip</label>
                                    <!-:-->
                                    <input type="text" name="chip" id="inputChip" placeholder="Chip" />
                                </div>

                                <div class="form-input">
                                    <!--:->
                                    <label for="inputExpediente" class="required" id="lblExp">No. Expediente</label>
                                    <!-:-->
                                    <input type="text" name="expediente" id="inputExpediente" placeholder="NO. EXPEDIENTE" />
                                </div>

                                <div class="form-input">
                                    <!--:->
                                    <label for="company" class="required" id="lblObs">Observaciones</label>
                                    <!-:-->
                                    <textarea id="txtObservaciones" name="observaciones" placeholder="Observaciones"></textarea> 
                                </div>
                                <div class="form-input">
                                    <label for="email" class="required" id="lblEsteril">Esterilizado</label>
                                    <!--:->
                                    <input type="checkbox" id="chkEsteril" name="email" id="email" />
                                    <!-:-->
                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="castrado" class="form-checkbox" id="check-one"><label for="check-one"></label>
                                </div>
                            </div>
                            <div class="form-propietario">
                              <span class="title-propietario"> Propietario </span>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputNombreP" class="required" id="lblProp">Nombre</label>
                                    <!-:-->
                                    <input type="text" onkeypress="return soloLetras(event)" name="nombreProp" id="inputNombreP" placeholder="Nombre" required/>
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputPaterno" class="required" id="lblPaternoP">A. Paterno</label>
                                    <!-:-->
                                    <input type="text" onkeypress="return soloLetras(event)" name="paternoProp" id="inputPaterno" placeholder="A. Paterno" required/>
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputMaterno" class="required" id="lblMaternoP">A. Materno</label>
                                    <!-:-->
                                    <input type="text" name="maternoProp" id="inputMaterno" placeholder="A. Materno"/>
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputTelefono" class="required" id="lblTel">Teléfono</label>
                                    <!-:-->
                                    <input type="text" name="telefonoProp" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="inputTelefono" placeholder="Teléfono" required/>
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputTelefono" class="required" id="lblTel">Teléfono</label>
                                    <!-:-->
                                    <input type="text" name="telefonoDos" id="inputTelefonoDos" placeholder="Otro teléfono" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputCorreo" class="required" id="lblCorreo">Correo</label>
                                    <!-:-->
                                    <input type="text" name="correoProp" id="inputCorreo" placeholder="Correo"/>
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputDireccion" class="required" id="lblDireccion">Dirección</label>
                                    <!-:-->
                                    <input type="text" name="direccionProp" id="inputDireccion" placeholder="Dirección" />
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputColonia" class="required" id="lblColonia">Colonia</label>
                                    <!-:-->
                                    <input type="text" name="coloniaProp" id="inputColonia" placeholder="Colonia" />
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputCP" class="required" id="lblCP">Código Postal</label>
                                    <!-:-->
                                    <input type="text" name="cpProp" id="inputCP" placeholder="Código Postal" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                                  </div>
                                <!--<div class="form-input">
                                 <select id="inputIdioma" disabled="true" => 
                                    <option value="">Enviar citas en</option>
                                    <option value="1">Español</option>
                                    <option value="2">Inglés</option>
                                  </select>
                                </div>-->
                                <!--Btn con input-->
                                   <input type="submit" value="Agregar" class="btnAlta" id="btnAltaPac" name="" onclick="return validar();"/>
                                <!--Btn con input-->

                                <!--Btn con icono->
                                <button class="btnAlta" type="submit"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Agregar</button>   
                                <!-Btn con icono-->

                            </div>
                    </div>
                    </form>
                </div>
      
    </body>
</html>