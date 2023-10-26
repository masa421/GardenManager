
<x-layout>

    @foreach ($gardens as $garden)
        Garden::factory()->create([<br>
            'user_id' => {{$garden['user_id']}},<br>
            'name' => '{{$garden['name']}}',<br>
            'location' => {{$garden['location']}},<br>
            'width' => {{$garden['width']}},<br>
            'length' => {{$garden['length']}},<br>
            'image' => '{{$garden['image']}}',<br>
            'description' => '{{$garden['description']}}'<br>
        ]);<br><br>
    @endforeach

    @foreach ($plants as $plant)
        Plant::factory()->create([<br>
            'user_id' => {{$plant['user_id']}},<br>
            'name' => '{{$plant['name']}}',<br>
            'planted' => '{{$plant['planted']}}',<br>
            'garden' => {{$plant['garden']}},<br>
            'positionx' => {{$plant['positionx']}},<br>
            'positiony' => {{$plant['positiony']}},<br>
            'description' => '{{$plant['description']}}',<br>
            'size' => {{$plant['size']}},<br>,
            'color' => '{{$plant['color']}}',<br>
            'image' => '{{$plant['image']}}',<br>
        ]);<br><br>
    @endforeach

    @foreach ($locations as $location)
        Plant::factory()->create([<br>
            'user_id' => {{$location['user_id']}},<br>
            'name' => '{{$location['name']}}',<br>
            'description' => '{{$location['description']}}',<br>
        ]);<br><br>
    @endforeach

</x-layout>
