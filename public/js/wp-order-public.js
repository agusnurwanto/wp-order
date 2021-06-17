jQuery(document).ready(function($){
	$('#table-order').DataTable({
        serverSide: true,
        processing: true,
        pageLength: 20,
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"] // change per page values here
        ],
        ajax: {
            url: custom_script.ajax_url,
            type: 'POST',
            data: {
            	action: 'get_order'
            }
        },
        columns: [
            {data: 'no', name: 'no', width: '140px', className:'text-center'},
            {data: 'invoice_number', name: 'invoice_number', className:'text-center'},
            {data: 'created_date', width: '140px', name: 'created_date', className:'text-center'},
            {data: 'customer', name: 'customer', className:'text-center'},
            {data: 'payment_status', name: 'payment_status', className:'text-center'},
            {data: 'fulfillment_status', name: 'fulfillment_status', className:'text-center'},
            {data: 'total_amount', name: 'total_amount', orderable: false, searchable: false, className: 'text-center'},
        ],
    });

    jQuery('#create-order').on('click', function(){
    	jQuery('#mod-create-order').modal('show');
    })
});
