@if(count($errors) > 0)
    <ul class="py-3">
        @foreach($errors->all() as $message)
            <li class="fw-bold alert alert-danger ff-montserrat small">{{ $message }}</li>
        @endforeach
    </ul>
@endif