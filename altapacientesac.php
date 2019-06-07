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
                <p id="lblCita"> Alta Paciente </p>
            </div>
              <div class="form-row">
                            <div class="form-paciente">
                              <span class="title-paciente"> Paciente </span>

                                <div class="form-input">
                                    <label for="nombrePaciente" id="lblNombre" class="required">Nombre</label>
                                    <input type="text" name="nombre" id="nombrePaciente" />
                                </div>
                                <div class="form-input">
                                    <label class="required" id="lblEspecie">Especie</label>
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
                                    <label for="sltRaza" class="required" id="lblRaza">Raza</label>
                                    <select id="sltRaza"> Selecciona Raza </select>
                                </div>

                                <div class="form-input">
                                    <label for="sltColor" class="required" id="lblColor">Color</label>
                                    <select id="sltColor"> 
                                    <option value=0></option>
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
                                    <input type="radio" name="tipoServicio" id="radioGenero">
                                    <label for="radioGenero" class="required" id="lblGenero">Hembra</label>
                                    <input type="radio" name="tipoServicio" id="radioGenero">
                                  </div>
                                <div class="form-input">
                                    <label for="inputMeses" class="required" id="lblMeses">Meses</label>
                                    <input type="text" name="tipoServicio" id="inputMeses">
                                    <label for="inputAnios" class="required" id="lblAnios">Años</label>  
                                    <input type="text" name="tipoServicio" id="inputAnios">        
                                </div>
                                <div class="form-input">
                                    <label for="inputFechaNac" class="required" id="lblFNac">Fecha Nac</label>
                                    <input type="date" name="last_name" id="inputFechaNac" />
                                </div>

                                <div class="form-input">
                                    <label for="inputChip" class="required" id="lblChip">Chip</label>
                                    <input type="text" name="company" id="inputChip" />
                                </div>

                                <div class="form-input">
                                    <label for="inputExpediente" class="required" id="lblExp">No. Expediente</label>
                                    <input type="text" name="company" id="inputExpediente" />
                                </div>

                                <div class="form-input">
                                    <label for="company" class="required" id="lblObs">Observaciones</label>
                                    <textarea id="txtObservaciones"> </textarea> 
                                </div>
                                <div class="form-input">
                                    <label for="email" class="required" id="lblEsteril">Esterilizado</label>
                                    <input type="checkbox" id="chkEsteril" name="email" id="email" />
                                </div>
                            </div>
                            <div class="form-propietario">
                              <span class="title-propietario"> Propietario </span>
                                <div class="form-input">
                                    <label for="inputNombreP" class="required" id="lblProp">Nombre</label>
                                    <input type="text" name="company" id="inputNombreP" />
                                </div>
                                <div class="form-input">
                                    <label for="inputPaterno" class="required" id="lblPaternoP">A. Paterno</label>
                                    <input type="text" name="company" id="inputPaterno" />
                                </div>
                                <div class="form-input">
                                    <label for="inputMaterno" class="required" id="lblMaternoP">A. Materno</label>
                                    <input type="text" name="company" id="inputMaterno" />
                                </div>
                                <div class="form-input">
                                    <label for="inputTelefono" class="required" id="lblTel">Teléfono</label>
                                    <input type="text" name="company" id="inputTelefono" />
                                </div>
                                <div class="form-input">
                                    <label for="inputCorreo" class="required" id="lblCorreo">Correo</label>
                                    <input type="text" name="company" id="inputCorreo" />
                                </div>
                                <div class="form-input">
                                    <label for="inputDireccion" class="required" id="lblDireccion">Dirección</label>
                                    <input type="text" name="company" id="inputDireccion" />
                                </div>
                                <div class="form-input">
                                    <label for="inputColonia" class="required" id="lblColonia">Colonia</label>
                                    <input type="text" name="company" id="inputColonia" />
                                </div>
                                <div class="form-input">
                                    <label for="inputCP" class="required" id="lblCP">Código Postal</label>
                                    <input type="text" name="company" id="inputCP" />
                                  </div>
                                <div class="form-input">
                                 <select id="inputIdioma"> 
                                    <option value="">Enviar citas en</option>
                                    <option value="1">Español</option>
                                    <option value="2">Inglés</option>
                                  </select>
                                </div>
                                   <input type="submit" value="Agregar" class="btnAlta" id="submit" name="" />
                            </div>
                    </div>
                    </form>
                </div>
      

    </body>
</html>