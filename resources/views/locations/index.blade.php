<x-layout>
<?php foreach ($locations as $location): ?>
    <a href="/location/{{$location['id']}}/gardens">
        <x-card>
            <h2>
                <?php echo ($location['name']); ?>
            </h2>
            <p>
                <?php echo ($location['description']); ?>
            </p>
        </x-card>
    </a>
<?php endforeach; ?>
<a href="/location/add" class="btn2">Add new Location</a>

</x-layout>
