<script>
	const BASE_URL = "<?= base_url() ?>";
	const CURRENT_URL = "<?= base_url(uri_string()); ?>";

	$(document).ready(function() {
		loadAbout()
		$('#form').validate({
			rules: {
				name: {
					required: true,
				},
				address: {
					required: true,
				},
				description: {
					required: true,
				},
				phone: {
					required: true,
				},
				whatsapp: {
					required: true,
				},
			}
		})
	});

	const loadAbout = () => {
		fetch(`${CURRENT_URL}/get/1`, {
				method: 'GET'
			})
			.then(response => response.json())
			.then(res => {
				Swal.close()
				if (res.status) {
					$('#id').val(res.data.id)
					$('#name').val(res.data.name)
					$('#address').val(res.data.address)
					$('#phone').val(res.data.phone)
					$('#whatsapp').val(res.data.whatsapp)
					$('#description').val(res.data.description)
					$('#btnSubmit').html('Update')
					scrollToTop()
				} else {
					swalError(res.message)
				}
			})
			.catch(error => swalError(error))
	}

	$('#btnCancel').on('click', function() {
		setFormReadonly(false)
		formReset()
	})

	$('#form').on('submit', function(e) {
		e.preventDefault()
		let form = $(this)
		if ($("#form").valid()) {
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
							} else {
								swalError(res.message)
							}
						})
						.catch(error => swalError(error))
				}
			})
		}
	})
</script>