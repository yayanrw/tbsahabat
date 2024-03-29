<script>
    const BASE_URL = "<?= base_url() ?>";
    const CURRENT_URL = "<?= base_url(uri_string()); ?>";

    $(document).ready(function() {
        loadDataTable()
        $('#form').validate({
            rules: {
                role_name: {
                    required: true,
                },
                role_status: {
                    required: true,
                },
                redirect_to: {
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
                    $('#role_id').val(res.data.role_id)
                    $('#role_name').val(res.data.role_name)
                    $('#role_status').val(res.data.role_status)
                    $('#redirect_to').val(res.data.redirect_to)
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
                console.log(res);
                Swal.close()
                if (res.status) {
                    $('#role_id').val(res.data.role_id)
                    $('#role_name').val(res.data.role_name)
                    $('#role_status').val(res.data.role_status)
                    $('#redirect_to').val(res.data.redirect_to)
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