<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title><?= APPS_NAME ?><?= !empty($titleName) ? ' • ' . $titleName : '' ?></title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/perfectscroll/perfect-scrollbar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/pace/pace.css') ?>" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="<?= base_url('assets/css/main.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/horizontal-menu/horizontal-menu.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/images/neptune.png') ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/neptune.png') ?>" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') ?>"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js') ?>"></script>
    <![endif]-->
</head>

<body>
    <div class="app horizontal-menu app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <form id="frm_login" class="text-left">
            <div class="app-auth-container">
                <div class="logo">
                    <a href="index.html"><?= APPS_NAME ?></a>
                </div>
                <p class="auth-description">Please sign-in to your account and continue to the dashboard.</p>

                <div class="auth-credentials m-b-xxl">
                    <label for="user_id" class="form-label">Username / Email</label>
                    <input type="text" class="form-control m-b-md" id="user_id" name="user_id" aria-describedby="user_id" placeholder="example@msglowid.com">

                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password" aria-describedby="user_password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                </div>

                <div class="auth-submit">
                    <button id="btn_submit" type="submit" class="btn btn-primary">Sign In</button>
                </div>
                <div class="divider"></div>
            </div>
        </form>
    </div>

    <!-- Javascripts -->
    <script src="<?= base_url('assets/plugins/jquery/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/perfectscroll/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/pace/pace.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.min.js') ?>"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>

    <script>
        $('#frm_login').on('submit', function(e) {
            e.preventDefault();
            loading(true)
            $.ajax({
                url: '<?= base_url('auth/user'); ?>',
                type: "POST",
                data: $('#frm_login').serialize(),
                dataType: "JSON",
                success: function(result) {
                    loading(false)
                    if (result.status) {
                        window.location = result.redirect_to;
                    } else {
                        swalError(result.messages)
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    loading(false)
                    swalError(ERROR_WARN)
                }
            });
        })

        loading = (status) => {
            if (status) {
                $('#btn_submit').text('Loading...')
                $('#btn_submit').prop('disabled', true)
            } else {
                $('#btn_submit').text('Log In')
                $('#btn_submit').prop('disabled', false)
            }
        }
    </script>
</body>

</html>