<div class="col-sm-12">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr class="info">
                    <th class="text-center">Folio</th>
                    <th class="text-center">Fecha de inicio</th>
                    <th class="text-center">Fecha de término</th>
                    <th class="text-center">Apellido paterno</th>
                    <th class="text-center">Apellido materno</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Especialidad</th>
                    <th class="text-center">Unidad</th>
                    <th class="text-center">Delegación</th>
                    <th class="text-center">Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($datos) AND !empty($datos)){
                    foreach ($datos as $key => $dato) {
                        echo '<tr>
                            <td>'.$dato['res_folio'].'</td>
                            <td>'.$dato['res_fecha_inicio'].'</td>
                            <td>'.$dato['res_fecha_termino'].'</td>
                            <td>'.$dato['res_apellido_paterno'].'</td>
                            <td>'.$dato['res_apellido_materno'].'</td>
                            <td>'.$dato['res_nombre'].'</td>
                            <td>'.$dato['res_especialidad'].'</td>
                            <td>'.$dato['res_unidad'].'</td>
                            <td>'.$dato['res_delegacion'].'</td>
                            <td>'.$dato['res_categoria'].'</td>
                        </tr>';
                    }                
                } else {
                    echo '<tr>
                        <td colspan="11">No existen registros con los datos introducidos.</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
