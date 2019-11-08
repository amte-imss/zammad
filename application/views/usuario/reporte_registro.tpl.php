<table>
    <thead>
    <th>Matrícula</th>
    <th>Delegación</th>
    <th>Grupo</th>
    <th>Email</th>
    <th>Password</th>
    <th>Errores presentados</th>
</thead>
<tbody>
    <?php foreach ($data as $row)
    { ?>
        <tr>
            <td><?php echo $row['matricula']; ?></td>
            <td><?php echo $row['delegacion']; ?></td>
            <td><?php echo $row['nivel_acceso']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo isset($row['nueva password']) ? $row['nueva password'] : ''; ?></td>
            <td><?php echo isset($row['errores']) ? $row['errores'] : ''; ?></td>
        </tr>
        <?php
    }
    ?>
</tbody>
</table>
