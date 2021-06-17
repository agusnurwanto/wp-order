<div class="wrap-order">
	<div class="modal fade" id="mod-create-order" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
               	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" style="clear: initial; font-size: large; font-weight: bold;">Create Order</h4>
		      	</div>
                <div class="modal-body">
                    <div class="alert alert-warning" style="display:none"></div>
                    <form name="form-order" id="form-order">
                        <div class="form-group">
                            <label class="control-label">Invoice Number</label>
                            <input type="text" class="form-control" name="invoice_number">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Created Date</label>
                            <input type="datetime-local" class="form-control" name="created_date">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Customer</label>
                            <input type="text" class="form-control" name="customer">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Payment Status</label>
                            <select class="form-control" name="payment_status">
                            	<option value="Unpaid">Unpaid</option>
                            	<option value="Fully paid">Fully paid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Fulfillment Status</label>
                            <select class="form-control" name="fulfillment_status">
                            	<option value="Unfulfilled">Unfulfilled</option>
                            	<option value="Fulfilled">Fulfilled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Total Amount</label>
                            <input type="number" class="form-control" name="total_amount">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="save_order">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div style="padding: 10px 0; text-align: center;">
    	<button class="btn btn-primary" id="create-order">Create Order</button>
    </div>
    <div style="padding: 10px 0; text-align: right;">
    	<form name="form-order" id="form-order" class="form-inline">
            <div class="form-group">
                <label class="control-label">Filter Payment Status:</label>
		    	<select class="form-control" name="payment_status_filter">
		    		<option selected>All</option>
		    		<option>Unpaid</option>
		    		<option>Fully paid</option>
		    	</select>
            </div>
        </form>
    </div>

	<table id="table-order">
		<thead>
			<tr>
				<th>No. of Order</th>
				<th>Invoice Number</th>
				<th>Date</th>
				<th>Customer</th>
				<th>Payment</th>
				<th>Fulfillment Status</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>