<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config = array(
    'comprobante_actividad' => array(
        array(
            'field' => 'comprobante',
            'label' => 'cargar comprobante',
            'rules' => 'required'
        ),
        array(
            'field' => 'folio_comprobante',
            'label' => 'folio del comprobante',
            'rules' => ''
        ),
    ),
    'datos_siap' => array(
        array(
            'field' => 'clave_delegacional',
            'label' => 'clave delegacional',
            'rules' => 'required'
        ),
    ),
    'datos_generales' => array(
        array(
            'field' => 'apellido_p',
            'label' => 'apellido paterno',
            'rules' => 'required|alpha_accent_space_dot_quot'
        ),
        array(
            'field' => 'apellido_m',
            'label' => 'apellido materno',
            'rules' => 'required|alpha_accent_space_dot_quot'
        ),
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'required|alpha_accent_space_dot_quot'
        ),
        array(
            'field' => 'email',
            'label' => 'correo electrónico',
            'rules' => 'required'
        ),
        array(
            'field' => 'telefono_particular',
            'label' => 'teléfono',
            'rules' => 'numeric'
        ),
        array(
            'field' => 'telefono_laboral',
            'label' => 'teléfono',
            'rules' => 'numeric'
        ),
    ),
);

$config['form_status_actividad_usuario'] = array(
    array(
        'field' => 'status_actividad',
        'label' => 'Actividad del usuario',
        'rules' => 'required|integer'
    )
);

$config["login"] = array(
    array(
        'field' => 'usuario',
        'label' => 'Matrícula o correo electrónico',
        'rules' => 'required',
    /* 'errors' => array(
      'required' => 'El campo %s es obligatorio, favor de ingresarlo.',
      ), */
    ),
    array(
        'field' => 'password',
        'label' => 'Contraseña',
        'rules' => 'required',
    /* 'errors' => array(
      'required' => 'El campo %s es obligatorio, favor de ingresarlo.',
      ), */
    ),
    array(
        'field' => 'captcha',
        'label' => 'Código de verificación',
        'rules' => 'required|check_captcha',
    /* 'errors' => array(
      'required' => 'El campo %s es obligatorio, favor de ingresarlo.',
      'check_captcha' => "El texto no coincide con la imagen, favor de verificarlo."
      ), */
    ),
);
$config['form_user_update_password'] = array(
    array(
        'field' => 'pass',
        'label' => 'Contraseña',
        'rules' => 'trim|required|min_length[8]'
    ),
    array(
        'field' => 'pass_confirm',
        'label' => 'Confirmar contraseña',
        'rules' => 'trim|required|matches[pass]' //|callback_valid_pass
    ),
);
$config['form_niveles_acceso_usuario'] = array(
    array(
        'field' => 'niveles',
        'label' => 'niveles',
        'rules' => 'required'
    )
);

$config["consulta_folio"] = array(
    array(
        'field' => 'folio',
        'label' => 'Folio',
        'rules' => 'required|alpha_dash|min_length[22]|max_length[30]',
    ),
    array(
        'field' => 'captcha',
        'label' => 'Código de verificación',
        'rules' => 'required|check_captcha',
    ),
);
$config["consulta_curp"] = array(
    array(
        'field' => 'curp',
        'label' => 'CURP',
        'rules' => 'required|alpha_numeric|exact_length[18]',
    ),
    array(
        'field' => 'captcha',
        'label' => 'Código de verificación',
        'rules' => 'required|check_captcha',
    ),
);
$config["consulta_nombre"] = array(
    array(
        'field' => 'apellido_paterno',
        'label' => 'Apellido paterno',
        'rules' => 'required|alpha_nombre_nomina|min_length[2]|max_length[50]'
        //'rules' => 'required|alpha_accent_space_dot_quot'
    ),
    array(
        'field' => 'apellido_materno',
        'label' => 'Apellido materno',
        'rules' => 'alpha_nombre_nomina|min_length[2]|max_length[50]'
    ),
    array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'required|alpha_nombre_nomina|min_length[2]|max_length[50]'
    ),
    array(
        'field' => 'captcha',
        'label' => 'Código de verificación',
        'rules' => 'required|check_captcha',
    ),
);

