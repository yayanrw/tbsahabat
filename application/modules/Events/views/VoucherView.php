<div class="container">
	<div class="row">
		<div class="col">
			<div class="page-description">
				<h1><?= $event->event; ?></h1>
				<!-- <span>Customized Bootstrap forms to match Neptune's styles.</span> -->
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<img src="<?= base_url('uploads/banner/' . $event->banner_file) ?>" class="card-img-top" alt="<?= $event->event; ?>">
				<div class="card-body">
					<h5 class="card-title"><?= $event->event; ?> <small><?= $event->slug; ?></small> </h5>
					<p><span class="badge <?= $event->is_active == '1' ? "badge-success" : "badge-danger" ?>"><?= $event->is_active == '1' ? "Active" : "Inactive" ?> </span></p>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Form • <?= $titleName; ?></h5>
				</div>
				<div class="card-body">
					<form id="form" method="post" class="row g-3">
						<div class="col-md-12">
							<div class="mb-3">
								<label for="voucher_code" class="form-label">Voucher Code</label>
								<input type="hidden" id="id" name="id">
								<input type="hidden" id="event_id" name="event_id" value="<?= $event->id ?>">
								<input type="text" class="form-control" id="voucher_code" name="voucher_code" placeholder="Voucher Code">
							</div>
						</div>
						<div class="col-md-12">
							<div class="mb-3">
								<label for="slug" class="form-label">Market Place</label>
								<select class="form-select" id="market_place_id" name="market_place_id">
									<option value="">- Select Market Place -</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<button id="btnCancel" type="button" class="btn btn-default">Cancel</button>
							<button id="btnSubmit" type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title"><?= $titleName; ?> Data </h5>
				</div>
				<div class="card-body">
					<table id="table-data" class="table table-hover non-hover" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Voucher Code</th>
								<th>Market Place</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
								<th>No</th>
								<th>Voucher Code</th>
								<th>Market Place</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>