<form action="{{ url('login') }}" method="POST" class="main-container">
    @csrf
    @include('auth.partials.input-login')
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-main-purple-light-2 btn-width text-white"><small>Login</small></button>
    </div>
    <div class="d-flex justify-content-center py-4">
        <a href="{{ route('register') }}" class="text-decoration-none text-blue-light ff-montserrat fw-bold small">Do not have an account yet? Register now!</a>
    </div>
</form>