$(document).ready(function() {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/api/register',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                localStorage.setItem('token', response.token);
                window.location.href = '/login';
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    });

    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/api/login',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                localStorage.setItem('token', response.token);
                window.location.href = '/avatar';
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    });
});
