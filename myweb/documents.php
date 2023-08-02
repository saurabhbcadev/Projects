<?php require_once 'includes/header.php' ?>
<div class="container-fluid">
    <p class="pagehead">Documents</p>
    <div id='hideshow'>
        <div class="row mb-3">
            <h2 class="formh"> Secure Page Please Enter Password To Visit This Page</h2>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="sb text-center" style='padding:2.5vw'>
                    <img src='img/logo.png' width="150px"><br><br>
                    <form name="protect" id="protect" method="post">
                        <label for="name" class="form-label" style="font-size:25px; color:darkblue;">Enter Password<span class="text-danger">*</span></label>
                        <input name="password" type="password" class="form-control form-control-md" id="password"><br>
                        <input type="submit" class="btn dashbtn btn-success" value=' Visit Page ' name="submit" id="submit" />
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <?php require_once 'includes/fotter.php' ?>
</div>
<script>
    $(document).ready(function() {
        $('#protect').on('submit', function(e) {
            e.preventDefault();
            if (($(' #password').val()).length == 4) {
                let pass = $("#password").val();
                $.ajax({
                    url: 'includes/secure.php',
                    type: 'POST',
                    data: {
                        password: pass,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == '0') {
                            swal({
                                title: "Error!",
                                text: 'Incorrect Password',
                                icon: "error",
                                button: "Try Again!",
                            });
                        } else {
                            $('#hideshow').html(response);
                        }
                    }
                });
            } else {
                swal({
                    title: "Error!",
                    text: 'Invalid Password',
                    icon: "info",
                    button: "Try Again!",
                });
            }
        });
    });
</script>