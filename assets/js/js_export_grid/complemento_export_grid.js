function calcula_ancho_grid(padre, classe) {

    var d = $('#' + padre).data("JSGrid");
    var itemsCount = d.data.length;//Obtiene el tamaño de los datos
//    console.log(d.height);
//    console.log(d);
//    console.log(itemsCount);
    if (itemsCount < 1) {
        var ancho = 0;
        $('#' + padre + ' .' + classe).each(function (index, value) {
            ancho += parseInt(value.style.width.split('px')[0]);
        });
        $('#' + padre + ' .jsgrid-cell').css('width', ancho);
        $('#' + padre + ' .jsgrid-grid-body').css('height', '100');
//        whidth: ancho + 'px'
    } else {//regresa a su estado por default el ancho del body
//        $('#' + padre + ' .jsgrid-grid-body').css('height', d.height.split('px')[0]);//Asigana el valor por default de las propieddes del grid indicado

    }


}
var XLSX;

function export_xlsx_grid(grid_js_name, headers, name_file, sheet_name) {
    var data = $('#' + grid_js_name).data('JSGrid').data;
    var name_f = name_file + '.xlsx';
    export_xlsx(data, headers, name_f, sheet_name);
}

function export_xlsx(data, cabeceras, nombre_file, nombre_libro_excel) {
    var auxdata = prep_objetc(data, cabeceras);
//    console.log(auxdata);
    var new_ws = XLSX.utils.aoa_to_sheet(auxdata);

    /* build workbook */
    var new_wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(new_wb, new_ws, nombre_libro_excel);

    /* write file and trigger a download */
    var wbout = XLSX.write(new_wb, {bookType: 'xlsx', bookSST: true, type: 'binary'});
    var fname = nombre_file;
    try {
        saveAs(new Blob([s2ab(wbout)], {type: "application/octet-stream"}), fname);
    } catch (e) {
        if (typeof console != 'undefined')
            console.log(e, wbout);
    }
}


function prep_objetc(arr) {
    var out = [];
    var init = 0;

    var valor;
    var cabeceras = null;
    if (arguments.length === 2) {//Prepara los datos extra que se enviarán por post
        cabeceras = arguments[1];
        var aux_cabeceras = [];
        Object.keys(cabeceras).forEach(function (c, index) {
            aux_cabeceras[index] = cabeceras[c];
        });
        out[init] = aux_cabeceras;
        init++;
    }
//    console.log(arr[6]);
    for (var i = 0; i < arr.length; ++i) {
        if (!arr[i])
            continue;
        valor = arr[i];
        if (typeof valor === 'object') {
            var auxarr = [];
            Object.keys(cabeceras).forEach(function (c, index) {
                auxarr[index] = valor[c];
            });
//            console.log(auxarr);
            out[(i + init)] = auxarr;
//            console.log(auxarr);
            continue;
        }
    }
//    console.log(out);
    return out;

}

function prep(arr) {
    var out = [];
    var valor;
    var cabeceras = null;
    if (arguments.length === 2) {//Prepara los datos extra que se enviarán por post
        cabeceras = arguments[1];
    }
//    console.log(arr[6]);
    for (var i = 0; i < arr.length; ++i) {
        if (!arr[i])
            continue;
//        if (Array.isArray(arr[i])) {
        valor = arr[i];
        if (Array.isArray(valor)) {
//            console.log(arr[i]);
            out[i] = valor;
            continue;
        }

        var o = new Array();
        Object.keys(arr[i]).forEach(function (k) {
            o[+k] = arr[i][k]
        });
        out[i] = o;
    }
//    console.log(out);

    return out;
}

function s2ab(s) {
    var b = new ArrayBuffer(s.length), v = new Uint8Array(b);
    for (var i = 0; i != s.length; ++i)
        v[i] = s.charCodeAt(i) & 0xFF;
    return b;
}

/**
 * @author LEAS88
 * @param {type} headers, cabeceras
 * @param {type} unset_headers, cabeceras a eliminar
 * @returns {unresolved}
 */
function remove_headers(headers, unset_headers) {
    Object.keys(unset_headers).forEach(function (c, index) {
//        console.log(c);
        if (headers.hasOwnProperty(c)) {
            delete headers[c];
        }
    });
    return headers;
}



function jsgrid_generales_final_no_agregar_registros_error() {
    /**
     *
     * @type jsGrid.loadStrategies.DirectLoadingStrategy.prototype.finishInsert|window.jsGrid.loadStrategies.DirectLoadingStrategy.prototype.finishInsert
     */
    var origFinishInsert = jsGrid.loadStrategies.DirectLoadingStrategy.prototype.finishInsert;
    jsGrid.loadStrategies.DirectLoadingStrategy.prototype.finishInsert = function (insertedItem) {
        if (!this._grid.insertSuccess) { // define insertFailed on done of delete ajax request in insertFailed of controller
            return;
        }
        origFinishInsert.apply(this, arguments);
    }
}

function jsgrid_generales_final_no_delete_registros_error(deletionFailed, item) {
    var origFinishDelete = jsGrid.loadStrategies.DirectLoadingStrategy.prototype.finishDelete;
    jsGrid.loadStrategies.DirectLoadingStrategy.prototype.finishDelete = function (deletedItem, deletedItemIndex) {
        if (deletionFailed) { // define deletionFailed on done of delete ajax request in deleteItem of controller
            return;
        }
        origFinishDelete.apply(this, arguments);
    };
}
