<ul>
    @foreach ($statuses as $key => $value)
        <li><b>{{ $key }}</b>: {{ $value }}</li>
    @endforeach
</ul>
