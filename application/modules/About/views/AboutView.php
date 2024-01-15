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
						<div class="col-md-6">
							<div class="mb-3">
								<label for="name" class="form-label">Name</label>
								<input type="hidden" id="id" name="id">
								<input type="text" class="form-control" id="name" name="name" placeholder="Name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="img_url" class="form-label">Image</label>
								<input type="file" class="form-control" id="img_url" name="img_url" placeholder="Image">
							</div>
						</div>
						<div class="col-md-12">
							<div class="mb-3">
								<label for="address" class="form-label">Address</label>
								<textarea class="form-control" name="address" id="address" cols="30" rows="10" placeholder="Address"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="phone" class="form-label">Name</label>
								<input type="number" class="form-control" id="phone" name="phone" placeholder="Phone">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="whatsapp" class="form-label">Whatsapp</label>
								<input type="number" class="form-control" id="whatsapp" name="whatsapp" placeholder="Phone">
							</div>
						</div>
						<div class="col-md-12">
							<div class="mb-3">
								<label for="description" class="form-label">Description</label>
								<textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<button id="btnCancel" type="button" class="btn btn-default">Cancel</button>
							<button id="btnSubmit" type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>