$config["form_helpdesk"] = array(
    array(
        'field' => 'matricula',
        'label' => 'Matrícula',
        'rules' => 'required|trim|min_length[6]|max_length[10]',
    ),
    array(
        'field' => 'delegacion',
        'label' => 'Delegación',
        'rules' => 'required',
    ),
    array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'required|trim|min_length[2]|max_length[100]',
    ),
    array(
        'field' => 'apellido_paterno',
        'label' => 'Apellido paterno',
        'rules' => 'required|trim|min_length[2]|max_length[100]',
    ),
    array(
        'field' => 'apellido_materno',
        'label' => 'Apellido materno',
        'rules' => 'required|trim|min_length[2]|max_length[100]',
    ),
    array(
        'field' => 'correo',
        'label' => 'Correo electrónico',
        'rules' => 'required|trim|valid_email|max_length[255]',
    ),
    array(
        'field' => 'division',
        'label' => 'División',
        'rules' => 'required',
    ),
    array(
        'field' => 'area',
        'label' => 'Área',
        'rules' => 'required|trim|min_length[3]|max_length[255]',
    ),
    array(
        'field' => 'telefono',
        'label' => 'Teléfono',
        'rules' => 'required|trim|min_length[8]|max_length[30]',
    ),
    array(
        'field' => 'tipo_asistencia',
        'label' => 'Tipo',
        'rules' => 'required',
    ),
    array(
        'field' => 'descripcion',
        'label' => 'Descripción',
        'rules' => 'required|trim|min_length[10]|max_length[800]',
    ),
    /*array(
        'field' => 'captcha',
        'label' => 'Código de verificación',
        'rules' => 'required|check_captcha',
    ),*/
);

$config["form_registro_investigacion"] = array(
    array(
        'field' => 'titulo_trabajo',
        'label' => 'Titulo',
        'rules' => 'required'
    ),
    array(
        'field' => 'tipo_metodologia',
        'label' => 'Tipo de metodología',
        'rules' => 'required'
    ),
    array(
        'field' => 'metodologia',
        'label' => 'Metodología',
        'rules' => 'required'
    ),
    array(
        'field' => 'antecedentes',
        'label' => 'Antecedentes',
        'rules' => 'required'
    ),
    array(
        'field' => 'problema',
        'label' => 'Problema',
        'rules' => 'required'
    ),
    array(
        'field' => 'justificacion',
        'label' => 'Justificación',
        'rules' => 'required'
    ),
    array(
        'field' => 'pregunta_investigacion',
        'label' => 'Pregunta de investigación',
        'rules' => 'required'
    ),
    array(
        'field' => 'objetivo',
        'label' => 'Objetivo',
        'rules' => 'required'
    ),
    /*
      array(
      'field' => 'hipotesis',
      'label' => 'Hipotesis',
      'rules' => 'required'
      ),
     */
    array(
        'field' => 'resultados',
        'label' => 'Resultados',
        'rules' => 'required'
    ),
    array(
        'field' => 'conclusiones',
        'label' => 'Conclusiones',
        'rules' => 'required'
    ),
    array(
        'field' => 'consideraciones_eticas',
        'label' => 'Consideraciones éticas',
        'rules' => 'required'
    ),
    array(
        'field' => 'autor_nombre',
        'label' => 'Nombre de coautores',
        'rules' => 'trim|alpha_accent_space_dot_quot'
    )
);


$config['form_registro_siap'] = array(
    array(
        'field' => 'matricula',
        'label' => 'Matrícula',
        'rules' => 'required|max_length[18]|alpha_dash'
    ),
    array(
        'field' => 'delegacion',
        'label' => 'Delegación',
        'rules' => 'required' //|callback_valid_pass
    ),
    array(
        'field' => 'email',
        'label' => 'Correo electrónico',
        'rules' => 'trim|required|valida_correo_electronico' //|callback_valid_pass
    ),
    array(
        'field' => 'password',
        'label' => 'Contraseña',
        'rules' => 'required' //|callback_valid_pass
    ),
    array(
        'field' => 'repass',
        'label' => 'Confirmación contraseña',
        'rules' => 'required|matches[password]'
    ),
    array(
        'field' => 'grupo',
        'label' => 'Niveles de Atencion',
        'rules' => 'required'
    )
);

