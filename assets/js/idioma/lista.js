$(function(){

    var grid=$('#lista_usuarios').jsGrid({

        width: "100%",
        height: "500px",
        deleteButton: false,
        filtering: true,
        inserting: true,
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
              //console.log(filter);
              mostrar_loader();
              var d = $.Deferred();
              //var result = null;

              $.ajax({
                  type: "GET",
                  url: site_url + "/idiomas/obtener_grupo_etiquetas/lista/",
                  data: filter,
                  dataType: "json"
              }).done(function (result) {
                  ocultar_loader();
                          console.log(result);
                          console.log(result.data);
                          d.resolve({
                              data: result.data,
                              itemsCount: result.length,
                          });
                      });

              return d.promise();
          },
         ////////////////////

          insertItem: function (item){
            console.log(item);
              //delete item.gestion;
              mostrar_loader();
                var di = $.Deferred();
                $.ajax({
                    type: "POST",
                    url: site_url + "/idiomas/obtener_grupo_etiquetas/crear",
                    data: item,
                }).done(function (json) {
                    //alert(json.message);
                    //grid.insertSuccess = json.success;
                    di.resolve(json.data);
                }).fail(function (jqXHR, error, errorThrown) {
                    console.log("error");
                    console.log(jqXHR);
                    console.log(error);
                    console.log(errorThrown);
                });
                ocultar_loader();
                return di.promise();
          },

 //////////////////// 

          updateItem: $.noop,
          deleteItem: $.noop
        },






        fields: [
                    {name: 'clave_grupo', title: 'Clave', type: 'text'},
                    {name: 'nombre', title: 'Nombre', type: 'text'},
                    {name: 'descripcion', title: 'Descripcion', type: 'text'},

                    {type: "control", editButton: false, deleteButton: false, width: "8%",

                     itemTemplate: function (value, item) {
			               var enlace_e = '<a href="'+site_url+'/idiomas/obtener_grupo_etiquetas/'+item.clave_grupo+'">Editar</a>';
                     var enlace_a = '<a href="'+site_url+'/idiomas/obtener_grupo_traduccion/'+item.clave_grupo+'">Agregar Etiquetas</a>';
                     var enlace   = enlace_e+'  '+enlace_a;
                     return enlace;
                    }}
                ]
            }
        );

        var origFinishInsert = jsGrid.loadStrategies.DirectLoadingStrategy.prototype.finishInsert;
        jsGrid.loadStrategies.DirectLoadingStrategy.prototype.finishInsert = function (insertedItem) {
            if (!this._grid.insertSuccess) { // define insertFailed on done of delete ajax request in insertFailed of controller
                return;
            }
            origFinishInsert.apply(this, arguments);
        };



        $("#pager").on("change", function() {
            var page = parseInt($(this).val(), 10);
            $("#lista_usuarios").jsGrid("option", "pageSize", page);
        });


});