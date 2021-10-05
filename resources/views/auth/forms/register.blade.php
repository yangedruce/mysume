<form action="{{ url('register') }}" method="POST" id="formRegister">
    @csrf
    @include('auth.partials.input-register')
    <div class="d-flex justify-content-end">
        <a href="{{ route('login') }}" class="text-decoration-none fw-bold ff-montserrat text-dark small"><span class="me-3">Already have an account?</span>
            <x-icons.arrow></x-icons.arrow>
        </a>
    </div>
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-main btn-width mt-4 text-white" onclick="checkSubmit()"><small>Register<small></button>
    </div>
</form>