$config['form_registro_no_siap'] = array(
    array(
        'field' => 'matricula1',
        'label' => 'Matrícula',
        'rules' => 'required|max_length[18]|alpha_dash'
    ),
    array(
        'field' => 'clave_departamental1',
        'label' => 'Clave departamental',
        'rules' => 'required' //|callback_valid_pass
    ),
    array(
        'field' => 'categoria1',
        'label' => 'Clave categoría',
        'rules' => 'required' //|callback_valid_pass
    ),
    array(
        'field' => 'email1',
        'label' => 'Correo electrónico',
        'rules' => 'trim|required|valida_correo_electronico' //|callback_valid_pass
    ),
    array(
        'field' => 'password1',
        'label' => 'Contraseña',
        'rules' => 'required' //|callback_valid_pass
    ),
    array(
        'field' => 'repass1',
        'label' => 'Confirmación contraseña',
        'rules' => 'required|matches[password1]'
    ),
    array(
        'field' => 'grupo1',
        'label' => 'Niveles de Atencion',
        'rules' => 'required'
    )
);

$config['form_registro_no_imss'] = array(
    array(
        'field' => 'matricula2',
        'label' => 'Nombre de usuario',
        'rules' => 'required|max_length[18]|alpha_dash'
    ),
    array(
        'field' => 'email2',
        'label' => 'Correo electrónico',
        'rules' => 'trim|required|valida_correo_electronico' //|callback_valid_pass
    ),
    array(
        'field' => 'password2',
        'label' => 'Contraseña',
        'rules' => 'required' //|callback_valid_pass
    ),
    array(
        'field' => 'repass2',
        'label' => 'Confirmación contraseña',
        'rules' => 'required|matches[password2]'
    ),
    array(
        'field' => 'grupo2',
        'label' => 'Niveles de Atencion',
        'rules' => 'required'
    )
);



