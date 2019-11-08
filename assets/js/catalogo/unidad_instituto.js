$(function(){

    var grid=$('#lista_registros').jsGrid({
        width: "100%",
        height: "500px",
        deleteButton: false,
        filtering: true,
        inserting: false,
        editing: false,
        sorting: true,
        selecting: false,
        paging: true,
        autoload: true,
        pageSize: 10,
        pageButtonCount: 3,
        pagerFormat: "Paginas: {first} {prev} {pages} {next} {last}    {pageIndex} de {pageCount}",
        pagePrevText: "Anterior",
        pageNextText: "Siguiente",
        pageFirstText: "Primero",
        pageLastText: "Último",
        pageLoading: true,
        pageNavigatorNextText: "...",
        pageNavigatorPrevText: "...",
        noDataContent: "No se encontraron datos",
        controller: {
          loadData: function (filter) {
              mostrar_loader();
              //console.log(filter);
              var d = $.Deferred();
              //var result = null;

              $.ajax({
                  type: "GET",
                  url: site_url + "/catalogo/unidad_instituto/lista/",
                  data: filter,
                  dataType: "json"
              }).done(function (result) {
                          console.log(result);
                          console.log(result.data);
                          d.resolve({
                              data: result.data,
                              itemsCount: result.length,
                          });
                      });
                      ocultar_loader();
              return d.promise();
          },
          insertItem: $.noop,
          updateItem: $.noop,
          deleteItem: $.noop
        },
        fields: [
                    {name: 'id_unidad_instituto', title: "#", visible: false},
                    //{name: 'delegacion', title: 'Delegación', type: 'text'},
                    {name: 'clave_unidad', title: 'Clave unidad', type: 'text'},
                    {name: 'nombre', title: 'Unidad', type: 'text'},
                    {name: 'clave_presupuestal', title: 'Clave presupuestal', type: 'text'},
                    //{name: 'es_umae', title: 'UMAE', type: 'text'},
                    {name: 'anio', title: 'Año', type: 'integer'},
                    {type: "control", editButton: false, deleteButton: false, width: "10%",
                    headerTemplate: function() {
                        return '<a href="'+site_url+'/catalogo/unidad_instituto/agregar/">Agregar</a>';
                    }, itemTemplate: function (value, item) {
                        return '<a href="'+site_url+'/catalogo/unidad_instituto/editar/'+item.id_unidad_instituto+'">Editar</a>';
                    }}
                ]
            }
        );
        $("#pager").on("change", function() {
            var page = parseInt($(this).val(), 10);
            $("#lista_registros").jsGrid("option", "pageSize", page);
        });
});
