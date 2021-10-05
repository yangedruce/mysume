{{-- messages/alerts --}}
@if($errors->hasBag('updatePassword'))
    <ul>
        @foreach ($errors->updatePassword->all() as $message)
            <li class="fw-bold alert alert-danger ff-montserrat small">{{ $message }}</li>
        @endforeach
    </ul>
@endif   