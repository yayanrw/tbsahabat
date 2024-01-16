<script>
	const BASE_URL = "<?= base_url() ?>";
	const CURRENT_URL = "<?= base_url(uri_string()); ?>";

	$(document).ready(function() {
		loadDataTable()
		getBrands()
		getCategories()
		$('#form').validate({
			rules: {
				sku: {
					required: true,
				},
				name: {
					required: true,
				},
				brand_id: {
					required: true,
				},
				product_category_id: {
					required: true,
				},
				product_sub_category_id: {
					required: true,
				},
				product_group_id: {
					required: true,
				},
				img_url: {
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

	$('#product_category_id').on('change', function() {
		getSubCategories($(this).val())
	})

	$('#product_sub_category_id').on('change', function() {
		getGroups($(this).val())
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
					$('#brand').val(res.data.brand)
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
					$('#brand').val(res.data.brand)
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

	const getBrands = () => {
		fetch(`${BASE_URL}/admin/brands/get-all`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				if (res.status) {
					$('#brand_id').html('')
					$('#brand_id').append(`<option value="">- Select Brand -</option>`)
					res.data.forEach(element => {
						$('#brand_id').append(`<option value="${element.id}">${element.brand}</option>`)
					})
				} else {
					swalError(res.message)
				}
			})
			.catch(error => swalError(error))
	}

	const getCategories = () => {
		fetch(`${BASE_URL}/admin/categories/get-all`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				if (res.status) {
					$('#product_category_id').html('')
					$('#product_category_id').append(`<option value="">- Select Category -</option>`)
					res.data.forEach(element => {
						$('#product_category_id').append(`<option value="${element.id}">${element.category}</option>`)
					})
				} else {
					swalError(res.message)
				}
			})
			.catch(error => swalError(error))
	}

	const getSubCategories = (product_category_id) => {
		fetch(`${BASE_URL}/admin/sub-categories/get-all?product_category_id=${product_category_id}`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				if (res.status) {
					$('#product_sub_category_id').html('')
					$('#product_sub_category_id').append(`<option value="">- Select Sub Category -</option>`)
					res.data.forEach(element => {
						$('#product_sub_category_id').append(`<option value="${element.id}">${element.sub_category}</option>`)
					})
				} else {
					swalError(res.message)
				}
			})
			.catch(error => swalError(error))
	}

	const getGroups = (product_group_id) => {
		fetch(`${BASE_URL}/admin/groups/get-all?product_group_id=${product_group_id}`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				if (res.status) {
					$('#product_group_id').html('')
					$('#product_group_id').append(`<option value="">- Select Group -</option>`)
					res.data.forEach(element => {
						$('#product_group_id').append(`<option value="${element.id}">${element.group}</option>`)
					})
				} else {
					swalError(res.message)
				}
			})
			.catch(error => swalError(error))
	}
</script>