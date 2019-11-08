$(function(){

    var grid=$('#lista_registros').jsGrid({
        width: "100%",
        height: "500px",
        // deleteButton: true,
        filtering: true,
        inserting: true,
        editing: true,
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
        onItemUpdating: function (args) {
          grid._lastPrevItemUpdate = args.previousItem;
        },
        controller: {
          loadData: function (filter) {
              mostrar_loader();
              //console.log(filter);
              var d = $.Deferred();
              //var result = null;

              $.ajax({
                  type: "GET",
                  url: site_url + "/catalogo/categoria/lista/",
                  data: filter,
                  dataType: "json"
              }).done(function (result) {
                          d.resolve({
                              data: result.data,
                              itemsCount: result.length,
                          });
                      });
                      ocultar_loader();
              return d.promise();
          },
          insertItem: function (item){
              mostrar_loader();
                var di = $.Deferred();
                $.ajax({
                    type: "POST",
                    url: site_url + "/catalogo/categoria/agregar",
                    data: item
                }).done(function (json) {
                    alert(json.message);
                    grid.insertSuccess = json.success;
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
          updateItem: function(item){
              var de = $.Deferred();
               $.ajax({
                   type: "POST",
                   url: site_url + "/catalogo/categoria/editar",
                   data: item
               }).done(function (json) {
                   console.log('success');
                   alert(json.message);
                   if (json.success) {
                       json.data.id_grupo_categoria = parseInt(json.data.id_grupo_categoria);
                       de.resolve(json.data);
                   } else {
                       de.resolve(grid._lastPrevItemUpdate);
                   }
               }).fail(function (jqXHR, error, errorThrown) {
                   console.log("error");
                   console.log(jqXHR);
                   console.log(error);
                   console.log(errorThrown);
               });
               return de.promise();
          },
          deleteItem: function(item){
              var de = $.Deferred();
               $.ajax({
                   type: "POST",
                   url: site_url + "/catalogo/categoria/eliminar",
                   data: item
               }).done(function (json) {
                   console.log('success');
                   alert(json.message);
                   de.resolve(json.data);
               }).fail(function (jqXHR, error, errorThrown) {
                   console.log("error");
                   console.log(jqXHR);
                   console.log(error);
                   console.log(errorThrown);
               });
               return de.promise();
          }
        },
        fields: [
                    {name: 'id_categoria', title: "#", visible: false},
                    {name: 'clave_categoria', title: 'Clave', type: 'text'},
                    {name: 'categoria', title: 'Categoría', type: 'text'},
                    {name: 'id_grupo_categoria', title: 'Grupo de categoría', type: 'select', items: g_grupos_categorias, valueField: "id_grupo_categoria", textField: "grupo_categoria"},
                    {type: "control", editButton: false, width: "10%"}
                ]
            }
        ).data("JSGrid");

        var origFinishInsert = jsGrid.loadStrategies.DirectLoadingStrategy.prototype.finishInsert;
        jsGrid.loadStrategies.DirectLoadingStrategy.prototype.finishInsert = function (insertedItem) {
            if (!this._grid.insertSuccess) { // define insertFailed on done of delete ajax request in insertFailed of controller
                return;
            }
            origFinishInsert.apply(this, arguments);
        };

        $("#pager").on("change", function() {
            var page = parseInt($(this).val(), 10);
            $("#lista_registros").jsGrid("option", "pageSize", page);
        });
});
