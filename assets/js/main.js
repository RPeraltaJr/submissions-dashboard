jQuery(document).ready( function() {

    jQuery.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = jQuery('#min').datepicker("getDate");
            var max = jQuery('#max').datepicker("getDate");
            var startDate = new Date(data[1]); 
            if (min == null && max == null) { return true; }
            if (min == null && startDate <= max) { return true;}
            if (max == null && startDate >= min) {return true;}
            if (startDate <= max && startDate >= min) { return true; }
            return false; 
        }
    );
    
    jQuery("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
    jQuery("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });

    var table = jQuery('#submissions_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    // Event listener to the two range filtering inputs to redraw on input
    jQuery('#min, #max').change(function () {
        table.draw();
    });

});