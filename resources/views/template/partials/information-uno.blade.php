<div class="col-12 col-xl-8">
    <h1 class="ff-days-one text-dark mb-0">{{ $user->fullname }}</h1>
    <p class="ff-montserrat text-dark fs-5 mb-0">{{ $resume->title }}</p>
    <small class="ff-montserrat mt-3">
        <span class="text-dark">
            <x-icons.location></x-icons.location>
            {{ $user->location }}
        </span>
        <br><br>
        <span class="text-grey-dark text-12">
            <x-icons.phone></x-icons.phone>
            {{ $user->phone_no }}
        </span>
        <br>
        <span class="text-grey-dark text-12">
            <x-icons.email></x-icons.email>
            {{ $user->email }}
        </span>
        <br>
        <span class="text-grey-dark text-12">
            <x-icons.website></x-icons.website>
            {{ $user->website }}
        </span>
    </small>
</div>