/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(".skill").select2();

$('form#vendor_service_add_form #category_id').change(function () {
    if($(this).val() == 2){
        $('form#vendor_service_add_form .price_fieldset').show();
    } else {
        $('form#vendor_service_add_form .price_fieldset').hide();
    }
    if($(this).val() == 14 || $(this).val() == 24 ){
        $('form#vendor_service_add_form .location_div').show();
        $('form#vendor_service_add_form .vendor_location').prop('disabled',false);
        $('form#vendor_service_add_form #customer_location').prop('disabled',false);
        $('form#vendor_service_add_form #vendor_location').prop('disabled',false);
    } else {
        $('form#vendor_service_add_form .location_div').hide();
        $('form#vendor_service_add_form #customer_location').prop('disabled',true);
        $('form#vendor_service_add_form #vendor_location').prop('disabled',true);
    }
});
$('form#vendor_service_add_form #vendor_id').change(function () {
    if ($(this).val() == '') {
        var optgroup_html_blank_option = '<option value="">Please Select Vendor</option>';
        $('form#vendor_service_add_form #category_id').find('option').remove();
        $('form#vendor_service_add_form #category_id').html(optgroup_html_blank_option);
        $('form#vendor_service_add_form #category_id').find('optgroup').remove();
    } else {
        $.ajax({
            url: "/admin/vendors/services/get_vendor_service_name",
            data: {'vendor_id': $(this).val()},
            beforeSend: function () {
                $('.loading').show();
            },
            success: function (data) {
                var optgroup_html = '';
                optgroup_html += "<option value='' label='Please Select Category'>";
                $.each(data[0], function (key, value) {
                     
                    if (key in data) {
                        optgroup_html += "<optgroup class='optgroup' label=" + value.category_name + ">";
                        $.each(data[key], function (key1, value1) {
                            optgroup_html += '<option value="' + value1.category_id + '">' + value1.category_name + '</option>';
                        });
                        optgroup_html += '</optgroup>';
                    } else {
                        optgroup_html += '<option value="' + value.category_id + '">' + value.category_name + '</option>';

                    }
                });
                $('#category_id').html(optgroup_html);
                $('.loading').hide();
            }
        });
    }
});
//$('form#vendor_service_add_form input:radio[name="is_quotable"]').change(function () {
//    if ($(this).val() == '1') {
//        $('form#vendor_service_add_form #price_tab').hide();
//        $('form#vendor_service_add_form #has_subitem_tab').hide();
//        $('form#vendor_service_add_form .price_fieldset').hide();
//        $('form#vendor_service_add_form .item_price_tab').hide();
//    } else {
//        $('form#vendor_service_add_form #price_tab').show();
//        $('form#vendor_service_add_form .price_fieldset').show();
//
//        if ($('form#vendor_service_add_form #price_type').val() != '1') {
//            $('form#vendor_service_add_form #has_subitem_tab').hide();
//            $('form#vendor_service_add_form #price_tab_change').hide();
//        } else {
//            $('form#vendor_service_add_form #has_subitem_tab').show();
//             $('form#vendor_service_add_form #price_tab_change').show();
//        }
//        
//        if ($('form#vendor_service_add_form input:radio[name="has_sub_items"]:checked').val() == '1') {
//            $('form#vendor_service_add_form .item_price_tab').show();
//        } else {
//            $('form#vendor_service_add_form .item_price_tab').hide();
//        }
//    }
//});

//$('form#vendor_service_add_form #price_type').change(function () {
//    if ($(this).val() != '1' || $(this).val() != 1) {
////        $('form#vendor_service_add_form #has_subitem_tab').hide();
//        $('form#vendor_service_add_form .item_price_tab').hide();
//    } else {
////        $('form#vendor_service_add_form #has_subitem_tab').show();
//        $('form#vendor_service_add_form .item_price_tab').show();
//        
//    }
//});


