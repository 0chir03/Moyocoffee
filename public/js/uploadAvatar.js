$(document).ready(function() {
    $('#avatarForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '/api/avatar',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json'
            },
            success: function(response) {
                alert('Avatar uploaded successfully');
                // Обновить отображение аватара
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    });
});