$config['form_registro_usuario'] = array(
    array(
        'field' => 'reg_usuario',
        'label' => 'Matrícula',
        'rules' => 'required|max_length[18]|alpha_dash'
    ),
    array(
        'field' => 'id_delegacion',
        'label' => 'Delegación',
        'rules' => 'required' //|callback_valid_pass
    ),
    array(
        'field' => 'reg_email',
        'label' => 'Correo electrónico',
        'rules' => 'trim|required|valida_correo_electronico' //|callback_valid_pass
    ),
    array(
        'field' => 'reg_password',
        'label' => 'Contraseña',
        'rules' => 'trim|required|min_length[8]' //|callback_valid_pass
    ),
    array(
        'field' => 'reg_repassword',
        'label' => 'Confirmación contraseña',
        'rules' => 'trim|required|matches[reg_password]'
    ),
    array(
        'field' => 'reg_captcha',
        'label' => 'Captcha',
        'rules' => 'required|check_captcha'
    )
);
$config['form_registro_usuario_internos'] = array(
    array(
        'field' => 'matricula',
        'label' => 'Matrícula',
//        'rules' => 'trim|required|max_length[18]|alpha_dash|is_unico_datos_usuarios[username]'
        'rules' => 'trim|required|max_length[18]|alpha_dash'
    ),
    array(
        'field' => 'cve_delegacion',
        'label' => 'Delegación',
        'rules' => 'required' //|callback_valid_pass
    ),
    array(
        'field' => 'ext_mail',
        'label' => 'Correo electrónico',
        'rules' => 'trim|required|valida_correo_electronico|is_unico_datos_usuarios[email]' //|callback_valid_pass
    ),
    array(
        'field' => 'reg_password',
        'label' => 'Contraseña',
        'rules' => 'trim|required|min_length[8]' //|callback_valid_pass
    ),
    array(
        'field' => 'reg_repassword',
        'label' => 'Confirmación contraseña',
        'rules' => 'trim|required|matches[reg_password]'
    ),
    array(
        'field' => 'reg_captcha',
        'label' => 'Captcha',
        'rules' => 'required|check_captcha'
    ),
    array(
        'field' => 'reg_captcha',
        'label' => 'Captcha',
        'rules' => 'required|check_captcha'
    ),
    array(
        'field' => 'telefono_oficina',
        'label' => '',
        'rules' => 'max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'telefono_personal',
        'label' => '',
        'rules' => 'required|max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'pais_origen',
        'label' => '',
        'rules' => 'required'
    )
);
$config['form_registro_usuario_externos'] = array(
    array(
        'field' => 'ext_nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max[100]|alpha_accent_space_dot_quot'
    ),
    array(
        'field' => 'ext_ap',
        'label' => '',
        'rules' => 'trim|required|max[100]|alpha_accent_space_dot_quot' //|callback_valid_pass
    ),
    array(
        'field' => 'ext_am',
        'label' => '',
        'rules' => 'trim|max[100]|alpha_accent_space_dot_quot' //|callback_valid_pass
    ),
    array(
        'field' => 'ext_mail',
        'label' => 'E-mail',
        'rules' => 'trim|required|valida_correo_electronico|is_unico_datos_usuarios[email]' //|callback_valid_pass
    ),
    array(
        'field' => 'ext_sexo',
        'label' => 'Sexo',
        'rules' => 'trim|required' //|callback_valid_pass
    ),
    array(
        'field' => 'reg_password',
        'label' => 'Contraseña',
        'rules' => 'trim|required|min_length[8]' //|callback_valid_pass
    ),
    array(
        'field' => 'reg_repassword',
        'label' => 'Confirmación contraseña',
        'rules' => 'trim|required|matches[reg_password]'
    ),
    array(
        'field' => 'reg_captcha',
        'label' => 'Captcha',
        'rules' => 'required|check_captcha'
    ),
    array(
        'field' => 'pais_institucion',
        'label' => '',
        'rules' => 'required'
    ),
    array(
        'field' => 'institucion',
        'label' => '',
        'rules' => 'required|max[100]'
    ),
    array(
        'field' => 'telefono_oficina',
        'label' => '',
        'rules' => 'max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'telefono_personal',
        'label' => '',
        'rules' => 'required|max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'pais_origen',
        'label' => '',
        'rules' => 'required'
    )
);
/*
$config['nueva_convocatoria_censo'] = array(
    array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'required|max_length[100]'
    ),
    array(
        'field' => 'clave',
        'label' => 'Clave',
        'rules' => 'required|max_length[15]'
    ),
    array(
        'field' => 'fecha_inicio_0',
        'label' => 'Fecha inicio de registro',
        'rules' => 'required'
    ),
    array(
        'field' => 'fecha_fin_0',
        'label' => 'Fecha fin registro',
        'rules' => 'required'
    ),
    array(
        'field' => 'unidades[]',
        'label' => 'Participantes',
        'rules' => 'required'
    )
);

$config['editar_convocatoria_censo'] = array(
    array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'required|max_length[100]'
    ),
    array(
        'field' => 'clave',
        'label' => 'Clave',
        'rules' => 'required|max_length[15]'
    ),
    array(
        'field' => 'fecha_inicio_0',
        'label' => 'Fecha inicio de registro',
        'rules' => 'required'
    ),
    array(
        'field' => 'fecha_fin_0',
        'label' => 'Fecha fin registro',
        'rules' => 'required'
    ),
    array(
        'field' => 'activo',
        'label' => 'Estado',
        'rules' => 'required'
    )
);
*/
$config['elemento_seccion'] = array(
    array(
        'field' => 'nombre',
        'label' => 'nombre',
        'rules' => 'required|not_space'
    ),
    array(
        'field' => 'id_seccion',
        'label' => 'id_seccion',
        'rules' => 'required'
    ),
    array(
        'field' => 'activo',
        'label' => 'activo',
        'rules' => 'required'
    ),
    array(
        'field' => 'label',
        'label' => 'label',
        'rules' => 'required'
    )
);

$config['campos_formulario'] = array(
    array(
        'field' => 'id_campo',
        'label' => 'Campo',
        'rules' => 'required'
    ),
    array(
        'field' => 'orden',
        'label' => 'orden',
        'rules' => 'required|integer'
    ),
    array(
        'field' => 'display',
        'label' => 'display',
        'rules' => 'required'
    ),
    array(
        'field' => 'activo',
        'label' => 'activo',
        'rules' => 'required'
    ),
    array(
        'field' => 'nueva_linea',
        'label' => 'Nueva línea',
        'rules' => 'required'
    )
);

