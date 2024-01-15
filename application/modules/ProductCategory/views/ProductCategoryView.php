<div class="container">
	<div class="row">
		<div class="col">
			<div class="page-description">
				<h1><?= $titleName; ?></h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Form • <?= $titleName; ?></h5>
				</div>
				<div class="card-body">
					<form id="form" method="post" class="row g-3">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="category" class="form-label">Category</label>
								<input type="hidden" id="id" name="id">
								<input type="text" class="form-control" id="category" name="category" placeholder="Category">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="img_url" class="form-label">Image</label>
								<input type="file" class="form-control" id="img_url" name="img_url" placeholder="Image">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="is_active" class="form-label">Status</label>
								<select class="form-select" id="is_active" name="is_active">
									<option value="1">Active</option>
									<option value="0">Inactive</option>
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
								<th>Category</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
								<th>No</th>
								<th>Category</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>