<script>
    const BASE_URL = '<?= base_url() ?>';
    const CURRENT_URL = '<?= base_url(uri_string()); ?>'

    $(document).ready(function() {
        loadDataTable()
        getRoles()
        $('#form').validate({
            rules: {
                user_name: {
                    required: true,
                    minlength: 6,
                    maxlength: 50
                },
                user_email: {
                    required: true,
                    email: true,
                    minlength: 3,
                    maxlength: 50
                },
                user_password: {
                    required: true,
                    minlength: 6,
                    maxlength: 50
                },
                user_fullname: {
                    required: true
                },
                user_status: {
                    required: true
                },
                role_id: {
                    required: true
                }
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
                    $('#user_id').val(res.data.user_id)
                    $('#user_name').val(res.data.user_name)
                    $('#user_email').val(res.data.user_email)
                    $('#user_fullname').val(res.data.user_fullname)
                    $('#role_id').val(res.data.role_id).trigger('change')
                    $('#user_status').val(res.data.user_status)
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

        Swal.showLoading()
        fetch(`${CURRENT_URL}/get/${id}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(res => {
                Swal.close()
                if (res.status) {
                    $('#user_id').val(res.data.user_id)
                    $('#user_name').val(res.data.user_name)
                    $('#user_email').val(res.data.user_email)
                    $('#user_fullname').val(res.data.user_fullname)
                    $('#role_id').val(res.data.role_id).trigger('change')
                    $('#user_status').val(res.data.user_status)
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

    const getRoles = () => {
        fetch(`${BASE_URL}/master/roles/get-all`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(res => {
                if (res.status) {
                    $('#role_id').html('')
                    $('#role_id').append(`<option value="">- Select Role -</option>`)
                    res.data.forEach(element => {
                        $('#role_id').append(`<option value="${element.role_id}">${element.role_name}</option>`)
                    })
                } else {
                    swalError(res.message)
                }
            })
            .catch(error => swalError(error))
    }
</script>