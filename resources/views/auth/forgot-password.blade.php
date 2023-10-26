<x-layout>
    <x-card  class="p-10 max-w-lg mx-auto mt-24">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
<header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Forgot Password
        </h2>
        <p class="mb-4">Please submit the email to reset Password</p>
    </header>

    <form method="POST" action="/forgot-password">
        @csrf
        <div class="mb-6">
            <label for="email" class="inline-block text-lg mb-2"
                >Email</label
            >
            <input
                type="email"
                class="border border-gray-200 rounded p-2 w-full"
                name="email"
                value="{{old('email')}}"
            />
            @error('email')
            <p class="text-red-500">{{$message}}</p>
            @enderror

        </div>

        <div class="mb-6">
            <button
                type="submit"
                class="btn2"
            >
                Reset
            </button>
        </div>

    </form>
    </x-card>

</x-layout>