$config['formulario'] = array(
    array(
        'field' => 'nombre',
        'label' => 'nombre',
        'rules' => 'required|not_space'
    ),
    array(
        'field' => 'label',
        'label' => 'etiqueta',
        'rules' => 'required'
    ),
    array(
        'field' => 'id_elemento_seccion',
        'label' => 'subsección',
        'rules' => 'required'
    ),
    array(
        'field' => 'activo',
        'label' => 'activo',
        'rules' => 'required'
    )
);

$config['nueva_unidad'] = array(
    array(
        'field' => 'clave_unidad',
        'label' => 'Clave unidad',
        'rules' => 'required'
    ),
    array(
        'field' => 'nombre',
        'label' => 'Nombre de la unidad',
        'rules' => 'required'
    ),
    array(
        'field' => 'id_delegacion',
        'label' => 'Delegación',
        'rules' => 'required|numeric'
    ),
    array(
        'field' => 'clave_presupuestal',
        'label' => 'Clave presupuestal',
        'rules' => 'required'
    ),
);

$config['update_catalogo_categorias'] = array(
    array(
        'field' => 'categoria',
        'label' => 'Categoria',
        'rules' => 'required'
    ),
    array(
        'field' => 'clave_categoria',
        'label' => 'Clave categoria',
        'rules' => 'required|max_length[12]'
    ),
    array(
        'field' => 'id_grupo_categoria',
        'label' => 'Grupo categoria',
        'rules' => 'required|is_numeric'
    ),
);

$config['insert_catalogo_categorias'] = array(
    array(
        'field' => 'id_categoria',
        'label' => 'ID',
        'rules' => 'required'
    ),
    array(
        'field' => 'categoria',
        'label' => 'Categoria',
        'rules' => 'required'
    ),
    array(
        'field' => 'clave_categoria',
        'label' => 'Clave categoria',
        'rules' => 'required|max_length[12]'
    ),
    array(
        'field' => 'id_grupo_categoria',
        'label' => 'Grupo categoria',
        'rules' => 'required|is_numeric'
    ),
);

$config['catalogo_unidades_instituto'] = array(
    array(
        'field' => 'clave_unidad',
        'label' => 'Clave unidad',
        'rules' => 'required'
    ),
    array(
        'field' => 'nombre',
        'label' => 'Nombre unidad',
        'rules' => 'required'
    ),
    array(
        'field' => 'id_delegacion',
        'label' => 'Delegación',
        'rules' => 'required|is_numeric'
    ),
    array(
        'field' => 'clave_presupuestal',
        'label' => 'Clave presupuestal',
        'rules' => 'required'
    ),
    array(
        'field' => 'nivel_atencion',
        'label' => 'Nivel de atención',
        'rules' => 'required|is_numeric'
    ),
    array(
        'field' => 'id_tipo_unidad',
        'label' => 'Tipo de unidad',
        'rules' => 'required|is_numeric'
    ),
    array(
        'field' => 'umae',
        'label' => 'Es UMAE',
        'rules' => 'required|is_numeric'
    ),
    array(
        'field' => 'activa',
        'label' => 'Activa',
        'rules' => 'required|is_numeric'
    ),
    array(
        'field' => 'id_region',
        'label' => 'Región',
        'rules' => 'required|is_numeric'
    ),
    array(
        'field' => 'anio',
        'label' => 'Año',
        'rules' => 'required|is_numeric'
    ),
);

$config['insert_catalogo_departamento'] = array(
    array(
        'field' => 'clave_unidad',
        'label' => 'Clave unidad',
        'rules' => 'required'
    ),
    array(
        'field' => 'departamento',
        'label' => 'Nombre de la adscripción',
        'rules' => 'required'
    ),
    array(
        'field' => 'clave_departamental',
        'label' => 'Clave adscripción',
        'rules' => 'required'
    ),
);

$config['update_catalogo_departamento'] = array(
    array(
        'field' => 'clave_unidad',
        'label' => 'Clave unidad',
        'rules' => 'required'
    ),
    array(
        'field' => 'nombre',
        'label' => 'Nombre de la adscripción',
        'rules' => 'required'
    ),
    array(
        'field' => 'clave_departamental',
        'label' => 'Clave adscripción',
        'rules' => 'required'
    ),
);


