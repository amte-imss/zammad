<?php
$config['catalogo.unidades_instituto'] = array(
    'select' => array(
        'unidades.id_unidad_instituto', 'unidades.nombre unidad',
        'unidades.clave_unidad', 'unidades.anio anio',
        'delegacion.nombre delegacion', 'unidades.clave_presupuestal',
        'tipo_unidad.id_tipo_unidad', 'tipo_unidad.nombre tipo_unidad',
        '(case when unidades.grupo_tipo_unidad in ($$UMAE$$, $$CUMAE$$) then unidades.grupo_tipo_unidad  else $$$$ end) es_umae'
    ),
    'join' => array(
        array(
            'table' => 'catalogo.tipos_unidades tipo_unidad',
            'condition' => 'tipo_unidad.id_tipo_unidad = unidades.id_tipo_unidad',
            'type' => 'left'
        ),
        array(
            'table' => 'catalogo.delegaciones delegacion',
            'condition' => 'delegacion.id_delegacion = unidades.id_delegacion',
            'type' => 'left'
        )
    )
);

$config['catalogo.unidades_instituto completo']  = array(
    'select' => array(
        'unidades.id_unidad_instituto', 'unidades.nombre',
        'unidades.clave_unidad', 'unidades.anio anio',
        'unidades.nivel_atencion', 'unidades.id_tipo_unidad', 'unidades.umae',
        'unidades.clave_presupuestal', 'unidades.longitud', 'unidades.latitud',
        'unidades.id_region', 'unidades.grupo_tipo_unidad',
        'unidades.activa',
        'unidades.grupo_delegacion', 'unidades.direccion_fisica',
        'unidades.entidad_federativa', 'unidades.unidad_principal',
        'unidades.nombre_unidad_principal', 'unidades.clave_unidad_principal',
        'tipo_unidad.id_tipo_unidad', 'tipo_unidad.nombre tipo_unidad',
        'delegacion.id_delegacion',
        'delegacion.nombre delegacion',
        'tipo_unidad.nombre tipo_unidad',
    ),
    'join' => array(
        array(
            'table' => 'catalogo.tipos_unidades tipo_unidad',
            'condition' => 'tipo_unidad.id_tipo_unidad = unidades.id_tipo_unidad',
            'type' => 'left'
        ),
        array(
            'table' => 'catalogo.delegaciones delegacion',
            'condition' => 'delegacion.id_delegacion = unidades.id_delegacion',
            'type' => 'left'
        )
    )
);

$config['catalogo.departamentos_instituto'] = array(
    'select' => array(
        'departamentos.id_departamento_instituto', 'departamentos.nombre departamento',
        'departamentos.clave_departamental', 'departamentos.clave_unidad',
        'departamentos.activa'
    )
);

$config['catalogo.categorias'] = array(
    'select' => array('categorias.id_categoria', 'categorias.nombre categoria',
        'categorias.id_grupo_categoria', 'grupos_categorias.nombre grupo_categoria',
        'categorias.clave_categoria'),
    'join' => array(
        array(
            'table' => 'catalogo.grupos_categorias',
            'condition' => 'grupos_categorias.id_grupo_categoria = categorias.id_grupo_categoria',
            'type' => 'inner'
        )
    )
);

$config['catalogo.tipos_unidades'] = array(
    'select' => array(
        'tipos_unidades.id_tipo_unidad', 'tipos_unidades.nombre tipo_unidad'
    )
);

$config['catalogo.regiones'] = array(
    'select' => array(
        'regiones.id_region', 'regiones.nombre region'
    )
);

$config['formularios_activos'] = array(
    'select' => array(
        'id_formulario', 'catalogo.get_arbol_secciones_pinta_padres(id_elemento_seccion) arbol'
    ),
    'where' => array(
        'activo'=>true
    )
);

$config['catalogo.reglas_dependencia_catalogos'] = array(
    'select' => array(
        'reglas.clave_regla_dependecia_catalogo', 'reglas.nombre',
        'reglas.id_catalogo_hijo', 'reglas.id_catalogo_padre', 'reglas.descripcion'
    )
);

$config['catalogo.catalogo'] = array(
    'select' => array(
        'id_catalogo', 'label nombre'
    )
);

$config['catalogo.elementos_catalogos'] = array(
    'select' => array(
        'id_elemento_catalogo', 'label'
    )
);

$config['detalle_dependencias_catalogos'] = array(
    'select' => array(
        'clave_regla_dependecia_catalogo', 'id_elemento_catalogo_padre',
        'id_elemento_catalogo_hijo'
    )
);
