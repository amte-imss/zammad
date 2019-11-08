<?php
/**
 * @author Christian Garcia
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('render_modulo'))
{

    function render_modulo($modulos = [], $padre = null)
    {
        $html = '';
        $id_tmp_mod = 0;
        ob_start();
        ?>
        <ul class="<?php echo ($padre != null ? 'collapse' : ''); ?>" <?php echo ($padre != null ? 'id="' . $padre . '" style="margin-left: 20px;"' : ''); ?>>
            <?php
            foreach ($modulos as $row)
            {
                ?>
                <li class="<?php echo (isset($row['childs']) ? '' : '') ?>" style="list-style-type: none;">
                    <div class="panel panel-success">
                        <!-- <div class="panel-heading">
                           <h3 class="panel-title">Módulo</h3>
                        </div> -->
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <a style="text-decoration: underline;cursor: pointer;" onclick="get_info_modulo('<?php echo $row['id_modulo']; ?>')" data-toggle="modal" data-target="#my_modal"><?php echo $row['nombre']; ?></a>
                                </div>
                                <div class="col-md-4">
                                    <label for="">URL:  <?php echo $row['url']; ?></label>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tipo: <?php echo $row['configurador']; ?></label>
                                </div>
                                <br><br>

                                <div class="col-md-12">
                                    <button class="col-md-4 btn btn-tpl" data-toggle="modal" data-target="#my_modal" onclick="get_niveles_atencion('<?php echo $row['id_modulo']; ?>')" href="#<?php echo $id_tmp_mod; ?>">Administrar niveles de acceso
                                    </button>
                                </div>
                                <br>

                        <div class="col-md-12">
                          <br>
                          <button class="btn btn-tpl col-md-4" data-toggle="modal" data-target="#my_modal" onclick="get_usuarios('<?php echo $row['id_modulo']; ?>')" href="#">Administrar usuarios
                          </button>
                        </div>
                        <br>

                                <?php
                                if (isset($row['childs']))
                                {
                                    ?>
                                    <p data-toggle="collapse" data-target="#modulo<?php echo $row['id_modulo']; ?>"><a style="cursor:pointer;text-decoration: underline;" href="#<?php echo $id_tmp_mod; ?>">Ver más</a></p>
                                    <?php
                                    //pr($item['childs']);
                                    echo render_modulo($row['childs'], 'modulo' . $row['id_modulo']);
                                    ?>

                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>

                </li>
                <hr>
                <?php
                $id_tmp_mod++;
            }
            ?>
        </ul>
        <?php
        $html = ob_get_contents();
        ob_get_clean();
        return $html;
    }

}

if (!function_exists('render_modulos_grupo'))
{

    function render_modulos_grupo($CI = null, $modulos = [], $padre = null)
    {
        $html = '';
        ob_start();
        ?>
        <ul class="<?php echo ($padre != null ? 'collapse' : ''); ?>" <?php echo ($padre != null ? 'id="' . $padre . '" style="margin-left: 20px;"' : ''); ?>>
            <?php
            foreach ($modulos as $row)
            {
                ?>
                <li class="<?php echo (isset($row['childs']) ? '' : '') ?>" style="list-style-type: none;">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <?php echo $row['nombre']; ?><br><span style="text-decoration: underline; font-style: italic;"><?php echo $row['url']; ?></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <?php
                                echo $CI->form_complete->create_element(
                                        array('id' => 'activo' . $row['id_modulo'],
                                            'type' => 'checkbox',
                                            'attributes' => array('name' => 'activo' . $row['id_modulo'],
                                                'class' => 'form-control  form-control input-sm',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'top',
                                                'title' => 'activo',
                                                'checked' => (empty($row['id_rol']) ? false : true))
                                        )
                                );
                                ?>

                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($row['childs']))
                    {
                        ?>
                        <p data-toggle="collapse" data-target="#modulo<?php echo $row['id_modulo']; ?>"><a href="#" style="cursor:pointer;text-decoration: underline;">Ver más</a></p>
                        <?php
                        //pr($item['childs']);
                        echo render_modulos_grupo($CI, $row['childs'], 'modulo' . $row['id_modulo']);
                        ?>

                        <?php
                    }
                    ?>
                </li>
                <hr>
            <?php } ?>
        </ul>
        <?php
        $html = ob_get_contents();
        ob_get_clean();
        return $html;
    }

}
