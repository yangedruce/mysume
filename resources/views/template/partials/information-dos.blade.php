<div class="m-3 pb-3">
    <h1 class="ff-kaisei text-blue-light mb-0">{{ $user->fullname }}</h1>
    <p class="ff-roboto-mono fw-bold text-white fs-5 mb-0">{{ $resume->title }}</p>
    <small class="mt-3">
        <span class="ff-roboto text-white">
            <x-icons.location></x-icons.location>
            {{ $user->location }}
        </span>
        <br><br>
        <span class="ff-roboto-mono text-blue-light text-12">
            <x-icons.phone></x-icons.phone>
            {{ $user->phone_no }}
        </span>
        <br>
        <span class="ff-roboto-mono text-blue-light text-12">
            <x-icons.email></x-icons.email>
            {{ $user->email }}
        </span>
        <br>
        <span class="ff-roboto-mono text-blue-light text-12">
            <x-icons.website></x-icons.website>
            {{ $user->website }}
        </span>
    </small>
</div>