<script>
    // Profile picture
    $(document).ready(function() {
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.profile-avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".img-upload").on('change', function() {
            readURL(this);
        });
        
        $(".upload-button").on('click', function() {
            $(".img-upload").click();
        });
    });

    // to check existing username and compare before can save/changing
    function checkUsername() {
        $.ajax({
            type: "GET",
            url: '{{ route("user.check-username-profile") }}',
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
            url: '{{ route("user.check-username-profile") }}',
            data: {'username': $('#userName').val()},
            success: function(response)
            {
                if(response) {
                    $('#usernameExist').removeClass('d-none');
                    $('#userName').val('');
                    $('#loading').addClass('d-none');
                }else {
                    $('#usernameExist').addClass('d-none');
                    $('#formText').submit();
                }
            }
        });
    }
</script>