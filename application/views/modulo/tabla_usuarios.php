<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Matrícula</th>
            <th>Tipo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($usuarios['tabla'] as $row) {
            ?>
            <tr>
                <td><?php echo $row['matricula']; ?></td>
                <td><?php echo $row['add_sub']?'Permiso activo':'Permiso desactivado'; ?></td>
                <td><a onclick="quitar_usuario(<?php echo $row['id_usuario']; ?>)">Borrar</a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
