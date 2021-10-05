@if(count($errors) > 0)
    <ul>
        @foreach($errors->all() as $message)
            <li class="fw-bold alert alert-danger ff-montserrat small">{{ $message }}</li>
        @endforeach
    </ul>
@endif