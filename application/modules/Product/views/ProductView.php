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
								<label for="sku" class="form-label">SKU</label>
								<input type="hidden" id="id" name="id">
								<input type="text" class="form-control" id="sku" name="sku" placeholder="SKU">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="name" class="form-label">Name</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Name">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="brand_id" class="form-label">Brand</label>
								<select class="form-select" id="brand_id" name="brand_id">
									<option value="">- Select Brand -</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="product_category_id" class="form-label">Category</label>
								<select class="form-select" id="product_category_id" name="product_category_id">
									<option value="">- Select Category -</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="product_sub_category_id" class="form-label">Sub Category</label>
								<select class="form-select" id="product_sub_category_id" name="product_sub_category_id">
									<option value="">- Select Sub Category -</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="product_group_id" class="form-label">Group</label>
								<select class="form-select" id="product_group_id" name="product_group_id">
									<option value="">- Select Group -</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="price" class="form-label">Price</label>
								<input type="number" class="form-control" id="price" name="price" placeholder="Price">
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
							<div class="mb-3">
								<label for="specification" class="form-label">Specification</label>
								<textarea class="form-control" id="specification" name="specification" placeholder="Specification" rows="5"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="mb-3">
								<label for="description" class="form-label">Description</label>
								<textarea class="form-control" id="description" name="description" placeholder="Description" rows="5"></textarea>
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
								<th>SKU</th>
								<th>Name</th>
								<th>Brand</th>
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
								<th>SKU</th>
								<th>Name</th>
								<th>Brand</th>
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