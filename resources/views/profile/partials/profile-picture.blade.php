{{-- profile picture --}}
<input type="file" name="image" id="img-file" class="img-upload d-none" accept="image/*" multiple>
<div class="profile-img-container position-relative mx-auto mb-4">
    <x-icons.picture></x-icons.picture>
    <button class="btn profile-upload position-absolute bottom-0 end-0" type="button">
    <x-icons.camera></x-icons.camera>    
    </button>
</div>