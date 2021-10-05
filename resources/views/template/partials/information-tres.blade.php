<div class="col-12">
    <h1 class="ff-kaisei text-blue-dark mb-0">{{ $user->fullname }}</h1>
    <p class="ff-roboto-mono fw-bold text-dark fs-5 mb-0">{{ $resume->title }}</p>
</div>
<div class="col-12">
    <div class="d-flex flex-column flex-lg-row mt-3">
        <div class="me-5">
            <small class="ff-roboto text-dark">
                <x-icons.location></x-icons.location>
                {{ $user->location }}
            </small>
        </div>
        <div class="me-5">
            <small class="ff-roboto text-dark">
                <x-icons.phone></x-icons.phone>
                {{ $user->phone_no }}
            </small>
        </div>
        <div class="me-5">
            <small class="ff-roboto text-dark">
                <x-icons.email></x-icons.email>
                {{ $user->email }}
            </small>
        </div>
        <div class="me-5">
            <small class="ff-roboto text-dark">
                <x-icons.website></x-icons.website>
                {{ $user->website }}
            </small>
        </div>
    </div>
</div>