<?php
    include('conexion.php');

    $salida = "";

    $codigo = json_decode($_POST['id']);

    $query = "SELECT * FROM TranAfiliado WHERE iCodEmpresa = 5";

    if(isset($_POST['consulta'])){
    $q = mysqli_real_escape_string($conn,$_POST['consulta']);
    $query = "SELECT iCodEmpresa,iCodPaciente, vchRaza, vchNombrePaciente, dtFecNacimiento, vchNombre, vchPaterno, vchMaterno, vchCorreoPaciente, vchTelefono FROM TranAfiliado WHERE (vchRaza LIKE '%$q%' OR vchNombrePaciente LIKE '%$q%' OR dtFecNacimiento LIKE '%$q%' OR vchNombre LIKE '%$q%' OR vchPaterno LIKE '%$q%' OR vchCorreoPaciente LIKE '%$q%') AND iCodEmpresa = 5";
        }
    $resultado = mysqli_query($conn,$query);

    if($resultado->num_rows >= 1) {
        ?>
        <script type='text/javascript'>
            $(function(){
                $('#alerta tr>*').click(function(e){
                    var a = $(this).closest('tr').find('a')
                    e.preventDefault()
                    location.href = a.attr('href')
                })
            })
        </script>
        <?php
        $salida.="<div class='limiter'>
        <div class='container-table100'>
            <div class='wrap-table100'>
                <div class='table100'>
                    <table id='alerta'>
                    <tbody>

                    <thead>
                        <tr class='table100-head'>
                            <th>Raza</th>
                            <th>Nombre Paciente</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Propietario</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                        </tr>
                    </thead>";

                while($fila = mysqli_fetch_array($resultado)){
                        $iCodPac = $fila['iCodPaciente'];
                        $iCodE = $fila['iCodEmpresa'];
                $salida.="<tr class='table100-head' >
                    <td class='column1'>".$fila['vchRaza']."<a href='menu_pacientes.php?id=$iCodE&codigo=$iCodPac;'</a> </td>
                    <td class='column2'>".$fila['vchNombrePaciente']."</td>
                    <td class='column3'>".$fila['dtFecNacimiento']."</td>
                    <td class='column4'>".$fila['vchNombre']." ".$fila['vchPaterno']." ".$fila['vchMaterno']."</td>
                    <td class='column5'>".$fila['vchTelefono']." </td>
                    <td class='column6'>".$fila['vchCorreoPaciente']." </td>
                </tr>";
            }

                $salida.="</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>";
}
        else{
                $salida.="No hemos encontrado ningun registro";
       }
       echo $salida;
    
    ?>


            