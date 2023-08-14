<x-layout>
    <div class="row w-full max-w-md mx-auto my-4">
        <form action="{{ route('configure.store') }}" method="POST" class="form-control mt-4">
            @csrf
            <div class="form-control">
               <div class="row mb-4">
                   <label class="label" for="api_key">
                       <span class="label-text">API Key</span>
                   </label>
                   <input type="password" placeholder="Enter your API Key" class="input input-bordered w-full text-center"
                          name="api_key" value="{{ old('api_key', $api_key ?? null) }}" id="api_key" required>
                   @error('api_key')
                   <label class="label">
                       <span class="label-text-alt text-error">{{ $message }}</span>
                   </label>
                   @enderror
               </div>
                <div class="row mb-4">
                    <label class="label" for="balance_threshold">
                        <span class="label-text">Balance Threshold</span>
                    </label>
                    <input type="number" placeholder="Enter balance threshold"
                           class="input input-bordered w-full text-center"
                           name="balance_threshold" value="{{ old('balance_threshold', $balance_threshold ?? 0) }}"
                           id="balance_threshold" required min="0">
                    @error('balance_threshold')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
            </div>
            <button class="btn btn-primary mt-4" type="submit">Submit</button>
        </form>
    </div>
</x-layout>
