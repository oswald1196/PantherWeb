<?php
    $codigo = base64_decode($_GET['id']);
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

        <div class="principal">
            <form method="POST" class="form-alta" id="register-form">
              
            <div class="title">
                <p id="lblCita" style="color: white;"> Alta Paciente </p>
            </div>
              <div class="form-row">
                            <div class="form-paciente">
                              <span class="title-paciente"> Paciente </span>

                                <div class="form-input">
                                    <!--:->
                                    <label for="nombrePaciente" id="lblNombre" class="required">Nombre</label>
                                    <!-:-->
                                    <input type="text" name="nombre" id="nombrePaciente" placeholder="Nombre" />
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label class="required" id="lblEspecie">Especie</label>
                                    <!-:-->
                                    <select id="sltEspecie" name="sltEspecie" onchange="ShowSelected();"> 
                                    <option value="0">Seleccionar Especie</option>
                                        <?php
                                          $consulta = "SELECT iCodEspecie, vchEspecie FROM CatEspecies WHERE iCodEmpresa = '$codigo' ORDER BY vchEspecie ASC";
                                          $result = mysqli_query($conn,$consulta); 
                                        while($especies = $result->fetch_assoc()) { ?>
                                        <option value="<?php echo $especies['iCodEspecie']; ?>"> <?php echo $especies['vchEspecie']; ?> </option>
                                        <?php } ?>
                                    </select>
                                <script type="text/javascript">
                                    function ShowSelected(){
                                    var cod = document.getElementById("sltEspecie").value;
                                    var id = <?= json_encode($codigo) ?>;
                                    $.post('obtener_Raza.php', { iCodEspecie: cod, id: id }, function(data){
                                                $('#sltRaza').html(data);
                                                });
                                        }
                                </script>

                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="sltRaza" class="required" id="lblRaza">Raza</label>
                                    <!-:-->
                                    <select id="sltRaza" placeholder="Selecciona Raza">
                                    <option value="0">SELECCIONA RAZA</option>   
                                    </select>
                                </div>

                                <div class="form-input">
                                    <!--:->
                                    <label for="sltColor" class="required" id="lblColor">Color</label>
                                    <!-:-->
                                    <select id="sltColor"> 
                                    <option value=0>Color</option>
                                        <?php
                                          $consulta = "SELECT * FROM CatColor ORDER BY vchColor ASC";
                                          $result = mysqli_query($conn,$consulta);
                                          while ($color = mysqli_fetch_array($result)) {
                                          echo '<option>'.$color['vchColor'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                    <div class="form-input">
                                    <label for="radioGenero" class="required" id="lblGenero">Macho</label>

                                    <!--Radio original->
                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="tipoServicio" id="radioGenero">
                                    <!-Radio original-->

                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="demo" value="one" id="radio-one" class="form-radio" checked><label for="radio-one"></label>



                                    <label for="radioGenero" class="required" id="lblGenero">Hembra</label>

                                    <!--Radio original->
                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="tipoServicio" id="radioGenero">
                                    <!-Radio original-->

                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="demo" value="one" id="radio-one" class="form-radio" checked><label for="radio-one"></label>
                                  </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputMeses" class="required" id="lblMeses">Meses</label>
                                    <!-:-->
                                    <input type="text" name="tipoServicio" id="inputMeses" placeholder="Meses">
                                    <!--:->
                                    <label for="inputAnios" class="required" id="lblAnios">Años</label>  
                                    <!-:-->
                                    <input type="text" name="tipoServicio" id="inputAnios" placeholder="Años">        
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputFechaNac" class="required" id="lblFNac">Fecha Nac</label>
                                    <!-:-->
                                    <input type="date" name="last_name" id="inputFechaNac" />
                                </div>

                                <div class="form-input">
                                    <!--:->
                                    <label for="inputChip" class="required" id="lblChip">Chip</label>
                                    <!-:-->
                                    <input type="text" name="company" id="inputChip" placeholder="Chip" />
                                </div>

                                <div class="form-input">
                                    <!--:->
                                    <label for="inputExpediente" class="required" id="lblExp">No. Expediente</label>
                                    <!-:-->
                                    <input type="text" name="company" id="inputExpediente" placeholder="No. Expediente" />
                                </div>

                                <div class="form-input">
                                    <!--:->
                                    <label for="company" class="required" id="lblObs">Observaciones</label>
                                    <!-:-->
                                    <textarea id="txtObservaciones" placeholder="Observaciones"></textarea> 
                                </div>
                                <div class="form-input">
                                    <label for="email" class="required" id="lblEsteril">Esterilizado</label>
                                    <!--:->
                                    <input type="checkbox" id="chkEsteril" name="email" id="email" />
                                    <!-:-->
                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="form-checkbox" id="check-one" checked><label for="check-one"></label>
                                </div>
                            </div>
                            <div class="form-propietario">
                              <span class="title-propietario"> Propietario </span>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputNombreP" class="required" id="lblProp">Nombre</label>
                                    <!-:-->
                                    <input type="text" name="company" id="inputNombreP" placeholder="Nombre" />
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputPaterno" class="required" id="lblPaternoP">A. Paterno</label>
                                    <!-:-->
                                    <input type="text" name="company" id="inputPaterno" placeholder="A. Paterno" />
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputMaterno" class="required" id="lblMaternoP">A. Materno</label>
                                    <!-:-->
                                    <input type="text" name="company" id="inputMaterno" placeholder="A. Materno" />
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputTelefono" class="required" id="lblTel">Teléfono</label>
                                    <!-:-->
                                    <input type="text" name="company" id="inputTelefono" placeholder="Teléfono" />
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputCorreo" class="required" id="lblCorreo">Correo</label>
                                    <!-:-->
                                    <input type="text" name="company" id="inputCorreo" placeholder="Correo" />
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputDireccion" class="required" id="lblDireccion">Dirección</label>
                                    <!-:-->
                                    <input type="text" name="company" id="inputDireccion" placeholder="Dirección" />
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputColonia" class="required" id="lblColonia">Colonia</label>
                                    <!-:-->
                                    <input type="text" name="company" id="inputColonia" placeholder="Colonia" />
                                </div>
                                <div class="form-input">
                                    <!--:->
                                    <label for="inputCP" class="required" id="lblCP">Código Postal</label>
                                    <!-:-->
                                    <input type="text" name="company" id="inputCP" placeholder="Código Postal" />
                                  </div>
                                <div class="form-input">
                                 <select id="inputIdioma"> 
                                    <option value="">Enviar citas en</option>
                                    <option value="1">Español</option>
                                    <option value="2">Inglés</option>
                                  </select>
                                </div>
                                <!--Btn con input-->
                                   <input type="submit" value="Agregar" class="btnAlta" id="submit" name="" />
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