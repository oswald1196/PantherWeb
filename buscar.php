<?php
    $palabra=$_GET['search'];
    $codigo=$_GET['id'];

    $query="SELECT iCodPaciente, vchRaza, vchNombrePaciente, dtFecNacimiento, vchNombre, vchPaterno, vchMaterno, vchCorreo, vchTelefono FROM TranAfiliado WHERE vchNombrePaciente LIKE '%$palabra%' AND iCodEmpresa = 106";
    $consulta=$conn->query($query);
    if($consulta->num_rows>=1){
        ?>
        <script type="text/javascript">
            $(function(){
                $('#alerta tr>*').click(function(e){
                    var a = $(this).closest('tr').find('a')
                    e.preventDefault()
                    location.href = a.attr('href')
                })
            })
        </script>
    <div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100">
                    <table id="alerta">
                    <tbody>

                    <thead>
                        <tr class="table100-head">
                            <th>Raza</th>
                            <th>Nombre Paciente</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Propietario</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
            <?php
                while($fila=$consulta->fetch_array(MYSQLI_ASSOC)){
                        $iCodPac = $fila['iCodPaciente'];

            ?>
                <tr class="table100-head" >
                    <td class="column1"> <?php echo $fila['vchRaza'] ?> <a href="menu_pacientes.php?id=<?php echo $iCodPac; ?> "> </a> </td>
                    <td class="column2"> <?php echo $fila['vchNombrePaciente'] ?> </td>
                    <td class="column3"> <?php echo $fila['dtFecNacimiento'] ?> </td>
                    <td class="column4"> <?php echo $fila['vchNombre']." ".$fila['vchPaterno']." ".$fila['vchMaterno'] ?></td>
                    <td class="column5"> <?php echo $fila['vchTelefono'] ?> </td>
                    <td class="column6"> <?php echo $fila['vchCorreo'] ?> </td>
                </tr>


            <?php
            }
            ?>
            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    }

        else{
            echo '<script> swal("No hemos encontrado ningun registro con la palabra ". $palabra </script> )';
       }
       ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

            