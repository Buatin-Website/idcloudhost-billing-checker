<x-layout>
    <div class="row w-full max-w-md mx-auto my-4">
        <form action="{{ route('configure.store') }}" method="POST" class="form-control mt-4">
            @csrf
            <div class="form-control">
                <label class="label" for="api_key">
                    <span class="label-text">API Key</span>
                </label>
                <input type="password" placeholder="Enter your API Key" class="input input-bordered"
                       name="api_key" value="{{ old('api_key', $api_key ?? null) }}" id="api_key" required>
                @error('api_key')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>
            <button class="btn btn-primary mt-4" type="submit">Submit</button>
        </form>
    </div>
</x-layout>
