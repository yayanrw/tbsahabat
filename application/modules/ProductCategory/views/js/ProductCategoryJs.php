<script>
	const BASE_URL = "<?= base_url() ?>";
	const CURRENT_URL = "<?= base_url(uri_string()); ?>";

	$(document).ready(function() {
		loadDataTable()
		$('#form').validate({
			rules: {
				category: {
					required: true,
				},
				is_active: {
					required: true,
				},
			}
		})
	});

	const loadDataTable = () => {
		$('#table-data').DataTable({
			"destroy": true,
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
				"url": `${CURRENT_URL}/datatable`,
				"type": "POST"
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
						fetch(`${CURRENT_URL}/insert`, {
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
						fetch(`${CURRENT_URL}/update`, {
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

	const btnView = (id) => {
		setFormReadonly(true)
		formReset()

		Swal.showLoading()
		fetch(`${CURRENT_URL}/get/${id}`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				Swal.close()
				if (res.status) {
					$('#id').val(res.data.id)
					$('#category').val(res.data.category)
					$('#is_active').val(res.data.is_active)
					$('#btnSubmit').html('Update')
					scrollToTop()
				} else {
					swalError(res.message)
				}
			})
			.catch(error => swalError(error))
	}

	const btnActive = (id, is_active) => {
		Swal.showLoading()
		fetch(`${CURRENT_URL}/update-active/${id}/${is_active}`, {
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
		fetch(`${CURRENT_URL}/get/${id}`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				console.log(res);
				Swal.close()
				if (res.status) {
					$('#id').val(res.data.id)
					$('#category').val(res.data.category)
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
				fetch(`${CURRENT_URL}/delete/${id}`, {
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