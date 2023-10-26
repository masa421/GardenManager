<x-layout>

@if(count($gardens) == 0)
<p>No gardens Found</p>
@endif

<?php foreach ($gardens as $garden): ?>
    <a href="/garden/{{$garden['id']}}">
        <x-card>
            <h2>
                <?php echo ($garden['name']); ?>
            </h2>
            <p>
                <?php echo ($garden['description']); ?>
            </p>
            <img class="hidden w-48 mr-6 md:block"
            src="{{$garden->image ? asset('storage/'.$garden->image) : asset('images/no-image.png')}}"
            alt=""/>
        </x-card>
    </a>
<?php endforeach; ?>
<a href="/garden/create/{{$location['id']}}" class="btn2">Add new Garden Area</a>
<a href="/locations" class="btn2">Back to Location List</a>
</x-layout>