$config['catalogo_reglas_dependencia'] = array(
    array(
        'field' => 'clave_regla_dependecia_catalogo',
        'label' => 'Clave',
        'rules' => 'required'
    ),
    array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'required'
    ),
    array(
        'field' => 'id_catalogo_padre',
        'label' => 'Catálogo padre',
        'rules' => 'required|is_numeric'
    ),
    array(
        'field' => 'id_catalogo_hijo',
        'label' => 'Catálolgo hijo',
        'rules' => 'required|is_numeric'
    )
);

$config['catalogo_detalle_dependencias_catalogos'] = array(
    array(
        'field' => 'clave_regla_dependecia_catalogo',
        'label' => 'Clave',
        'rules' => 'required'
    ),
    array(
        'field' => 'id_elemento_catalogo_padre',
        'label' => 'Elemento padre',
        'rules' => 'required|is_numeric'
    ),
    array(
        'field' => 'id_elemento_catalogo_hijo',
        'label' => 'Elemento hijo',
        'rules' => 'required|is_numeric'
    )
);

$config["valida_evaluacion_revision"] = array(
    "seleccion_opcion_evaluacion_" => array(
        'field' => 'seleccion_opcion_evaluacion_',
        'label' => 'seccion',
        'rules' => 'required|numeric'
    ),
    "evaluacion_calificacion_" => array(
        'field' => 'evaluacion_calificacion_',
        'label' => 'Calificación',
        'rules' => 'required|numeric|is_valido_rango_calificacion[{seccion}]'
    ),
    "tipo_exposicion_eval" => array(
        'field' => 'tipo_exposicion_eval',
        'label' => 'Tipo de exposicón',
        'rules' => 'required'
    ),
    "observaciones_eval" => array(
        'field' => 'observaciones_eval',
        'label' => 'Observaciones',
        'rules' => 'required'
    ),
);
$config['form_editar_usuario_externos'] = array(
    array(
        'field' => 'ext_nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max[100]|alpha_accent_space_dot_quot'
    ),
    array(
        'field' => 'ext_ap',
        'label' => '',
        'rules' => 'trim|required|max[100]|alpha_accent_space_dot_quot' //|callback_valid_pass
    ),
    array(
        'field' => 'ext_am',
        'label' => '',
        'rules' => 'trim|max[100]|alpha_accent_space_dot_quot' //|callback_valid_pass
    ),
    array(
        'field' => 'ext_mail',
        'label' => 'E-mail',
        'rules' => 'trim|required|valida_correo_electronico' //|is_unico_datos_usuarios[email] //|callback_valid_pass
    ),
    array(
        'field' => 'sexo',
        'label' => 'Sexo',
        'rules' => 'trim|required' //|callback_valid_pass
    ),
    array(
        'field' => 'pais_institucion',
        'label' => '',
        'rules' => 'required'
    ),
    array(
        'field' => 'institucion',
        'label' => '',
        'rules' => 'required|max[100]'
    ),
    array(
        'field' => 'telefono_oficina',
        'label' => '',
        'rules' => 'max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'telefono_personal',
        'label' => '',
        'rules' => 'required|max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'pais_origen',
        'label' => '',
        'rules' => 'required'
    )
);

$config['form_editar_usuario_internos'] = array(
    array(
        'field' => 'ext_nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max[100]|alpha_accent_space_dot_quot'
    ),
    array(
        'field' => 'ext_ap',
        'label' => '',
        'rules' => 'trim|required|max[100]|alpha_accent_space_dot_quot' //|callback_valid_pass
    ),
    array(
        'field' => 'ext_am',
        'label' => '',
        'rules' => 'trim|max[100]|alpha_accent_space_dot_quot' //|callback_valid_pass
    ),
    array(
        'field' => 'ext_mail',
        'label' => 'E-mail',
        'rules' => 'trim|required|valida_correo_electronico' //|is_unico_datos_usuarios[email] //|callback_valid_pass
    ),
    array(
        'field' => 'sexo',
        'label' => 'Sexo',
        'rules' => 'trim|required' //|callback_valid_pass
    ),
    array(
        'field' => 'telefono_oficina',
        'label' => '',
        'rules' => 'max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'telefono_personal',
        'label' => '',
        'rules' => 'required|max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'pais_origen',
        'label' => '',
        'rules' => 'required'
    )
);

