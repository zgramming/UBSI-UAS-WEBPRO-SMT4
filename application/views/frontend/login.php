<!doctype html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Login Warga</title>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /*
 * Globals
 */


        /* Custom default button */
        .btn-secondary,
        .btn-secondary:hover,
        .btn-secondary:focus {
            color: #333;
            text-shadow: none;
            /* Prevent inheritance from `body` */
        }


        /*
 * Base structure
 */



        .cover-container {
            max-width: 42em;
        }


        /*
 * Header
 */

        .nav-masthead .nav-link {
            padding: .25rem 0;
            font-weight: 700;
            color: rgba(255, 255, 255, .5);
            background-color: transparent;
            border-bottom: .25rem solid transparent;
        }

        .nav-masthead .nav-link:hover,
        .nav-masthead .nav-link:focus {
            border-bottom-color: rgba(255, 255, 255, .25);
        }

        .nav-masthead .nav-link+.nav-link {
            margin-left: 1rem;
        }

        .nav-masthead .active {
            color: #fff;
            border-bottom-color: #fff;
        }
    </style>
    <?php $this->load->view('template/frontend/php_js'); ?>

</head>

<body class="d-flex h-100 text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

        <main class="px-3 my-auto">
            <h1 class="text-center my-5">Pembagian Daging Online</h1>
            <small class="mb-5 fw-lighter">Diharapkan untuk mengisi NIK dan password untuk melanjutkan ke proses selanjutnya</small>

            <div class="row">
                <div class="col-md-12 ">
                    <form method="post" id="form_login">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" name="nik" class="form-control" id="nik" maxlength="16" onkeyup="cekPhone(this)">
                            <div class="form-text">Harap pastikan input NIK dengan benar</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary w-100" id="buttonLogin">Login</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>

        <footer class="mt-auto text-white-50">
            <p class="text-center">UAS Web Programming <?= getTanggal(date('Y-m-d')) ?> @BagiDagingOnline</p>
        </footer>
    </div>

</body>
<script>
    $(document).ready(function(e) {
        $("#buttonLogin").on("click", function(e) {
            e.preventDefault();
            let data = $("#form_login").serialize();
            let url = '<?= base_url('home/login') ?>';
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(response) {
                    let result = $.parseJSON(response);
                    Swal.fire({
                        title: result.message,
                        icon: "success",
                        confirmButtonText: 'Ok'
                    }).then((_) => {
                        window.location.href = result.redirect_url;
                    });

                },
                error: function(response) {
                    var jsonError = $.parseJSON(response.responseText);

                    Swal.fire({
                        title: jsonError.message,
                        icon: "error"
                    });
                },
            });

        });
    });
</script>


</html>