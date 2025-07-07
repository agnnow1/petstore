<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $pet->name ?? '') }}">
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" class="form-select">
        @foreach(['available', 'pending', 'sold'] as $status)
            <option value="{{ $status }}" {{ old('status', $pet->status ?? '') === $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Photo URLs</label>
    <div id="photo-url-fields">
        @php
            $urls = old('photoUrls', $pet->photoUrls ?? ['']);
        @endphp
        @foreach ($urls as $url)
            <div class="input-group mb-2">
                <input type="url" name="photoUrls[]" class="form-control" value="{{ $url }}" required>
                <button type="button" class="btn btn-outline-danger remove-url">Remove</button>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addPhotoUrl()">Add Photo URL</button>
</div>

<script>
    function addPhotoUrl() {
        const container = document.getElementById('photo-url-fields');
        const wrapper = document.createElement('div');
        wrapper.className = 'input-group mb-2';
        wrapper.innerHTML = `
            <input type="url" name="photoUrls[]" class="form-control" required>
            <button type="button" class="btn btn-outline-danger remove-url">Remove</button>
        `;
        container.appendChild(wrapper);
    }

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-url')) {
            e.target.closest('.input-group').remove();
        }
    });
</script>
