<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Add Location
            </h2>
        </header>
    
        <form method="POST" action="/location" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label
                    for="name"
                    class="inline-block text-lg mb-2"
                    >Location Name</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="name"
                    value="{{old('name')}}"
                    />
        
                @error('name')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
        
            <!--
            <div class="mb-6">
                <label for="image" class="inline-block text-lg mb-2">
                    Plant Image
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="image"
                />

                <img class="hidden w-48 mr-6 md:block"
                src="asset('images/no-image.png')}}"
                alt=""/>

                @error('image')
                    <p class="text-red-500">{{$message}}</p>
                @enderror

            </div>
            -->

            <div class="mb-6">
                <label 
                    for="description"
                    class="inline-block text-lg mb-2"
                >
                    Plant Description
                </label><br>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    rows="10"
                    placeholder="The name of the location, location can have gardens."
                >{{old('description')}}</textarea>
                @error('description')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <button class="btn1">
                    Add Location
                </button>
                <a href="/locations" class="btn2"> Back </a>
            </div>
            
        </form>
    </x-card>
</x-layout>

