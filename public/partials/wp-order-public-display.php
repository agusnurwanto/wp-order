<div class="wrap-order">
	<div class="modal fade" id="mod-create-order" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bgpanel-theme">
                    <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="">Create Order</h4>
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
                            <input type="datetime-local" class="form-control" name="customer">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Customer</label>
                            <input type="text" class="form-control" name="customer">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Payment Status</label>
                            <input type="text" class="form-control" name="payment_status">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Fulfillment Status</label>
                            <input type="text" class="form-control" name="fulfillment_status">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Total Amount</label>
                            <input type="number" class="form-control" name="total_amount">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary simpan-admin" name="simpan_admin" id="simpan_admin">Simpan</button>
                    <button type="button" class="btn btn-success reset-admin" name="reset_admin" id="reset_admin" style="display:none">Reset Password</button>
                    <button type="button" class="btn btn-info mutakhir-admin" name="mutakhir_admin" id="mutakhir_admin" style="display:none">Mutakhirkan User</button>
                </div>
            </div>
        </div>
    </div>
    <div>
    	<button class="btn btn-primary" id="create-order">Create Order</button>
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