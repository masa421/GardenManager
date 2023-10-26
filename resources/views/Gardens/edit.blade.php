<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit garden
            </h2>
            <p class="mb-4">{{$garden->name}}</p>
        </header>
    
        <form method="POST" action="/garden/{{$garden->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label
                    for="name"
                    class="inline-block text-lg mb-2"
                    >garden Name</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="name"
                    value="{{$garden->name}}"
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
                    value="{{$garden->width}}"
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
                    value="{{$garden->length}}"
                />
                @error('length')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>        

            <div class="mb-6">
                <label for="image" class="inline-block text-lg mb-2">
                    garden Image
                </label><br>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="image"
                />
                <br>
                <img class="hidden w-48 mr-6 md:block"
                src="{{$garden->image ? asset('storage/'.$garden->image) : asset('images/no-image.png')}}"
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
                    placeholder="Include tasks, requirements, salary, etc"
                >{{$garden->description}}</textarea>
                @error('description')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
        
            <label for="description" class="inline-block text-lg mb-2">
                garden Size Image
            </label><br>
            <canvas id="canvas" style='border:1px #550 solid; margin: 10px; padding:10px;'></canvas>

            <div class="mb-6">
                <button class="btn1">
                    Update garden
                </button>
        
                <a href="/garden/{{$garden['id']}}" class="btn2"> Back </a>     

            </div>
        </form>
    </x-card>
</x-layout>

<script>

    // Prepare Graphical Garden
    let canvas = document.querySelector('#canvas');
    let context = canvas.getContext('2d');
    elements = [];

    canvas.width = <?php echo ($garden['length']); ?> + 40;
    canvas.height = <?php echo ($garden['width']); ?> + 40;

    // glength, gwidth (m)
    let glength = <?php echo ($garden['length']); ?> / 20;
    let gwidth  = <?php echo ($garden['width']); ?> / 20;


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
            
            let xpos = 20 + 20  * j;
            let ypos = 20 + 20 * i;
        }
    }

    function CanvasReDraw(){
        
        var newx = parseInt(document.getElementById("length").value);
        var newy = parseInt(document.getElementById("width").value);
        
        if(!(newx > 0 && newx < 1000 && newy > 0 && newy < 1000)){
            alert("garden size is too big or too small");
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