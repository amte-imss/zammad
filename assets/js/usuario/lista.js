$(function(){

  var grid=$('#lista_usuarios').jsGrid({
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
        //console.log(filter);
        mostrar_loader();
        var d = $.Deferred();
        //var result = null;

        $.ajax({
          type: "GET",
          url: site_url + "/usuario/get_usuarios/lista/",
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
      insertItem: $.noop,
      updateItem: $.noop,
      deleteItem: $.noop
    },
    fields: [
      {name: 'id_usuario', title: "#", visible: false},
      //{name: 'matricula', title: 'Matrícula', type: 'text'},
      {name: 'username', title: 'Usuario', type: 'text'},
      {name: 'nombre_completo', title: 'Nombre completo', type: 'text'},
      {name: 'delegacion', title: 'Delegación', type: 'text'},
      //{name: 'unidad', title: 'Unidad', type: 'text'},
      {name: 'es_imss', title: 'Interno', type: 'checkbox', sorting: false},
      {name: 'activo', title: 'Activo', type: 'checkbox', sorting: false},
      {name: 'rol', title: 'Roles', sorting: false, filtering: false},
      {type: "control", editButton: false, deleteButton: false, width: "10%",
        itemTemplate: function (value, item) {
          var enlace_editar = '<a href="'+site_url+'/usuario/get_usuarios/'+item.id_usuario+'">Editar</a>';
          //var enlace_entrar_como = '<a  data-toggle="modal" data-target="#modal_entrar_como" onclick="entrar_como('+item.id_usuario+')">Entrar como</a>';
          var elemento = enlace_editar;// + ' | ' + enlace_entrar_como ;
          return elemento;
        }
      }
    ]
  });
  
  $("#pager").on("change", function() {
    var page = parseInt($(this).val(), 10);
    $("#lista_usuarios").jsGrid("option", "pageSize", page);
  });
});

function entrar_como(id){
  var destino = site_url + '/administracion/entrar_como/' + id;
  $('#form_entrar_como').attr('action', destino);
}
