<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Add Plant
        </h2>
    </header>
    
    <form method="POST" action="/plant" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label
                for="name"
                class="inline-block text-lg mb-2"
                >Plant Name</label
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
    
        <div class="mb-6">
            <label for="planted" class="inline-block text-lg mb-2"
                >Planted Date</label
            >
            <input
                type="date"
                class="border border-gray-200 rounded p-2 w-full"
                name="planted"
                placeholder="Example: Senior Laravel Developer"
                value="{{old('date')}}"
            />
            @error('planted')
                <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
    
        <div class="mb-6">
            <label
                for="color"
                class="inline-block text-lg mb-2"
                >color</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="color"
                placeholder="Example: Remote, Boston MA, etc"
                value="{{old('color')}}"
            />
            @error('color')
                <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
    
        <div class="mb-6">
            <label for="size" class="inline-block text-lg mb-2"
                >Size (cm)</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="size"
                value="{{old('size')}}"
            />
            @error('size')
                <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
        
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
                placeholder="Include tasks, requirements, salary, etc"
            >{{old('description')}}</textarea>
            @error('description')
                <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
    
        <label 
            for="plant position"
            class="inline-block text-lg mb-2"
        >
        Plant Position (Click the field below)
        </label><br>
        <div style="max-height: 300px;max-width:100%;overflow: scroll;">
            <canvas id="canvas" style='border:1px #550 solid; margin: 10px; padding:10px;'></canvas>
        </div>
        @error('positionx')
            <p class="text-red-500">{{$message}}</p>
        @enderror
        @error('positionxy')
            <p class="text-red-500">{{$message}}</p>
        @enderror

        <input
        type="hidden"
        name="positionx"
        id="positionx"
        value="" readonly />

        <input
        type="hidden"
        name="positiony"
        id="positiony"
        value="" readonly />

        <input
        type="hidden"
        name="garden"
        value="{{$garden['id']}}" readonly />

        <div class="mb-6">
            <button class="btn1">
                Add Plant
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

                elements.push({
                    colour: '#05EFFF',
                    width: 20,
                    height: 20,
                    top: 20 + 20  * j,
                    left: 20 + 20 * i,
                    name: "xpos, ypos"
                });
                
            }
        }

        let sizex =  20;
        let sizey =  20;

        elemLeft = canvas.offsetLeft,
        elemTop = canvas.offsetTop,
    
    // Add event listener for `click` events.
    canvas.addEventListener('click', function(event) {
        var x = event.pageX - elemLeft,
            y = event.pageY - elemTop;
        console.log(x, y);
        elements.forEach(function(element) {
            if (y > element.top && y < element.top + element.height && x > element.left && x < element.left + element.width) {
                xx = element.left - 40;
                yy = element.top - 40; 

                setNewLocation(xx, yy);
                //alert('clicked an element:'+ "x:"+element.left+"y:"+element.top);
            }
        });

    }, false);

    function setNewLocation(xpos, ypos){
        xelem = document.getElementById('positionx');
        xelem.value = xpos;
        yelem = document.getElementById('positiony');
        yelem.value = ypos;
        let canvas = document.querySelector('#canvas');

        xelem = document.getElementById('positionx');
        newxpos = xelem.value;
        yelem = document.getElementById('positiony');
        newypos = yelem.value;

        context.clearRect(0, 0, context.canvas.width, context.canvas.height);
        CanvasReDraw(newxpos, newypos);

    }

    function CanvasReDraw(newx, newy){

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

                elements.push({
                    colour: '#05EFFF',
                    width: 20,
                    height: 20,
                    top: 20 + 20  * j,
                    left: 20 + 20 * i,
                    name: "xpos, ypos"
                });
                
            }
        }

        let sizex =  20;
        let sizey =  20;

        // New
        newxpos = parseInt(newx);
        newypos = parseInt(newy);

        context.beginPath();
        context.arc(30 + newxpos, 30 +  newypos, 30, 0, 2 * Math.PI);
        context.strokeStyle = 'red';
        context.stroke(); 
        context.font = "20px serif";
        context.fillStyle = "rgb(40,40,40)";
        context.fillText("New POS", newxpos, newypos+80);


    }

    </script>