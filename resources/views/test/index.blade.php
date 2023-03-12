@foreach ($UserList as $item)
    <div class="id">
    {{ $item->id }}
        <div class="name">
        {{ $item->name }}
            <div class="email">
                {{ $item->email }}
            </div>
        </div>
    </div>
@endforeach
