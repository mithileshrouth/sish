$(document).ready(function() {


 $('#patient_list').DataTable( {
    
    "fixedHeader": {
            header: true,
            footer: true
        },
      
     "orderCellsTop": true,
    

        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search..."
        },
        'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1,-2] /* 1st one, start by the right */
            }],
        initComplete: function () {
            this.api().columns([3,4,5,6,7]).every( function () {
                var column = this;
                var select = $('<select class="form_input_text selectpicker" data-live-search="true"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
                $('.selectpicker').selectpicker('refresh');
            } );
            
        }

/*********************************/


} );

    
      
      



 $('#patient_list tfoot tr').insertBefore($('#patient_list thead tr'));

  } );



