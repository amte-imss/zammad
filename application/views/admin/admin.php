<div class="container body">

    <!--incia menu-->
    <?php
    echo $menu;
    ?>
    <!--termina  menu-->

    <!-- ficha usuario -->
    <?php
    echo $ficha_usuario
    ?>
    <!-- /ficha usuario -->


    <!-- page content -->
    <div class="right_col" role="main">
        <?php
        if (isset($contenido))
        {
            echo $contenido;
        }
        ?>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer ng-show="$root.usuario.acceso">
        <div class="pull-right">
            Tablero de reportes CES
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
</div>
</div>
<?php
    if(isset($modal))
    {
        echo $modal;
    }
?>