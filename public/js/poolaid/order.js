function editRow(oTable, nRow) {
    var aData = oTable.fnGetData(nRow);
//    console.log(aData);
//    var tableData = row.find("td").map(function() {
//        return $(this).text();
//    }).get();
//    var aData = tableData;
    var jqTds = $('>td', nRow);
    jqTds[0].innerHTML = '<input type="text" class="form-control small" name="order_detail_id" value="' + aData[0] + '">';
    jqTds[1].innerHTML = '<input type="text" class="form-control small" name="item_name" value="' + $.trim(aData[1]) + '">';
    jqTds[2].innerHTML = '<input type="text" class="form-control small" name="price" value="' + aData[2] + '">';
    jqTds[3].innerHTML = '<input type="text" class="form-control small" name="qty" value="' + aData[3] + '">';
    jqTds[4].innerHTML = '<input type="text" class="form-control small" disabled="disabled" readonly="readonly" name="total" value="' + aData[4] + '">';
    jqTds[5].innerHTML = '<a href="javascript:void(0);" class="btn btn-xs btn-primary edit">Save</a> <a href="" class="btn btn-xs btn-primary cancel">Cancel</a>';
    
}

function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }

                oTable.fnDraw();
}

function saveRow(oTable, nRow) {
        var jqInputs = $('input', nRow);
        var order_detail_id = jqInputs[0].value;
        var item_name = $.trim(jqInputs[1].value);
        var price = jqInputs[2].value;
        var qty = jqInputs[3].value;
        $.ajax({
                url: "/admin/orders/update/",
                data: {'order_detail_id':order_detail_id,'item_name':item_name,'price':price,'qty':qty},
                beforeSend: function () {
                },
                success: function (data) {
                        alert('Item Update Successfully.');
                        oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                        oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                        oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                        oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                        oTable.fnUpdate(parseInt(jqInputs[2].value*jqInputs[3].value), nRow, 4, false);
                        oTable.fnUpdate('<a href="javascript:void(0);" class="btn btn-xs btn-primary edit"><i class="fa fa-pencil"></i></a> <a href="" class="btn btn-xs btn-primary cancel">Cancel</a>', nRow, 5, false);
                        oTable.fnDraw();
                        return false;
                }
        });
        oTable.fnDraw();
}


var oTable = $('.table-order-items').dataTable({
    "aLengthMenu": [
        [5, 15, 20, -1],
        [5, 15, 20, "All"] // change per page values here
    ],
    // set the initial value
    "iDisplayLength": 5,
    "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
    "sPaginationType": "bootstrap",
    "oLanguage": {
        "sLengthMenu": "_MENU_ records per page",
        "oPaginate": {
            "sPrevious": "Prev",
            "sNext": "Next"
        }
    },
    "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0]
        }
    ]
});
          
var nEditing = null;

$(document).on("click","table.table-order-items tbody tr td:last-child a.cancel",function(e) {
    e.preventDefault();
    if ($(this).attr("data-mode") == "new") {
        var nRow = $(this).parents('tr')[0];
        oTable.fnDeleteRow(nRow);
    } else {
        restoreRow(oTable, nEditing);
        nEditing = null;
    }
});
            
$(document).on("click","table.table-order-items tbody tr td:last-child a.edit",function(e) {
     e.preventDefault();
    /* Get the row as a parent of the link that was clicked on */
    var nRow = $(this).parents('tr')[0];
    if (nEditing !== null && nEditing != nRow) {
        /* Currently editing - but not this row - restore the old before continuing to edit mode */
        restoreRow(oTable, nEditing);
        editRow(oTable, nRow);
        nEditing = nRow;
    } else if (nEditing == nRow && this.innerHTML == "Save") {
        /* Editing this row and want to save it */
        saveRow(oTable, nEditing);
        nEditing = null;
//        alert("Updated! Do not forget to do some ajax to sync with backend :)");
    } else {
        /* No edit in progress - let's start one */
        editRow(oTable, nRow);
        nEditing = nRow;
    }
});


$('.order_description_edit').click(function (e) {
    var content_desc = $.trim($('.order_description_h2').text());
    $('.order_description_h2').html('<textarea class="form-control order_description" name="order_description">'+content_desc+'</textarea>');
});

$(document).on("focusout","textarea.order_description",function() {
    var order_id = $('#order_id').val();
    var description = $(this).val();
    $.ajax({
        url: "/admin/orders/update_description/",
        data: {'description': description,'order_id':order_id},
        beforeSend: function () {
        },
        success: function (data) {
            alert('Description Update Successfully.');
            $('.order_description_h2').html('');
            $('.order_description_h2').html(description);
            return false;
        }
    });
});
//
//$(document).on("click","table.table-order-items tbody tr td:last-child a.save",function() {
//    var row = $(this).parents('tr');
//    var tableData = row.find("td input").map(function() {
//        return $(this).val();
//    }).get();
//    var order_id = tableData[0];
//    var item_name = $.trim(tableData[1]);
//    var price = tableData[2];
//    var qty = tableData[3];
//    $.ajax({
//            url: "/admin/orders/update/",
//            data: {'order_id':order_id,'item_name':item_name,'price':price,'qty':qty},
//            beforeSend: function () {
//            },
//            success: function (data) {
//                    alert('Item Update Successfully.');
//                    $('.order_description_h2').html('');
//                    $('.order_description_h2').html(description);
//                    return false;
//            }
//    });
//});

  
            