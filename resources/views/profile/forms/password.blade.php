<form action="{{ route('user-password.update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="main-container justify-content-center">

        @include('profile.partials.input-password')
        
        <div class="d-flex justify-content-center align-items-center mt-5 flex-column flex-md-row">
            <button type="submit" class="btn btn-main btn-width m-2 text-white"><small>Update</small></button>
            <a href="{{ route('profile.edit') }}" class="m-2">
                <button type="button" class="btn btn-main-blue btn-width text-blue-dark"><small>Back</small></button>
            </a>
        </div>
    </div>
</form>