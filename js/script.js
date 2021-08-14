$(function () {
    $('#login-form-link').click(function (e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function (e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-password, #confirm_password').on('keyup', function () {
        if ($('#register-password').val().length > 0) {
            if ($('#register-password').val() == $('#confirm_password').val()) {
                $('#password-matching-message').html('Matching').css('color', 'green');
                $('#register-submit').prop('disabled', false);
            } else {
                $('#password-matching-message').html('Not Matching').css('color', 'red');
                $('#register-submit').prop('disabled', true);
            }
        }
    });
    $('#login-submit').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "auth/verify-login.php",// your username checker url
            type: "POST",
            datatype: "JSON",
            data: {
                "login-email": $('#login-email').val(),
                "login-password": $('#login-password').val()
            },
            encode: true,
        }).done(function (data) {
            $('#login-user-not-found').html("");
            $('#login-incorrect-password').html("");
            data = JSON.parse(data)
            console.log(data);
            if (!data.success) {
                if (data.errors.username) {
                    $('#login-user-not-found').html('Incorrect Username').css('color', 'red');
                }
                if (data.errors.password) {
                    $('#login-incorrect-password').html('Incorrect Password').css('color', 'red');
                }
                if (!data.errors.isActive) {
                    $('#disabled-user-message').html('User is Disabled').css('color', 'red');
                }
            } else {
                $("#login-form").submit();
            }
        });
    });
    $('#register-submit').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "auth/verify-new-register.php",// your username checker url
            type: "POST",
            datatype: "JSON",
            data: {
                "register-email": $('#register-email').val()
            },
            encode: true,
        }).done(function (data) {
            $('#register-email-already-exists').html("");
            data = JSON.parse(data)
            console.log(data);
            if (!data.success) {
                if (data.errors.user_found) {
                    $('#register-email-already-exists').html("User Already Exists. Please Try Again").css('color', 'red');
                }
            } else {
                $("#register-form").submit();
            }
        });
    });
    /* ---------------------- INDEX REGISTER FORM */
    $('.form-user').show();
    $('.form-company').hide();
    $('#status').change(function () {
        var selected = $('#status option:selected').text();
        console.log("selected: " + selected);
        if ($('#status option:selected').text() == "Job-seeker") {
            $('.form-company').hide();
            $('.form-group').show();
            $('.form-user').show();
        } else if ($('#status option:selected').text() == "Company") {
            $('.form-user').hide();
            $('.form-group').show();
            $('.form-company').show();
        }
    });
});
