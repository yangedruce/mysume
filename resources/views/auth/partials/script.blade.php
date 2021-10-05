<script>
    // to check existing username and compare before can register
    function checkUsername() {
        $.ajax({
            type: "GET",
            url: '{{ route("user.check-username") }}',
            data: {'username': $('#userName').val()},
            success: function(response)
            {
                if(response) {
                    $('#usernameExist').removeClass('d-none');
                    $('#userName').val('');
                }else {
                    $('#usernameExist').addClass('d-none');
                }
            }
        });
    }

    function checkSubmit() {
        $('#loading').removeClass('d-none');
        $.ajax({
            type: "GET",
            url: '{{ route("user.check-username") }}',
            data: {'username': $('#userName').val()},
            success: function(response)
            {
                if(response) {
                    $('#usernameExist').removeClass('d-none');
                    $('#userName').val('');
                    $('#loading').addClass('d-none');
                }else {
                    $('#usernameExist').addClass('d-none');
                    $('#formRegister').submit();
                }
            }
        });
    }
</script>