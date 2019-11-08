<?php
if (isset($output))
{
    foreach ($output->css_files as $file):
        ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php
    endforeach;
    ?>

    <?php
    foreach ($output->js_files as $file):
        ?>
        <script src="<?php echo $file; ?>"></script>
        <?php
    endforeach;
}
?>

<div class="card-content">
    <div class="panel panel-default">
        <h2 class="page-head-line "><?php echo (isset($title)) ? $title : "Agregar curso"; ?></h2>

        <div style="overflow:auto;" class="table">
            <!-- table-container-fluid panel -->
            <?php
            if (isset($output))
            {
                echo $output->output;
            }
            ?>
        </div>
    </div>
</div>
