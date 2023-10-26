<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Create new garden Area
            </h2>
        </header>
    
        <form method="POST" action="/garden" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label
                    for="name"
                    class="inline-block text-lg mb-2"
                    >garden Name</label>
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
        
            <div class="mb-6">
                <label for="width" class="inline-block text-lg mb-2"
                    >width (cm)</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="width"
                    id="width"
                    value="{{old('width')}}"
                />
                @error('width')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="length" class="inline-block text-lg mb-2"
                    >length (cm)</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="length"
                    id="length"
                    value="{{old('length')}}"
                    />
                @error('length')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>        

            <div class="mb-6">
                <label for="image" class="inline-block text-lg mb-2">
                    garden Image (Optional)
                </label><br>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="image"
                /><br>

                <img class="hidden w-48 mr-6 md:block"
                src="{{asset('images/no-image.png')}}"
                alt=""/>

                @error('image')
                    <p class="text-red-500">{{$message}}</p>
                @enderror

            </div>
        
            <div class="mb-6">
                <label 
                    for="description"
                    class="inline-block text-lg mb-2">
                    garden Description
                </label><br>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    rows="10"
                    placeholder="Description about this garden, etc"
                >{{old('description')}}</textarea>
                @error('description')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>

            <input type='hidden' name='location' value='{{$location->id}}'/>
            
            <label for="description" class="inline-block text-lg mb-2">
                garden Size Image
            </label><br>

            <div style="max-height: 300px;max-width:100%;overflow: scroll;">
                <canvas id="canvas" style='border:1px #550 solid; margin: 10px; padding:10px;'></canvas>
            </div>

            <div class="mb-6">
                <button class="btn2">
                    Create garden
                </button>
                <a href="/location/{{$location->id}}/gardens" class="btn2">Back to List</a>
            </div>
        </form>
    </x-card>
</x-layout>

<script>

    // Prepare Graphical Garden
    let canvas = document.querySelector('#canvas');
    let context = canvas.getContext('2d');

    function CanvasReDraw(){
        
        var newx = parseInt(document.getElementById("length").value);
        var newy = parseInt(document.getElementById("width").value);
        
        if(!(newx > 0 && newx < 1000 && newy > 0 && newy < 1000)){
            // alert("garden size is too big or too small");
            return;
        }

        canvas.width = newx + 40;
        canvas.height = newy + 40;

        // glength, gwidth (m)
        let glength = newx / 20;
        let gwidth  = newy / 20;

        for(let i = 0; i < glength; i++){
            for(let j = 0; j < gwidth; j++){
                let sizex =  20;
                let sizey =  20;
                context.beginPath();
                context.rect( 20 + 20 * i, 20 + 20  * j,sizex, sizey);
                context.strokeStyle = 'lightgrey';
                context.lineWidth = 4;
                context.stroke();
                context.fillStyle = 'beige';
                context.fillRect( 20 + 20 * i, 20 + 20  * j,sizex, sizey);                
            }
        }
    }

    $("#length").on('change keydown paste input', function(){
        CanvasReDraw();
    });

    $("#width").on('change keydown paste input', function(){
        CanvasReDraw();
    });


</script>