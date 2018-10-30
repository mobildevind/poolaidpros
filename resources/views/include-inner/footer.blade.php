
</section>
  <input type="hidden" name="hiddenval" id="hiddenval">
<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<script src="{{ asset('js/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}"></script>
<script src="{{ asset('bs3/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{ asset('js/skycons/skycons.js') }}"></script>
<script src="{{ asset('js/jquery.scrollTo/jquery.scrollTo.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="{{ asset('js/calendar/clndr.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<!-- <script src="{{ asset('js/calendar/moment-2.2.1.js') }}"></script>
<script src="{{ asset('js/evnt.calendar.init.js') }}"></script> -->
<script src="{{ asset('js/jvector-map/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('js/jvector-map/jquery-jvectormap-us-lcc-en.js') }}"></script>
<script src="{{ asset('js/gauge/gauge.js') }}"></script>
<!--clock init-->
<script src="{{ asset('js/css3clock/js/css3clock.js') }}"></script>
<!--Easy Pie Chart-->
<script src="{{ asset('js/easypiechart/jquery.easypiechart.js') }}"></script>
<!--Sparkline Chart-->
<script src="{{ asset('js/sparkline/jquery.sparkline.js') }}"></script>
<!--Morris Chart-->
<script src="{{ asset('js/morris-chart/morris.js') }}"></script>
<script src="{{ asset('js/morris-chart/raphael-min.js') }}"></script>
<!--jQuery Flot Chart-->
<!-- <script src="/js/flot-chart/jquery.flot.js"></script>
<script src="/js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="/js/flot-chart/jquery.flot.resize.js"></script>
<script src="/js/flot-chart/jquery.flot.pie.resize.js"></script>
<script src="/js/flot-chart/jquery.flot.animator.min.js"></script>
<script src="/js/flot-chart/jquery.flot.growraf.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="{{ asset('js/jquery.customSelect.min.js') }}" ></script>
<!--common script init for all pages-->
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/poolaid/custom.js') }}"></script>
<!--script for this page-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js"></script>


<!--Date Picker-->  
<link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datepicker/css/datepicker.css') }}" />
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>
<script type="text/javascript" src="{{ asset('js/locales/bootstrap-datetimepicker.fr.js') }}" charset="UTF-8"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-fileupload/bootstrap-fileupload.js') }}" charset="UTF-8"></script>

 
@if(Route::currentRouteName() == 'admin.home')
<script src="{{ asset('js/dashboard.js') }}"></script>
@endif
<script type="text/javascript">
  
jQuery(document).ready(function() {


jQuery('#start').datepicker({
         autoclose: true,
             todayHighlight:true
        
    }).on('changeDate', function (ev) {
        if ($('#end').datepicker('getDate') != "" && $('#end').datepicker('getDate') !== undefined && $('#end').datepicker('getDate') < $('#start').datepicker('getDate')) {
            $('#end').datepicker('setDate', $('#start').datepicker('getDate'))
        }
        $('#end').datepicker('setStartDate', $(this).val());
    });


     jQuery('#end').datepicker({
            autoclose: true,
             todayHighlight:true
        });

  $('#clear').on('click', function (e) {
        $('#start').val('');
        $('#end').val('');
        db_table.ajax.reload(null, false);

    });


    $('#report-search-form').on('click', function (e) {
        $('#editable-sample').DataTable().ajax.reload();
    });


});



</script>
<script src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyC9ZbDWXCzoCztORFfeLfO-RMpxvtx_hEM" type="text/javascript"></script>

<script type="text/javascript">
    function initialize() {
        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
           // document.getElementById('city2').value = place.name;
            document.getElementById('Latitude').value = place.geometry.location.lat();
            document.getElementById('Longitude').value = place.geometry.location.lng();
            //alert("This function is working!");
            //alert(place.name);
           // alert(place.address_components[0].long_name);

        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 

jQuery('#deletecompany').on('click', function(e){
                var result = confirm("Are you sure you want to delete this row?");
                if (result) {
                    window.location.href = $(this).attr('href');
                    return true;
                } else {

                    return false;
                }
            });

</script>

</body>
</html>