$(document).on("click", "form#vendor_service_add_form .item_price_tab .add_item_price", function () {
    var item_name = $(this).parents('.item_price_div').find('input.item_name').val();
    var item_price = $(this).parents('.item_price_div').find('input.item_price').val();
     if( item_name != '' && item_price != ''){
        var parent_class = $('.item_price_tab');
        var new_counter = parent_class.find('.item_price_div').length;
        var counter = new_counter - 1;
        parent_class.find(".action_item_price_div").html('<a style="font-size:20px;cursor: pointer" class="delete_item_price"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>');
        var html = '<div class="form-group item_price_div" id="item_price_div_' + new_counter + '"><label class="col-sm-3 control-label">Item</label><div class="col-lg-2"><input type="text" name="item_name[' + new_counter + ']" class="form-control item_name" placeholder="Enter Item Name"></div><div class="col-lg-2"><input type="text" name="item_price[' + new_counter + ']" class="form-control item_price" placeholder="Enter Item Price"></div><div class="col-lg-2"><input type="file" name="item_image[' + new_counter + ']" class="form-control item_image"><div class="col-lg-2"><input type="hidden" name="item_image_hidden[' + new_counter + ']" class="item_image_hidden"></div></div> <div class="action_item_price_div"><a style="cursor: pointer" class="btn btn-white add_item_price"><i class="fa fa-plus" aria-hidden="true"></i></a></div></div>';
        $('#item_price_div_' + counter).after(html);
     }
});
//$(document).on("change", "form#vendor_service_add_form input:radio[name='has_sub_items']", function () {
//    if ($(this).val() == '1') {
//        $('form#vendor_service_add_form .item_price_tab').show();
//        $('form#vendor_service_add_form #price_tab_change').hide();
//
//    } else {
//        $('form#vendor_service_add_form .item_price_tab').hide();
//        $('form#vendor_service_add_form #price_tab_change').show();
//
//    }
//});

$(document).on("click", "form#vendor_service_add_form .item_price_tab .delete_item_price", function () {
    $(this).parents(".item_price_div").remove();
    $("form#vendor_service_add_form .item_price_tab .item_price_div").each(function (i) {
        $(this).attr("id", "item_price_div_" + i);
        $(this).find("input:text.item_name").attr("name", "item_name[" + i + "]");
        $(this).find("input:text.item_price").attr("name", "item_price[" + i + "]");
        $(this).find("input:file.item_image").attr("name", "item_image[" + i + "]");
        $(this).find("input:hidden.item_image_hidden").attr("name", "item_image_hidden[" + i + "]");


    });
});


//$(document).on("click", "form#vendor_service_add_form .day_div .add_working_days_button", function () {
//    var start_time = $(this).parents('.day_div').find('input.start_time').val();
//    var end_time = $(this).parents('.day_div').find('input.end_time').val();
//    if(start_time != '' && end_time != ''){
//        var counter = $(this).attr('data-counter');
//        var dataHTML = get_week_html_div_html; 
//        var remove_html = get_week_html_div.remove;
//        remove_html = remove_html.replace(new RegExp("##COUNTER##", 'g'), counter);
//        var sub_counter = $('.working_days_div_' + counter).length;
//        var new_sub_counter = sub_counter + 1;
//        dataHTML = dataHTML.replace(new RegExp("##COUNTER##", 'g'), counter).replace(new RegExp("##SUB_COUNTER##", 'g'),new_sub_counter ).replace(new RegExp("##DAY_LABEL##", 'g'),'').replace(new RegExp("##ADD_BUTTON##", 'g'),'' ).replace(new RegExp("##REMOVE_BUTTON##", 'g'),remove_html).replace(new RegExp("##START_TIME##", 'g'),'').replace(new RegExp("##END_TIME##", 'g'),'');
//        $('#working_days_div_'+counter+'_'+sub_counter).after(dataHTML);
//        $('.timepicker').timepicker({
//            format: "H:i:s",
//            parseFormats: ["H:i:s"],
//            autoclose: true,
//            minuteStep: 1,
//            showSeconds: true,
//            showMeridian: false,
//        });
//        
//    }
//});


//$(document).on("click", "form#vendor_service_add_form .day_div .remove_working_days_button", function () {
//    
//    
//    var counter = $(this).attr('data-counter');
//    $(this).parents('.working_days_div_'+counter).remove();
//    
//    
//    
//   $("form#vendor_service_add_form .working_days_tab .working_days_div_"+counter).each(function (i) {
//       var sub_i = i+1;
//        $(this).attr("id", "working_days_div_" + counter+'_'+sub_i);
//        $(this).find("input:text.start_time").attr("name", "start_time[" + counter + "][" +sub_i + "]");
//        $(this).find("input:text.end_time").attr("name", "end_time[" + counter + "][" + sub_i + "]");
//        $(this).find("input:text.start_time").attr("id", "start_time_" + counter + "_" +sub_i);
//        $(this).find("input:text.end_time").attr("id", "end_time_" + counter + "_" + sub_i);
//    });
//});
//
//$('form#vendor_service_add_form input:radio[name="online_status"]').change(function () {
//    if ($(this).val() == '1') {
//        $('form#vendor_service_add_form .working_days_tab').show();
//    } else {
//        $('form#vendor_service_add_form .working_days_tab').hide();
//    }
//});