<div class="form-group mt-4 mb-4">
    <label for="inputTitle" class="text-dark ff-days-one"><small>Title</small></label>

    @if($resume ?? '')
        <input type="text" class="form-control main-input ff-montserrat small" id="inputTitle" name="title" value="{{ $resume->title }}" required>
    @else
        <input type="text" class="form-control main-input ff-montserrat small" id="inputTitle" name="title" value="{{ old('title') }}" required>
    @endif
</div>