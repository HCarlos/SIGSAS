
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
        }
    });

    if ( $("#datatable").length > 0 ){

        var nCols = $("#datatable").find("tbody > tr:first td").length;
        var aCol = [];

        aCol[nCols - 1] = {"sorting": false};
        if (aCol.length > 0 ){
            $("#datatable").DataTable({
                searching: true,
                paging: true,
                info: true,
                pageLength: 25,
                order: [[ 0, "desc" ]],
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
                aoColumns: aCol
            });
        }
    }


});
