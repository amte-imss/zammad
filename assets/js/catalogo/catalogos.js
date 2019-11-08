$(function(){
    var grid=$('#lista_registros').jsGrid({
        width: "100%",
        height: "600px",
        deleteButton: false,
        filtering: true,
        inserting: false,
        editing: true,
        sorting: true,
        selecting: true,
        paging: true,
        autoload: true,
        pageSize: 25,
        pageButtonCount: 2,
        pageLoading: true,
        // rowClick: function(args) {
        //   console.log("Argumentos: ", args);
        //   args.item
        // },
        onItemUpdating: function(args) {
          console.log("Update item " + args.item);
          $.ajax({
            type: 'POST',
            url: site_url + '/catalogo/restfull_modulos/catalogo/actualizar/'+ args.item.id_catalogo,
            data: args.item,
            dataType: 'json'
          }).done(function(result){
            console.log("Resultado de actualizar: ", result);
          }).fail(function(xhr) {
            console.log('error', xhr);
          });
        },
        controller: {
          loadData: function (filter) {
              mostrar_loader();
              var d = $.Deferred();
              //var result = null;

              $.ajax({
                  type: "GET",
                  url: site_url + "/catalogo/restfull_modulos/catalogo/leer",
                  data: filter,
                  dataType: "json"
              }).done(function (result) {
                          console.log("Resultado de leer: ", result);
                          console.log(result.data);
                          d.resolve({
                              data: result.datos.data,
                              itemsCount: result.datos.length,
                          });
                      });
                      ocultar_loader();
              return d.promise();
          },
          insertItem: function(datos){
              datos.label = datos.nombre;
              datos.editable = true;
              console.log("Insertar Item ", datos);
              $.ajax({
                type: 'POST',
                url: site_url + '/catalogo/restfull_modulos/catalogo/crear',
                data: datos,
                dataType: 'json'
              }).done(function(result){
                console.log("Resultado de insertar: ", result);
              }).fail(function(xhr) {
                console.log('error', xhr);
              });
          },
          updateItem: $.noop,
          deleteItem: $.noop
        },
        fields: [
                    {name: 'id_catalogo', title: "Id", visible:false},
                    {name: 'nombre', title: 'Nombre', type: 'text'},
                    {name: 'descripcion', title: 'Descripcion', type: 'text'},
                    {name: 'label', title: 'Etiqueta/Label', type: 'text', visible:false},
                    {name: 'tipo', title:"Tipo", type:'text', visible:true},
                    {name: 'editable', title:"Editable", type:'text', visible: true},
                    {type: "control", editing: false, modeSwitchButton: false, editButton: false, deleteButton: false, width: "10%",
                    headerTemplate: function() {
                        return $("<button>").attr("type", "button").text("Agregar")
                                .on("click", function () {
                                    showDetailsDialog("Add", {});
                                });
                    },
                    itemTemplate: function (value, item) {
                        return '<a href="'+site_url+'/catalogo/ver_catalogos/'+item.id_catalogo+'">Ver catalogo</a>';
                    }}
                ]
            }
        );


        $("#detailsDialog").dialog({
          autoOpen: false,
          width: 400,
          close: function() {
            $("#msjError").hide();
          }
        });

        var formSubmitHandler = $.noop;

        var showDetailsDialog = function(dialogType, client) {
            $( "#detailsForm button:last-child" ).hide()
            $("#nombre").val(client.nombre);
            $("#descripcion").val(client.descripcion);
            $("#tipo").val(client.tipo);
            $( "#detailsForm" ).prepend( "<p id='msjError'></p>" );
            //$("#detailsForm").append("<p id='msjError'></p>");
            $("#detailsDialog").dialog("option", "title", "Agregar catalogo").dialog("open");
        };

        $( "#detailsForm" ).submit(function( event ) {
            event.preventDefault();
            var client = {
                nombre: $("#nombre").val(),
                descripcion: $("#descripcion").val(),
                tipo: $("#tipo").val()
            };

            console.log("Valores: ", client);
            if(client.nombre == "" || client.descripcion == "" || client.tipo == null){
              $("#msjError").html("Error: Los campos son requeridos para agregar un elemento");
            }else{
              $("#lista_registros").jsGrid("insertItem", client);
              $("#detailsDialog").dialog("close");
            }

        });


        $("#pager").on("change", function() {
            var page = parseInt($(this).val(), 10);
            $("#lista_registros").jsGrid("option", "pageSize", page);
        });

});
