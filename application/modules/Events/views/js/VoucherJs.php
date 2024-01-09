<script>
	const BASE_URL = "<?= base_url() ?>";
	const CURRENT_URL = "<?= base_url(uri_string()); ?>";

	$(document).ready(function() {
		loadDataTable()
		getMarketPlace()
		$('#form').validate({
			rules: {
				voucher_code: {
					required: true,
				},
				market_place_id: {
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
				"url": `${BASE_URL}events/voucher/datatable`,
				"type": "POST",
				"data": {
					'event_id': '<?= $event->id ?>'
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
		$('#market_place_id').val('').trigger('change');
	})

	$('#form').on('submit', function(e) {
		e.preventDefault()
		let form = $(this)
		if ($("#form").valid()) {
			if ($('#btnSubmit').text() == 'Submit') {
				confirmationDialog('insert', function(callBack) {
					if (callBack) {
						Swal.showLoading()
						fetch(`${BASE_URL}events/voucher/insert`, {
								method: 'POST',
								body: new FormData(form[0])
							})
							.then(response => response.json())
							.then(res => {
								if (res.status) {
									swalSuccess('insert')
									formReset()
									$('#market_place_id').val('').trigger('change');
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
						fetch(`${BASE_URL}events/voucher/update`, {
								method: 'POST',
								body: new FormData(form[0])
							})
							.then(response => response.json())
							.then(res => {
								if (res.status) {
									swalSuccess('update')
									formReset()
									$('#market_place_id').val('').trigger('change');
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
		$('#market_place_id').val('').trigger('change');

		Swal.showLoading()
		fetch(`${BASE_URL}events/voucher/get/${id}`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				Swal.close()
				if (res.status) {
					$('#id').val(res.data.id)
					$('#voucher_code').val(res.data.voucher_code)
					$('#market_place_id').val(res.data.market_place_id).trigger('change')
					$('#btnSubmit').html('Update')
					scrollToTop()
				} else {
					swalError(res.message)
				}
			})
			.catch(error => swalError(error))
	}

	const btnEdit = (id) => {
		setFormReadonly(false)
		formReset()
		$('#market_place_id').val('').trigger('change');

		Swal.showLoading()
		fetch(`${BASE_URL}events/voucher/get/${id}`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				console.log(res);
				Swal.close()
				if (res.status) {
					$('#id').val(res.data.id)
					$('#voucher_code').val(res.data.voucher_code)
					$('#market_place_id').val(res.data.market_place_id).trigger('change');
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
				fetch(`${BASE_URL}events/voucher/delete/${id}`, {
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

	const getMarketPlace = () => {
		fetch(`${BASE_URL}/master/marketplace/get-all`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				if (res.status) {
					$('#market_place_id').html('')
					$('#market_place_id').append(`<option value="">- Select Market Place -</option>`)
					res.data.forEach(element => {
						$('#market_place_id').append(`<option value="${element.id}">${element.market_place}</option>`)
					})
				} else {
					swalError(res.message)
				}
			})
			.catch(error => swalError(error))
	}
</script>