$config['form_editar_password'] = array(
    array(
        'field' => 'reg_password',
        'label' => 'Contraseña',
        'rules' => 'trim|required|min_length[8]' //|callback_valid_pass
    ),
    array(
        'field' => 'reg_repassword',
        'label' => 'Confirmación contraseña',
        'rules' => 'trim|required|matches[reg_password]'
    )
);

$config['form_editar_usuario_externos'] = array(
    array(
        'field' => 'ext_nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max[100]|alpha_accent_space_dot_quot'
    ),
    array(
        'field' => 'ext_ap',
        'label' => '',
        'rules' => 'trim|required|max[100]|alpha_accent_space_dot_quot' //|callback_valid_pass
    ),
    array(
        'field' => 'ext_am',
        'label' => '',
        'rules' => 'trim|max[100]|alpha_accent_space_dot_quot' //|callback_valid_pass
    ),
    array(
        'field' => 'ext_mail',
        'label' => 'E-mail',
        'rules' => 'trim|required|valida_correo_electronico' //|is_unico_datos_usuarios[email] //|callback_valid_pass
    ),
    array(
        'field' => 'sexo',
        'label' => 'Sexo',
        'rules' => 'trim|required' //|callback_valid_pass
    ),
    array(
        'field' => 'pais_institucion',
        'label' => '',
        'rules' => 'required'
    ),
    array(
        'field' => 'institucion',
        'label' => '',
        'rules' => 'required|max[100]'
    ),
    array(
        'field' => 'telefono_oficina',
        'label' => '',
        'rules' => 'max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'telefono_personal',
        'label' => '',
        'rules' => 'required|max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'pais_origen',
        'label' => '',
        'rules' => 'required'
    )
);

$config['form_actualizar_externo'] = array(
    array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max[100]|alpha_accent_space_dot_quot'
    ),
    array(
        'field' => 'apellido_paterno',
        'label' => '',
        'rules' => 'trim|required|max[100]|alpha_accent_space_dot_quot' //|callback_valid_pass
    ),
    array(
        'field' => 'apellido_materno',
        'label' => '',
        'rules' => 'trim|max[100]|alpha_accent_space_dot_quot' //|callback_valid_pass
    ),
    array(
        'field' => 'email',
        'label' => 'E-mail',
        'rules' => 'trim|required|valida_correo_electronico' //|is_unico_datos_usuarios[email] //|callback_valid_pass
    ),
    array(
        'field' => 'sexo',
        'label' => 'Sexo',
        'rules' => 'trim|required' //|callback_valid_pass
    ),
    array(
        'field' => 'pais_institucion',
        'label' => '',
        'rules' => 'required'
    ),
    array(
        'field' => 'institucion',
        'label' => '',
        'rules' => 'required|max[100]'
    ),
    array(
        'field' => 'telefono_oficina',
        'label' => '',
        'rules' => 'max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'telefono_personal',
        'label' => '',
        'rules' => 'required|max[50]|alpha_numeric_accent_space_dot'
    ),
    array(
        'field' => 'clave_pais',
        'label' => '',
        'rules' => 'required'
    )
);

$config['form_actualizar_interno'] = array(
    array(
        'field' => 'email',
        'label' => 'E-mail',
        'rules' => 'trim|required|valida_correo_electronico|is_unico_datos_usuarios[email]' //|callback_valid_pass
    )
);

// VALIDACIONES
/*
             * isset
             * valid_email
             * valid_url
             * min_length
             * max_length
             * exact_length
             * alpha
             * alpha_numeric
             * alpha_numeric_spaces
             * alpha_dash
             * numeric
             * is_numeric
             * integer
             * regex_match
             * matches
             * differs
             * is_unique
             * is_natural
             * is_natural_no_zero
             * decimal
             * less_than
             * less_than_equal_to
             * greater_than
             * greater_than_equal_to
             * in_list
             * validate_date_dd_mm_yyyy
             * validate_date
             * form_validation_match_date  la fecha debe ser mayor que ()
             *
             *
             *
             */


//custom validation

/*

alpha_accent_space_dot_quot
 *
alpha_numeric_accent_slash
 *
alpha_numeric_accent_space_dot_parent
 *
alpha_numeric_accent_space_dot_double_quot
 *
alpha_nombre_nomina //[ A-ZÑ] //Permite espacio, mayúsculas y Ñ
*/

/*
*password_strong
*
*
*
*
*/
