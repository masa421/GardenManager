<x-layout>
    <x-garden>
        <h2>
            <?php echo ($garden['name']); ?>
        </h2>
        <p>
            <?php echo ($garden['description']); ?>
        </p>
        <div style="max-height: 400px;max-width:100%;overflow: scroll;">
            <canvas id="canvas" style='border:1px #550 solid; margin: 10px; padding:10px;'></canvas>
        </div>
        <!--
        <p>
            Width: <?php echo ($garden['width']); ?>
        </p>
        <p>
            Length: <?php echo ($garden['length']); ?>
        </p>
        <p>
            Shape: <?php echo ($garden['shape']); ?>
        </p>
        -->
        @if($plants)
        @foreach ($plants as $plant)
    
        <div class="popup modal" id="popup{{$plant['id']}}">
            <div class="plants">

                <img class="hidden w-48 mr-6 md:block"
                src="{{$plant->image ? asset('storage/'.$plant->image) : asset('images/no-image.png')}}"
                alt=""/>

                <span class="close close{{$plant['id']}}">&times;</span>
                            <h2>{{$plant['name']}}</h2>
                <p>Planted:{{$plant['planted']}}</p>
                <p>Description</p>
                <textarea>{{$plant['description']}}</textarea><br>
                <div style="display:flex; padding:10px 0;justify-content:space-between;">
                    <a href="/plant/{{$plant['id']}}/edit" class="btn2">Edit Plant</a>
                    <div >
                        <form method="POST" action="/plant/{{$plant['id']}}/delete">
                            @csrf
                            @method('DELETE')
                            <button class="btn1"><i class="fa-solid fa-trash"></i>Delete Plant</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    
        <script>
            // Get the modal
            var modal{{$plant['id']}} = document.getElementById("popup{{$plant['id']}}");
        
            // Get the <span> element that closes the modal
            var span{{$plant['id']}} = document.getElementsByClassName("close{{$plant['id']}}")[0];
    
            // When the user clicks on <span> (x), close the modal
            span{{$plant['id']}}.onclick = function() {
            modal{{$plant['id']}}.style.display = "none";
            }
    
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
            if (event.target == modal{{$plant['id']}}) {
                modal{{$plant['id']}}.style.display = "none";
            }
            }     
        </script>


        @endforeach   
        @endif

        <a href="/plant/{{$garden['id']}}/add" class="Edit btn2">Add Plants</a>
        <a href="/garden/{{$garden['id']}}/edit" class="Edit btn2">Edit Garden</a>
        <button class="Edit btn2">Delete This Garden</button><?php //TODO Delete This Garden ?>
        <a href="/location/{{$garden['location']}}/gardens" class="Edit btn2">Back to Gardens List</a>

    </x-garden>

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
                /*
                elements.push({
                    colour: '#05EFFF',
                    width: 20,
                    height: 20,
                    top: 20 + 20  * j,
                    left: 20 + 20 * i,
                    name: "(20 + 20  * j,20 + 20 * i )"
                });
                */
            }
        }

        let sizex =  20;
        let sizey =  20;

        @if($plants)
        @foreach ($plants as $plant)

            //context.beginPath();
            //context.rect( 20 + {{$plant['positionx']}} , 20 + {{$plant['positiony']}},sizex, sizey);
            //context.strokeStyle = 'red';
            //context.lineWidth = 4;
            //context.stroke();
            plantsize = <?php echo ($plant['size']); ?> /2;
            context.beginPath();
            context.arc(30 + {{$plant['positionx']}}, 30 +  {{$plant['positiony']}}, plantsize, 0, 2 * Math.PI);
            context.strokeStyle = '{{$plant['color']}}';
            context.stroke(); 
            elements.push({
                id: "{{$plant['id']}}",
                color: '{{$plant['color']}}',
                width: 20,
                height: 20,
                top: 20 +  {{$plant['positiony']}},
                left: 20 + {{$plant['positionx']}},
                name: "{{$plant['name']}}"
            });
            context.font = "20px serif";
            context.fillStyle = "rgb(40,40,40)";
            context.fillText("{{$plant['name']}}", {{$plant['positionx']}}, {{$plant['positiony']}}+80);

            var img{{$plant['id']}} = new Image( ); // Imageオブジェクトの作成
            img{{$plant['id']}}.src = "{{$plant->image ? asset('storage/'.$plant->image) : asset('images/nothing.png')}}";            
            context.drawImage( img{{$plant['id']}} , 10 +  {{$plant['positionx']}} , 10 + {{$plant['positiony']}},40,40);
            
        @endforeach   
        @endif

    elemLeft = canvas.offsetLeft,
    elemTop = canvas.offsetTop,

    // Add event listener for `click` events.
    canvas.addEventListener('click', function(event) {
        var x = event.pageX - elemLeft,
            y = event.pageY - elemTop;
        console.log(x, y);
        elements.forEach(function(element) {
            // if (y > element.top && y < element.top + element.height && x > element.left && x < element.left + element.width) {
            //    alert('clicked an element:'+element.name);
            // }
            if(Math.pow(element.left + 10 - x, 2) + Math.pow(element.top + 10 - y, 2) <= Math.pow(30, 2)){
                // alert('clicked an element:'+element.name);
                myFunction(element.id);
            }
            //const hit = Math.pow(this.x - point.x, 2) + Math.pow(this.y - point.y, 2) <= Math.pow(this.r, 2);

        });

    }, false);

    </script>

    <script>
        function myFunction(id) {
            console.log("id="+id);
            var popup = document.getElementById("popup"+id);
            if(popup){
                popup.style.display = "block";
                popup.classList.toggle("show");
                //popup.css.width = 100%;
                //popup.css.height = 100%;
            }

        }
    </script>    

</x-layout>