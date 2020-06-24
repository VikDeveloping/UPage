$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    console.log(window.location.href.indexOf('#loginModal'));
    if(window.location.href.indexOf('#loginModal') != -1) {
        $('#loginModal').modal('show');
    }

    $('#login').submit(function (e) {
        e.preventDefault();
        var serialize = $(this).find('form').serialize();

        $.ajax({
            url: '/login',
            method: 'POST',
            data: serialize,
            success: function (data) {
                if (data.success){
                    document.location.href = '/cabinet';
                } else {
                    shakeModal(data);
                }
            }
        });
    });

    $('#register').submit(function (e) {
        e.preventDefault();
        var serialize = $(this).find('input').filter(function(index, element) {
            return $(element).val() != '';
        }).serialize();

        $.ajax({
            url: '/register',
            method: 'POST',
            data: serialize,
            success: function (data) {
                if (data.success){
                    document.location.href = '/cabinet';
                } else {
                    shakeModal(data);
                }
            }
        });
    });
});

function showRegisterForm() {
    $('.loginBox, #loginModal .forgetBox').fadeOut('fast', function () {
        $('.registerBox').fadeIn('fast');
        $('.forget-footer').fadeOut('fast', function () {
            //$('.login-footer').fadeIn('fast');
        });
        $('.login-footer').fadeOut('fast', function () {
            $('.register-footer').fadeIn('fast');
        });
        //$('.modal-title').html('Register with');
    });
    $('.error').removeClass('alert alert-danger').html('');
}

function showForgetForm() {
    $('.loginBox').fadeOut('fast', function () {
        $('.forgetBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast', function () {
            $('.forget-footer').fadeIn('fast');
        });
        //$('.modal-title').html('Register with');
    });
    $('.error').removeClass('alert alert-danger').html('');
}

function showLoginForm() {
    $('#loginModal .registerBox, #loginModal .forgetBox').fadeOut('fast', function () {
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast', function () {
            $('.login-footer').fadeIn('fast');
        });
        $('.forget-footer').fadeOut('fast', function () {
            //$('.login-footer').fadeIn('fast');
        });

        //$('.modal-title').children('h4').html('Авторизация');
        //  $('.modal-title').children('span').html('С помощью аккаунта в соц. сетях');
    });
    $('.error').removeClass('alert alert-danger').html('');
}

function openLoginModal(auth = null) {
    if (auth == "auth") {
        showLoginForm();
    }
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);
}
function openAccountModal() {
    showLoginForm();
    setTimeout(function () {
        $('#accountModal').modal('show');
    }, 230);
}

function openForgetModal() {
    showForgetForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);
}

function openRegisterModal() {
    showRegisterForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);

}

function shakeModal(data) {
    $('.error').empty();
    $('#loginModal .modal-dialog').addClass('shake');
    $.each(data.error, function(key, value){
        $('.error').append('<label class="text-danger">'+value+'</label>');
    });
    $('input[type="password"]').val('');
    setTimeout(function () {
        $('#loginModal .modal-dialog').removeClass('shake');
    }, 1000);
}
