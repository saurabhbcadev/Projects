$(document).ready(function () {
    if ($('body').find('table').length > 0) {
        new DataTable('table');
    }
    $('.spin').hide();
    $('#enquiry').on('submit', function (e) {
        e.preventDefault();
        let name = $('#enq_name').val();
        let mobile = $('#enq_mobile').val();
        let message = $('#enq_message').val();
        if ((validateName(name) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Name!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validateIndianMobileNumber(mobile) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Mobile Number!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validateMSG(message) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Message!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else {
            $.ajax({
                url: 'includes/bpms_function.php',
                type: 'POST',
                data: {
                    'type': 'enquiry',
                    'name': name,
                    'mobile': mobile,
                    'message': message,
                },
                success: function (response) {
                    if (response == '1') {
                        $('#enquiry').trigger('reset');
                        swal({
                            title: "Successful",
                            text: "Enquiry Sent Successfully. We will contact you shortly",
                            icon: "success",
                            button: "Close",
                        });
                    }
                    else {
                        swal({
                            title: "Error!",
                            text: "Unknown Error!",
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                }
            });
        }
    });
    $('#bookapp').on('submit', function (e) {
        e.preventDefault();
        let date = $("#badate").val();
        let time = $('#batime').val();
        if ($(".bind input[type='checkbox']:checked").length === 0) {
            swal({
                title: "Error!",
                text: "Please Select at least one service!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if (validateDateTime(date, time) == false) {
            swal({
                title: "Error!",
                text: "Please Select correct date and time",
                icon: "info",
                button: "Try Again!",
            });
        }
        else {
            let serializedData = $(this).serialize();
            $.ajax({
                url: 'includes/bpms_function.php',
                type: 'POST',
                data: serializedData,
                success: function (response) {
                    if (response == '1') {
                        swal({
                            title: "Error!",
                            text: "Unknown Error!",
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                    else if (response == '2') {
                        swal({
                            title: "Error!",
                            text: 'Sorry! You Cannot Book More Than One Appointment On The Same Day, Go To The Appointment History To Update Your Appointment',
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                    else {
                        swal({
                            title: "Successful",
                            text: response,
                            icon: "success",
                            button: "Close",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then((value) => {
                            if (value) {
                                window.location.href = "user/userapp.php";
                            }
                        });
                    }
                }
            });
        }
    });
    if ($('div').hasClass('signup')) {
        $.ajax({
            url: 'includes/bpms_function.php',
            type: "POST",
            data: {
                type: 'state'
            },
            cache: false,
            success: function (result) {
                $(".signup #state").html(result);
            }
        });
    }
    $('.signup #state').on('change', function () {
        var state_id = this.value;
        $.ajax({
            url: 'includes/bpms_function.php',
            type: "POST",
            data: {
                type: 'city',
                state_id: state_id
            },
            cache: false,
            success: function (result) {
                $(".signup #city").html(result);
            }
        });
    });
    $('#signup').on('submit', function (e) {
        e.preventDefault();
        if ((validateName($('.signup #name').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Name!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validateName($('.signup #gardian').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Father's / Husband's Name!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validateAge($('.signup #age').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Age!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validateEmail($('.signup #email').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Email!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validateIndianMobileNumber($('.signup #mobile').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Mobile Number!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validateAddress($('.signup #address').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Address!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if (($('.signup #state').val() == '0')) {
            swal({
                title: "Error!",
                text: "Select State!",
                icon: "info",
                button: "Try Again!",
            });
        } else if (($('.signup #city').val() == '0')) {
            swal({
                title: "Error!",
                text: "Select City!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatePassword($('.signup #password').val(), $('.signup #cpassword').val()) == '0')) {
            swal({
                title: "Error!",
                text: "Invalid Password!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatePassword($('.signup #password').val(), $('.signup #cpassword').val()) == '2')) {
            swal({
                title: "Error!",
                text: "Password And Confirm Password Not Matched!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else {
            let serializedData = $(this).serialize();
            $.ajax({
                url: 'includes/bpms_function.php',
                type: 'POST',
                data: serializedData,
                success: function (response) {
                    if (response == '1') {
                        swal({
                            title: "Successful",
                            text: 'Account Created Succesfully',
                            icon: "success",
                            button: "Go to the Dashboard",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then((value) => {
                            if (value) {
                                window.location.href = "user/userdash.php";
                            }
                        });
                    }
                    else {
                        swal({
                            title: "Error!",
                            text: response,
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                }
            });
        }
    });
    $('#login').on('submit', function (e) {
        e.preventDefault();
        if ((validateIndianMobileNumber($('.login #mobile').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Mobile Number!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatePassword1($('.login #password').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Password!",
                icon: "info",
                button: "Try Again!",
            });
        } else {
            let serializedData = $(this).serialize();
            $.ajax({
                url: 'includes/bpms_function.php',
                type: 'POST',
                data: serializedData,
                success: function (response) {
                    if (response == '1') {
                        window.location.href = "user/userdash.php";
                    }
                    else {
                        swal({
                            title: "Error!",
                            text: response,
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                }
            });
        }
    });
    $('#alogin').on('submit', function (e) {
        e.preventDefault();
        if ((validateIndianMobileNumber($('.alogin #adminid').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Admin Id!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatePassword1($('.alogin #password').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Password!",
                icon: "info",
                button: "Try Again!",
            });
        } else {
            let serializedData = $(this).serialize();
            $.ajax({
                url: 'includes/bpms_function.php',
                type: 'POST',
                data: serializedData,
                success: function (response) {
                    if (response == '1') {
                        window.location.href = "admin/admindash.php";
                    }
                    else {
                        swal({
                            title: "Error!",
                            text: response,
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                }
            });
        }
    });
    $(document).on('click', '#logout', function (e) {
        e.preventDefault();
        myalert('Are you sure want to logout?').then((result) => {
            if (result == '1') {
                $.ajax({
                    url: '../includes/bpms_function.php',
                    type: 'POST',
                    data: { type: 'logout' },
                    success: () => {
                        window.location.href = "../index.php";
                    }
                });
            }
        });
    });
    $(document).on('click', '#udelete', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        myalert('Are you sure want to Delete Account?').then((result) => {
            if (result == '1') {
                $.ajax({
                    url: '../includes/bpms_function.php',
                    type: 'POST',
                    data: {
                        type: 'udelete',
                        userid: id,
                    },
                    success: function (response) {
                        if (response == '1') {
                            swal({
                                title: "Successful",
                                text: 'Account Deleted Succesfully',
                                icon: "success",
                                button: "Close",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then((value) => {
                                if (value) {
                                    window.location.href = "../index.php";
                                }
                            });
                        }
                        else {
                            swal({
                                title: "Error!",
                                text: response,
                                icon: "error",
                                button: "Try Again!",
                            });
                        }
                    }
                });
            }
        });
    });
    $(document).on('click', '#updateuserbtn', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../includes/bpms_function.php',
            type: "POST",
            data: {
                type: 'state'
            },
            cache: false,
            success: function (result) {
                $(".updateuser #state").html(result);
            }
        });
        $.ajax({
            url: '../includes/bpms_function.php',
            type: 'POST',
            data: { type: 'getuserdata' },
            success: function (response) {
                let userdata = JSON.parse(response);
                $('.updateuser #name').val(userdata['name']);
                $('.updateuser #email').val(userdata['email']);
                $('.updateuser #mobile').val(userdata['mobile']);
                $('.updateuser #gardian').val(userdata['gardian']);
                $('.updateuser #age').val(userdata['age']);
                $('.updateuser #address').val(userdata['address']);
                $('.updateuser #state option').each(function () {
                    if ($(this).val() == userdata['state']) {
                        $(this).attr('selected', 'selected');
                        let state = $(this).val();
                        $.ajax({
                            url: '../includes/bpms_function.php',
                            type: "POST",
                            data: {
                                type: 'city',
                                state_id: state
                            },
                            cache: false,
                            success: function (result) {
                                $(".updateuser #city").html(result);
                                $('.updateuser #city option').each(function () {
                                    if ($(this).val() == userdata['city']) {
                                        $(this).attr('selected', 'selected');
                                    }
                                });
                            }
                        });
                    }
                });
            }
        });
    });
    $('.updateuser #state').on('change', function () {
        var state_id = this.value;
        $.ajax({
            url: '../includes/bpms_function.php',
            type: "POST",
            data: {
                type: 'city',
                state_id: state_id
            },
            cache: false,
            success: function (result) {
                $(".updateuser #city").html(result);
            }
        });
    });
    $('#updateuser').on('submit', function (e) {
        e.preventDefault();
        if (validateName($('.updateuser #name').val()) == false) {
            swal({
                title: "Error!",
                text: "Invalid Name!",
                icon: "info",
                button: "Try Again!",
            });
        } else if (validateName($('.updateuser #gardian').val()) == false) {
            swal({
                title: "Error!",
                text: "Invalid Father's / Husband's Name!",
                icon: "info",
                button: "Try Again!",
            });
        } else if (validateAge($('.updateuser #age').val()) == false) {
            swal({
                title: "Error!",
                text: "Invalid Age!",
                icon: "info",
                button: "Try Again!",
            });
        } else if (validateEmail($('.updateuser #email').val()) == false) {
            swal({
                title: "Error!",
                text: "Invalid Email!",
                icon: "info",
                button: "Try Again!",
            });
        } else if (validateIndianMobileNumber($('.updateuser #mobile').val()) == false) {
            swal({
                title: "Error!",
                text: "Invalid Mobile Number!",
                icon: "info",
                button: "Try Again!",
            });
        } else if (validateAddress($('.updateuser #address').val()) == false) {
            swal({
                title: "Error!",
                text: "Invalid Address!",
                icon: "info",
                button: "Try Again!",
            });
        } else if ($('.updateuser #state').val() == '0') {
            swal({
                title: "Error!",
                text: "Select State!",
                icon: "info",
                button: "Try Again!",
            });
        } else if ($('.updateuser #city').val() == '0') {
            swal({
                title: "Error!",
                text: "Select City!",
                icon: "info",
                button: "Try Again!",
            });
        } else {
            let serializedData = $(this).serialize();
            $.ajax({
                url: '../includes/bpms_function.php',
                type: 'POST',
                data: serializedData,
                success: function (response) {
                    if (response == '1') {
                        swal({
                            title: "Successful",
                            text: 'Account Updated Succesfully',
                            icon: "success",
                            button: "Close",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then((value) => {
                            if (value) {
                                location.reload();
                            }
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: response,
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                }
            });
        }
    });
    $("#changeuserpass").on("submit", function (e) {
        e.preventDefault();
        if (($('.changeuserpass #opass').val()).length < 4) {
            swal({
                title: "Error!",
                text: 'Invalid Old Password',
                icon: "info",
                button: "Try Again!",
            });
        } else if ((validatePassword($('.changeuserpass #npass').val(), $('.changeuserpass #cpass').val()) == '0')) {
            swal({
                title: "Error!",
                text: "Invalid New Password!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatePassword($('.changeuserpass #npass').val(), $('.changeuserpass #cpass').val()) == '2')) {
            swal({
                title: "Error!",
                text: "New Password And Confirm New Password Not Matched!",
                icon: "info",
                button: "Try Again!",
            });
        } else if ($('.changeuserpass #opass').val() == $('.changeuserpass #npass').val()) {
            swal({
                title: "Error!",
                text: "New Password And Old Password Cannot Be Same!",
                icon: "info",
                button: "Try Again!",
            });
        } else {
            let serializedData = $(this).serialize();
            $.ajax({
                url: '../includes/bpms_function.php',
                type: 'POST',
                data: serializedData,
                success: function (response) {
                    if (response == '1') {
                        swal({
                            title: "Successful",
                            text: 'Password Changed Succesfully',
                            icon: "success",
                            button: "Close",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then((value) => {
                            if (value) {
                                $('#changeuserpass').trigger('reset');
                                $("#model_changeuserpass #closebtn").click();
                            }
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: response,
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                }
            });
        }
    });
    $(document).on('click', '.deleteappbtn', function (e) {
        let appid = $(this).attr('data-id');
        myalert('Are you sure want to Delete Appointment?').then((result) => {
            if (result == '1') {
                $.ajax({
                    url: '../includes/bpms_function.php',
                    type: 'POST',
                    data: {
                        type: 'dltapp',
                        appid: appid,
                    },
                    success: function (response) {
                        if (response == '1') {
                            swal({
                                title: "Successful",
                                text: 'Appointment Deleted Succesfully',
                                icon: "success",
                                button: "Close",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then((value) => {
                                if (value) {
                                    location.reload();
                                }
                            });
                        }
                        else {
                            swal({
                                title: "Error!",
                                text: response,
                                icon: "error",
                                button: "Try Again!",
                            });
                        }
                    }
                });
            }
        });
    });
    $(document).on('click', '.updateappbtn', function (e) {
        $('#updateapp').trigger('reset');
        let appno = $(this).attr('data-id');
        $('.updateapp #appno').attr('value', appno);
        $.ajax({
            url: '../includes/bpms_function.php',
            type: 'POST',
            data: {
                type: 'getapp',
                appno: appno,
            },
            success: function (response) {
                let appdata = JSON.parse(response);
                $('.updateapp #date').attr('value', appdata['date']);
                $('.updateapp #time').attr('value', appdata['time']);
                $('.updateapp #pdate').attr('value', appdata['date']);
                $('.updateapp #userid').attr('value', appdata['userid']);
                let services = appdata['services'];
                let serviceList = services.split(',').map(function (service) {
                    return service.trim();
                });
                $('#servicesContainer input[type="checkbox"]').each(function () {
                    let checkboxValue = $(this).val();
                    checkboxValue = checkboxValue.split('|')[0];
                    if (serviceList.includes(checkboxValue)) {
                        $(this).prop('checked', true);
                    }
                });
            },
        });
    });
    $('#updateapp').on('submit', function (e) {
        e.preventDefault();
        let date = $(".updateapp #date").val();
        let time = $('.updateapp #time').val();
        if ($(".bind input[type='checkbox']:checked").length === 0) {
            swal({
                title: "Error!",
                text: "Please Select at least one service!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if (validateDateTime(date, time) == false) {
            swal({
                title: "Error!",
                text: "Please Select correct date and time",
                icon: "info",
                button: "Try Again!",
            });
        }
        else {
            let serializedData = $(this).serialize();
            $.ajax({
                url: '../includes/bpms_function.php',
                type: 'POST',
                data: serializedData,
                success: function (response) {
                    if (response == '1') {
                        swal({
                            title: "Error!",
                            text: "Unknown Error!",
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                    else if (response == '2') {
                        swal({
                            title: "Error!",
                            text: 'Sorry! Another Appointment Booked On The Same Day',
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                    else {
                        swal({
                            title: "Successful",
                            text: response,
                            icon: "success",
                            button: "Close",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then((value) => {
                            if (value) {
                                location.reload();
                            }
                        });
                    }
                }
            });
        }
    });
    $("#changeadminpass").on("submit", function (e) {
        e.preventDefault();
        if (($('.changeadminpass #opass').val()).length < 4) {
            swal({
                title: "Error!",
                text: 'Invalid Old Password',
                icon: "info",
                button: "Try Again!",
            });
        } else if ((validatePassword($('.changeadminpass #npass').val(), $('.changeadminpass #cpass').val()) == '0')) {
            swal({
                title: "Error!",
                text: "Invalid New Password!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatePassword($('.changeadminpass #npass').val(), $('.changeadminpass #cpass').val()) == '2')) {
            swal({
                title: "Error!",
                text: "New Password And Confirm New Password Not Matched!",
                icon: "info",
                button: "Try Again!",
            });
        } else if ($('.changeadminpass #opass').val() == $('.changeadminpass #npass').val()) {
            swal({
                title: "Error!",
                text: "New Password And Old Password Cannot Be Same!",
                icon: "info",
                button: "Try Again!",
            });
        } else {
            let serializedData = $(this).serialize();
            $.ajax({
                url: '../includes/bpms_function.php',
                type: 'POST',
                data: serializedData,
                success: function (response) {
                    if (response == '1') {
                        swal({
                            title: "Successful",
                            text: 'Password Changed Succesfully',
                            icon: "success",
                            button: "Close",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then((value) => {
                            if (value) {
                                $('#changeadminpass').trigger('reset');
                                $("#model_changeadminpass #closebtn").click();
                            }
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: response,
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                }
            });
        }
    });
    $(document).on('click', '.deleteenqbtn', function (e) {
        let enqid = $(this).attr('data-id');
        myalert('Are you sure want to Delete Appointment?').then((result) => {
            if (result == '1') {
                $.ajax({
                    url: '../includes/bpms_function.php',
                    type: 'POST',
                    data: {
                        type: 'dltenq',
                        enqno: enqid,
                    },
                    success: function (response) {
                        if (response == '1') {
                            swal({
                                title: "Successful",
                                text: 'Enquiry Deleted Succesfully',
                                icon: "success",
                                button: "Close",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then((value) => {
                                if (value) {
                                    location.reload();
                                }
                            });
                        }
                        else {
                            swal({
                                title: "Error!",
                                text: response,
                                icon: "error",
                                button: "Try Again!",
                            });
                        }
                    }
                });
            }
        });
    });
    $(document).on('click', '.dltuserbton', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        myalert('Are you sure want to Delete Account?').then((result) => {
            if (result == '1') {
                $.ajax({
                    url: '../includes/bpms_function.php',
                    type: 'POST',
                    data: {
                        type: 'udelete',
                        userid: id,
                    },
                    success: function (response) {
                        if (response == '1') {
                            swal({
                                title: "Successful",
                                text: 'Account Deleted Succesfully',
                                icon: "success",
                                button: "Close",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then((value) => {
                                if (value) {
                                    location.reload();
                                }
                            });
                        }
                        else {
                            swal({
                                title: "Error!",
                                text: response,
                                icon: "error",
                                button: "Try Again!",
                            });
                        }
                    }
                });
            }
        });
    });
    $(document).on('click', '.selectappbtn', function (e) {
        e.preventDefault();
        let appno = $(this).attr('data-id');
        $.ajax({
            url: '../includes/bpms_function.php',
            type: 'POST',
            data: {
                type: 'selectapp',
                appno: appno,
            },
            success: function (response) {
                if (response == '1') {
                    swal({
                        title: "Selected",
                        icon: "success",
                        button: "Close",
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                    }).then((value) => {
                        if (value) {
                            location.reload();
                        }
                    });
                }
                else {
                    swal({
                        title: "Error!",
                        text: response,
                        icon: "error",
                        button: "Try Again!",
                    });
                }
            }
        });
    });
    $(document).on('click', '.rejectappbtn', function (e) {
        e.preventDefault();
        let appno = $(this).attr('data-id');
        $.ajax({
            url: '../includes/bpms_function.php',
            type: 'POST',
            data: {
                type: 'rejectapp',
                appno: appno,
            },
            success: function (response) {
                if (response == '1') {
                    swal({
                        title: "Rejected",
                        icon: "error",
                        button: "Close",
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                    }).then((value) => {
                        if (value) {
                            location.reload();
                        }
                    });
                }
                else {
                    swal({
                        title: "Error!",
                        text: response,
                        icon: "error",
                        button: "Try Again!",
                    });
                }
            }
        });
    });
    // $(document).on('click', '.invoicebtn', function(e) {
    //     e.preventDefault();
    //     let appno = $(this).attr('data-id');
    //     $.ajax({
    //         url: 'invoice.php',
    //         type: 'POST',
    //         data: {
    //             appno: appno,
    //         },
    //         success: function (response) {
    //             swal({
    //                 title: "Download Started",
    //                 icon: "success",
    //                 button: "Close",
    //             });
    //         }
    //     });
    // });
    $('#addgallery').on('submit', function (e) {
        e.preventDefault();
        if ($('.addgallery #imgaddgallery').get(0).files.length === 0) {
            swal({
                title: "Error!",
                text: "Select Image!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else {
            $(".addgallery .spin").show();
            let form = $(this);
            let formData = new FormData(form[0]);
            $.ajax({
                url: '../includes/bpms_function.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response == '1') {
                        swal({
                            title: "Successful!",
                            text: "Images Added Successfully",
                            icon: "success",
                            button: "Close",
                        });
                        $("#addgallery").trigger('reset');
                        $('#model_addgallery #closebtn').click();
                    }
                    else if (response == '2') {
                        swal({
                            title: "Error!",
                            text: "Please Select Images Less Than 1MB Size",
                            icon: "error",
                            button: "Try Again",
                        });
                    }
                    else {
                        swal({
                            title: "Error!",
                            text: response,
                            icon: "error",
                            button: "Try Again",
                        });
                    }
                    $(".addgallery .spin").hide();
                }
            });
        }
    });
    $(document).on('click', '#btneditgallery', function (e) {
        e.preventDefault();
        editgallery();
    })
    $(document).on('click', '.dltimg', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        myalert('Are you sure want to Delete This Image?').then((result) => {
            if (result == '1') {
                $.ajax({
                    url: '../includes/bpms_function.php',
                    type: 'POST',
                    data: {
                        type: 'dltimg',
                        id: id,
                    },
                    success: function (response) {
                        if (response == '1') {
                            swal({
                                title: "Successful",
                                text: 'Image Deleted Succesfully',
                                icon: "success",
                                button: "Close",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then((value) => {
                                if (value) {
                                    editgallery();
                                }
                            });
                        }
                        else {
                            swal({
                                title: "Error!",
                                text: response,
                                icon: "error",
                                button: "Try Again!",
                            });
                        }
                    }
                });
            }
        })
    })
    $('#addservice').on('submit', function (e) {
        e.preventDefault();
        if ($('.addservice #imgaddservice').get(0).files.length === 0) {
            swal({
                title: "Error!",
                text: "Select Image!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatetitle($('.addservice #title').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Title Length!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatedesc($('.addservice #description').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Description Length!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatePrice($('.addservice #price').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Price (10 > Price < 2000)!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else {
            $(".addservice .spin").show();
            let form = $(this);
            let formData = new FormData(form[0]);
            $.ajax({
                url: '../includes/bpms_function.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response == '1') {
                        swal({
                            title: "Successful!",
                            text: "Service Added Successfully",
                            icon: "success",
                            button: "Close",
                        });
                        $("#addservice").trigger('reset');
                        $('#model_addservice #closebtn').click();
                    }
                    else if (response == '2') {
                        swal({
                            title: "Error!",
                            text: "Please Select Images Less Than 1MB Size",
                            icon: "error",
                            button: "Try Again",
                        });
                    }
                    else {
                        swal({
                            title: "Error!",
                            text: response,
                            icon: "error",
                            button: "Try Again",
                        });
                    }
                    $(".addservice .spin").hide();
                }
            });
        }
    });
    $(document).on('click', '#btneditservice', function (e) {
        e.preventDefault();
        editservice();
    })
    $(document).on('click', '.deleteservicebtn', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        myalert('Are you sure want to Delete This Service?').then((result) => {
            if (result == '1') {
                $.ajax({
                    url: '../includes/bpms_function.php',
                    type: 'POST',
                    data: {
                        type: 'deleteservice',
                        id: id,
                    },
                    success: function (response) {
                        if (response == '1') {
                            swal({
                                title: "Successful",
                                text: 'Service Deleted Succesfully',
                                icon: "success",
                                button: "Close",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then((value) => {
                                if (value) {
                                    editservice();
                                }
                            });
                        }
                        else {
                            swal({
                                title: "Error!",
                                text: response,
                                icon: "error",
                                button: "Try Again!",
                            });
                        }
                    }
                });
            }
        })
    });

    $(document).on('click', '.updateservicebtn', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: '../includes/bpms_function.php',
            type: 'POST',
            data: {
                type: 'serviceformdata',
                id: id,
            },
            success: function (response) {
                let data = JSON.parse(response);
                $('.updateservice #id').val(data['id']);
                $('.updateservice #title').val(data['title']);
                $('.updateservice #description').val(data['description']);
                $('.updateservice #price').val(data['price']);
                $('.updateservice #img').val(data['image']);
            },
        })
    });
    $('#updateservice').on('submit', function (e) {
        e.preventDefault();
        if ((validatetitle($('.updateservice #title').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Title Length!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatedesc($('.updateservice #description').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Description Length!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatePrice($('.updateservice #price').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Price (10 > Price < 2000)!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else {
            $(".updateservice .spin").show();
            let form = $(this);
            let formData = new FormData(form[0]);
            $.ajax({
                url: '../includes/bpms_function.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response == '1') {
                        swal({
                            title: "Successful!",
                            text: "Service Updated Successfully",
                            icon: "success",
                            button: "Close",
                        });
                        $("#updateservice").trigger('reset');
                        $('#model_updateservice #closebtn').click();
                        editservice();
                    }
                    else if (response == '2') {
                        swal({
                            title: "Error!",
                            text: "Please Select Images Less Than 1MB Size",
                            icon: "error",
                            button: "Try Again",
                        });
                    }
                    else {
                        swal({
                            title: "Error!",
                            text: response,
                            icon: "error",
                            button: "Try Again",
                        });
                    }
                    $(".updateservice .spin").hide();
                }
            });
        }
    });

    $('#addadmin').on('submit', function (e) {
        e.preventDefault();
        if ($('.addadmin #imgaddadmin').get(0).files.length === 0) {
            swal({
                title: "Error!",
                text: "Select Image!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validateName($('.addadmin #name').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Name!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validateIndianMobileNumber($('.addadmin #mobile').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Mobile Number!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validateName($('.addadmin #desg').val()) == false)) {
            swal({
                title: "Error!",
                text: "Invalid Designation!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatePassword($('.addadmin #pass').val(), $('.addadmin #cpass').val()) == '0')) {
            swal({
                title: "Error!",
                text: "Invalid Password!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if ((validatePassword($('.addadmin #pass').val(), $('.addadmin #cpass').val()) == '2')) {
            swal({
                title: "Error!",
                text: "Password And Confirm Password Not Matched!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else if (($('.addadmin #key').val()).length < 4) {
            swal({
                title: "Error!",
                text: "Invalid PassKey!",
                icon: "info",
                button: "Try Again!",
            });
        }
        else {
            $(".addadmin .spin").show();
            let form = $(this);
            let formData = new FormData(form[0]);
            $.ajax({
                url: '../includes/bpms_function.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response == '1') {
                        swal({
                            title: "Successful!",
                            text: "Admin Added Successfully",
                            icon: "success",
                            button: "Close",
                        });
                        $("#addadmin").trigger('reset');
                        $('#model_addadmin #closebtn').click();
                    }
                    else {
                        swal({
                            title: "Error!",
                            text: response,
                            icon: "error",
                            button: "Try Again!",
                        });
                    }
                    $(".addadmin .spin").hide();
                }
            });
        }
    });

    function editgallery() {
        $.ajax({
            url: '../includes/bpms_function.php',
            type: 'POST',
            data: {
                type: 'editgallery',
            },
            success: function (response) {
                $('.editgallery').html(response);
            },
        })
    }
    function editservice() {
        $.ajax({
            url: '../includes/bpms_function.php',
            type: 'POST',
            data: {
                type: 'editservice',
            },
            success: function (response) {
                $('.servicetable').DataTable().destroy();
                $('.addservicetab').html(response);
                new DataTable('.servicetable');
            },
        })
    }
    function validateName(name) {
        let minLength = 4;
        let maxLength = 30;
        if (name.trim() === '') {
            return false;
        }
        if (!/^[a-zA-Z\s]+$/.test(name)) {
            return false;
        }
        if (name.length < minLength || name.length > maxLength) {
            return false;
        }
        return true;
    }
    function validateIndianMobileNumber(number) {
        let firstDigit = number.charAt(0);
        if (number.length !== 10) {
            return false;
        }
        for (let i = 0; i < number.length; i++) {
            if (isNaN(number[i])) {
                return false;
            }
        }
        if (![6, 7, 8, 9].includes(parseInt(firstDigit))) {
            return false;
        }
        return true;
    }
    function validateMSG(msg) {
        let minLength = 20;
        let maxLength = 200;
        if (msg.trim() === '') {
            return false;
        }
        if (msg.length > maxLength) {
            return false;
        }
        if (msg.length < minLength) {
            return false;
        }
        return true;
    }
    function validateDateTime(selectedDate, selectedTime) {
        if (!selectedDate || !selectedTime) {
            return false;
        }
        let currentTime = new Date();
        let selectedDateTime = new Date(`${selectedDate}T${selectedTime}`);
        let isToday = selectedDateTime.toDateString() === currentTime.toDateString();
        let selectedHours = selectedDateTime.getHours();
        let isBetweenTimeRange = selectedHours >= 10 && selectedHours <= 20;
        let isFutureTime = isToday && selectedDateTime.getTime() > currentTime.getTime();
        if (!isBetweenTimeRange || (isToday && !isFutureTime)) {
            return false;
        }
        return true;
    }
    function validateAge(age) {
        if (isNaN(age) || age.length === 0 || !Number.isInteger(parseFloat(age))) {
            return false;
        }
        age = parseInt(age);
        if (age < 14 || age > 80) {
            return false;
        }
        return true;
    }
    function validateEmail(email) {
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
    function validateAddress(address) {
        let minLength = 6;
        let maxLength = 100;
        let addressLength = address.trim().length;
        return addressLength >= minLength && addressLength <= maxLength;
    }
    function validatePassword(password, confirmPassword) {
        let isPasswordLengthValid = password.length >= 4 && password.length <= 20;
        let doPasswordsMatch = password === confirmPassword;
        if (isPasswordLengthValid && doPasswordsMatch) {
            return '1';
        } else if (!isPasswordLengthValid) {
            return '0';
        } else {
            return '2';
        }
    }
    function validatePassword1(password) {
        if (password.length < 4 && password.length > 20) {
            return false;
        }
        return true;
    }
    function myalert(title) {
        return new Promise((resolve) => {
            swal({
                title: title,
                icon: '../image/ques.webp',
                buttons: {
                    confirm: {
                        text: "Yes",
                        value: true,
                        visible: true,
                        className: "red-btn",
                        closeModal: true,
                    },
                    cancel: {
                        text: "No",
                        value: false,
                        visible: true,
                        closeModal: true,
                    },
                },
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    resolve('1');
                } else {
                    resolve('0');
                }
            });
        });
    }
    function validatetitle(title) {
        if (title.length < 5 || title.length > 20) {
            return false;
        }
        return true;
    }
    function validatedesc(desc) {
        if (desc.length < 400 || desc.length > 600) {
            return false;
        }
        return true;
    }
    function validatePrice(price) {
        if (price === '' || isNaN(price)) {
            return false;
        }
        price = parseInt(price);
        if (price < 10 || price > 2000) {
            return false;
        }
        return true;
    }
});
