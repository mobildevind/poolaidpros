function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function KeycheckOnlyPhonenumber(e) {
    var KeyID = getKeyID(e);
    return (!((KeyID >= 65 && KeyID <= 90) || (KeyID >= 97 && KeyID <= 122) || (KeyID >= 33 && KeyID <= 39) || (KeyID >= 42 && KeyID <= 42) || (KeyID == 44) || (KeyID >= 46 && KeyID <= 47) || (KeyID >= 58 && KeyID <= 64) || (KeyID >= 91 && KeyID <= 96) || (KeyID >= 123 && KeyID <= 126)));
}

function KeycheckOnlyNumeric(e) {
    var KeyID = getKeyID(e);
    return (!((KeyID >= 65 && KeyID <= 90) || (KeyID >= 97 && KeyID <= 122) || (KeyID >= 33 && KeyID <= 39) || (KeyID >= 42 && KeyID <= 42) || (KeyID == 44) || (KeyID == 43) || (KeyID == 45) || (KeyID >= 46 && KeyID <= 47) || (KeyID >= 58 && KeyID <= 64) || (KeyID >= 91 && KeyID <= 96) || (KeyID >= 123 && KeyID <= 126)));
}

function KeycheckOnlyPrice(e) {
    var KeyID = getKeyID(e);
    return (!((KeyID >= 65 && KeyID <= 90) || (KeyID >= 97 && KeyID <= 122) || (KeyID >= 33 && KeyID <= 39) || (KeyID >= 42 && KeyID <= 42) || (KeyID == 44) || (KeyID == 43) || (KeyID == 45) || (KeyID > 46 && KeyID <= 47) || (KeyID >= 58 && KeyID <= 64) || (KeyID >= 91 && KeyID <= 96) || (KeyID >= 123 && KeyID <= 126)));
}

function KeycheckDontAllowSpecialChar(e) {
    var KeyID = getKeyID(e);
    return ((KeyID >= 97 && KeyID <= 122) || (KeyID >= 65 && KeyID <= 90) || KeyID == 45 || KeyID == 95 || KeyID == 0 || KeyID == 32 || (KeyID >= 48 && KeyID <= 57));
}

function getKeyID(e) {
    var _dom = 0;
    _dom = document.all ? 3 : (document.getElementById ? 1 : (document.layers ? 2 : 0));
    if (document.all)
        e = window.event; // for IE
    var ch = '';
    var KeyID = '';
    if (_dom == 2) { // for NN4
        if (e.which > 0)
            ch = '(' + String.fromCharCode(e.which) + ')';
        KeyID = e.which;
    } else {
        if (_dom == 3) { // for IE
            KeyID = (window.event) ? event.keyCode : e.which;
        } else { // for Mozilla
            if (e.charCode > 0)
                ch = '(' + String.fromCharCode(e.charCode) + ')';
            KeyID = e.charCode;
        }
    }
    console.log(KeyID);
    return KeyID;
}

function roundPrice(num, dec) {
    var d = Math.pow(10, dec);
    return (Math.round(num * d) / d).toFixed(dec);
}

function number_format(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function stripslashes(str) {
    return (str + '').replace(/\\(.?)/g, function (s, n1) {
        switch (n1) {
            case '\\':
                return '\\';
            case '0':
                return '\u0000';
            case '':
                return '';
            default:
                return n1;
        }
    });
}

function popover_data_activation($element, $trigger, $event) {
    $($element).unbind("popover");
    var $popover = $($element).popover({
        animation: true,
        content: function () {
            return $(this).attr('data-contant');
        },
        html: true,
        trigger: (($trigger !== undefined) ? $trigger : 'manual')
    });
    if ($event == undefined || $event == 'click') {
        $popover.on((($event !== undefined) ? $event : 'click'), function (e) {
            $($element).not(this).popover('hide');
            if ($(this).data('bs.popover').tip().hasClass('in')) {
                $(this).popover('hide');
            } else {
                $(this).popover('show');
            }
            e.stopPropagation();
        });
    }
    if($trigger == undefined || $trigger == 'click'){
        $(document).on((($trigger !== undefined) ? $trigger : 'click'), function (e) {
            var isPopover = $(e.target).is('[data-toggle=popover]');
            var inPopover = ($(e.target).closest('.popover').length > 0);
            if (!isPopover && !inPopover)
                $popover.popover('hide');
        });
    }
}

var EditableTable = function () {

    return {

        //main function to initiate the module
        init: function (tableName,pageName) {
            var DataTable;
            
            this.assignDataTable( (tableName != '' && tableName != undefined ? tableName : "#editable-sample") , pageName);

            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

            
       
            jQuery('#editable-sample').on('click', 'a.delete', function(e){
                e.preventDefault();
                e.stopPropagation();

                var result = confirm("Are you sure you want to delete this row?");
                if (result) {
                    window.location.href = $(this).attr('href');
                    return true;
                } else {

                    return false;
                }
            });
        },

        assignDataTable: function($table,pageName){
            
            var onReady = true;
            var data_ajax_url = $($table).attr('data-ajax-url');
            var colspan = $($table).find('thead').find('tr').find('th');
            var $order = $($table).attr("data-order-cols");
            var $order_type = $($table).attr("data-order-type");
            var $aoColumns = [];
            var $columns = [];
            var sColumns = [];
            var sColumnsSearch = [];
            colspan.each(function () {
                var bSortable = (typeof $(this).attr('data-table-sort') !== typeof undefined && $(this).attr('data-table-sort') === "true") ? true : false;
                var bSearchable = (typeof $(this).attr('data-table-search') !== typeof undefined && $(this).attr('data-table-search') === "true") ? true : false;
                var aoColumns = {};
                if ($(this).attr('data-table-search') === "true") {
                    sColumnsSearch.push({"name": $(this).attr('data-name'), "text": $(this).text()});
                }
                aoColumns["bSearchable"] = (typeof bSearchable !== typeof undefined) ? bSearchable : false;
                aoColumns["bSortable"] = (typeof bSortable !== typeof undefined) ? bSortable : false;
                aoColumns["sWidth"] = $(this).attr('data-width') + "%";
                aoColumns["mData"] = $(this).attr('data-name');
                aoColumns["sClass"] = $(this).attr('data-name');
                if (typeof $(this).attr('data-class') !== typeof undefined && $(this).attr('data-class') !== null) {
                    aoColumns["sClass"] = aoColumns["sClass"] + " " + $(this).attr('data-class');
                }
                sColumns.push($(this).attr('data-name'));

                $aoColumns.push(aoColumns);
                $columns.push({"data": $(this).attr('data-name')});
            });
            DataTable = $($table).DataTable({
                "processing": true,
                "serverSide": true,
                "columns": $columns,
                "aoColumns": $aoColumns,
                "columnFilter": $aoColumns,
                "oLanguage": {
                    "sSearch": "Search",
                    "sLengthMenu": "_MENU_ records per page",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "sPaginationType": "bootstrap",
                "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
                "bFilter": (sColumnsSearch.length > 0),
                "aaSorting": [[$order, $order_type]],
                "retrieve": true,
                "bProcessing": false,
                "bServerSide": true,
                "ajax": {
                    "url": data_ajax_url,
                    "data": function (aoData) {
                        aoData.customer_id = $("#customer_id").val();
                    }

                },
                "fnDrawCallback": function( oSettings ) {
                    if(pageName == 'subscriber') {
                        $('input[name="status[]"]').bootstrapToggle('active'); //this is for custom - list page
                    }
                }
            });
        }

    };

}();
