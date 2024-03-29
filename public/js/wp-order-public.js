jQuery(document).ready(function($){
    var option_table = {
        serverSide: true,
        processing: true,
        pageLength: 20,
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
        ],
        ajax: {
            url: custom_script.ajax_url,
            type: 'POST',
            data: {
                action: 'get_order'
            }
        },
        columns: [
            {data: 'no', name: 'no', width: '140px', orderable: false, searchable: false, className:'text-center'},
            {data: 'invoice_number', name: 'invoice_number', orderable: false, className:'text-center'},
            {data: 'created_date', width: '140px', name: 'created_date', searchable: false, className:'text-center'},
            {data: 'customer', name: 'customer', className:'text-center'},
            {data: 'payment_status', name: 'payment_status', orderable: false, searchable: false, className:'text-center'},
            {data: 'fulfillment_status', name: 'fulfillment_status', orderable: false, searchable: false, className:'text-center'},
            {data: 'total_amount', name: 'total_amount', orderable: false, searchable: false, className: 'text-center'},
        ],
    };
    window.table_order = $('#table-order').DataTable(option_table);

    jQuery('#create-order').on('click', function(){
        jQuery('#mod-create-order').modal('show');
    });

    jQuery('select[name="payment_status_filter"]').on('change', function(){
        table_order.destroy();
        option_table.ajax.data.filter = jQuery(this).val();
        window.table_order = $('#table-order').DataTable(option_table);
    });

    jQuery('#save_order').on('click', function(){
        var all_data = {action: 'create_order'};
        all_data.invoice_number = jQuery('input[name="invoice_number"]').val();
        if(all_data.invoice_number == ''){
            return alert('Invoice Number is required!');
        }
        all_data.created_date = jQuery('input[name="created_date"]').val();
        if(all_data.created_date == ''){
            return alert('Created Date is required!');
        }
        all_data.customer = jQuery('input[name="customer"]').val();
        if(all_data.customer == ''){
            return alert('Customer is required!');
        }
        all_data.total_amount = jQuery('input[name="total_amount"]').val();
        if(all_data.total_amount == ''){
            return alert('Total Amount is required!');
        }
        all_data.payment_status = jQuery('select[name="payment_status"]').val();
        all_data.fulfillment_status = jQuery('select[name="fulfillment_status"]').val();
        jQuery.ajax({
            url: custom_script.ajax_url,
            type: 'POST',
            data: all_data,
            dataType: 'json',
            success: function(ret){
                alert(ret.msg);
                if(ret.status == 'success'){
                    table_order.ajax.reload();
                }
                jQuery('#mod-create-order').modal('hide');
            }
        })
    });
});
