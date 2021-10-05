<form action="{{ route('password.update') }}" method="POST" class="main-container">
    @csrf
    @include('auth.partials.input-reset')
    <div class="d-flex justify-content-end">
        <a href="{{ route('login') }}" class="text-decoration-none fw-bold ff-montserrat text-blue-light small"><span class="me-3">Return to login</span>
            <x-icons.arrow></x-icons.arrow>
        </a>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <button type="submit" class="btn btn-main-purple-light-2 btn-width text-white"><small>Reset Password</small></button>
    </div>
</form>