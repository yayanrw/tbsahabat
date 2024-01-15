<script>
	const BASE_URL = "<?= base_url() ?>";
	const CURRENT_URL = "<?= base_url(uri_string()); ?>";
	const CUSTOM_URL = "<?= base_url('admin/sub-categories'); ?>";

	$(document).ready(function() {
		loadDataTable()
		loadProductCategory()
		$('#form').validate({
			rules: {
				product_category_id: {
					required: true,
				},
				sub_category: {
					required: true,
				},
				is_active: {
					required: true,
				},
			}
		})
	});

	const loadProductCategory = () => {
		fetch(`${BASE_URL}/admin/categories/get/<?= $product_category_id ?>`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				Swal.close()
				if (res.status) {
					$('#product_category_id').val(res.data.id)
					$('#text_product_category').text(res.data.category)
					scrollToTop()
				} else {
					swalError(res.message)
				}
			})
			.catch(error => swalError(error))
	}

	const loadDataTable = () => {
		$('#table-data').DataTable({
			"destroy": true,
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
				"url": `${CUSTOM_URL}/datatable`,
				"type": "POST",
				"data": {
					'product_category_id': <?= $product_category_id; ?>
				}
			},
			"columnDefs": [{
				"targets": [0, -1],
				"orderable": false,
			}],
		});
	}

	$('#btnCancel').on('click', function() {
		setFormReadonly(false)
		formReset()
	})

	$('#form').on('submit', function(e) {
		e.preventDefault()
		let form = $(this)
		if ($("#form").valid()) {
			if ($('#btnSubmit').text() == 'Submit') {
				confirmationDialog('insert', function(callBack) {
					if (callBack) {
						Swal.showLoading()
						fetch(`${CUSTOM_URL}/insert`, {
								method: 'POST',
								body: new FormData(form[0])
							})
							.then(response => response.json())
							.then(res => {
								if (res.status) {
									swalSuccess('insert')
									formReset()
									loadDataTable()
								} else {
									swalError(res.message)
								}
							})
							.catch(error => swalError(error))
					}
				})
			} else {
				confirmationDialog('update', function(callBack) {
					if (callBack) {
						Swal.showLoading()
						fetch(`${CUSTOM_URL}/update`, {
								method: 'POST',
								body: new FormData(form[0])
							})
							.then(response => response.json())
							.then(res => {
								if (res.status) {
									swalSuccess('update')
									formReset()
									loadDataTable()
								} else {
									swalError(res.message)
								}
							})
							.catch(error => swalError(error))
					}
				})
			}
		}
	})

	const btnActive = (id, is_active) => {
		Swal.showLoading()
		fetch(`${CUSTOM_URL}/update-active/${id}/${is_active}`, {
				method: 'POST',
			})
			.then(response => response.json())
			.then(res => {
				Swal.close()
				if (res.status) {
					loadDataTable()
					swalSuccess('update')
				} else {
					swalError(res.message)
				}
			})
			.catch(error => swalError(error))
	}

	const btnEdit = (id) => {
		setFormReadonly(false)
		formReset()

		Swal.showLoading()
		fetch(`${CUSTOM_URL}/get/${id}`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				console.log(res);
				Swal.close()
				if (res.status) {
					$('#id').val(res.data.id)
					$('#product_category_id').val(res.data.product_category_id)
					$('#sub_category').val(res.data.sub_category)
					$('#is_active').val(res.data.is_active)
					$('#btnSubmit').html('Update')
					scrollToTop()
				} else {
					swalError(res.message)
				}
			})
			.catch(error => swalError(error))
	}

	const btnDelete = (id) => {
		confirmationDialog('delete', function(callBack) {
			if (callBack) {
				Swal.showLoading()
				fetch(`${CUSTOM_URL}/delete/${id}`, {
						method: 'GET'
					})
					.then(response => response.json())
					.then(res => {
						if (res.status) {
							swalSuccess('delete')
							loadDataTable()
						} else {
							swalError(res.message)
						}
					})
					.catch(error => swalError(error))
			}
		})
	}
</script>