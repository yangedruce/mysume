<form action="{{ route('logout') }}" method="POST">
    @csrf
    <div class="text-center py-3">
        <button class="btn border-0 bg-transparent fw-bold ff-montserrat text-dark">
            <small>Return to main page</small>
        </button>
    </div>
</form>