<div class="container">
	<div class="row">
		<div class="col">
			<div class="page-description">
				<h1><?= $titleName; ?></h1>
				<!-- <span>Customized Bootstrap forms to match Neptune's styles.</span> -->
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
								<label for="event" class="form-label">Event</label>
								<input type="hidden" id="id" name="id">
								<input type="text" class="form-control" id="event" name="event" placeholder="Event">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="slug" class="form-label">Slug</label>
								<input type="text" class="form-control" id="slug" name="slug" placeholder="Slug eg: motogp-malaysia">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="banner_file" class="form-label">Banner</label>
								<input type="file" class="form-control" id="banner_file" name="banner_file">
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
								<th>Event</th>
								<th>Slug</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
								<th>No</th>
								<th>Event</th>
								<th>Slug</th>
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
