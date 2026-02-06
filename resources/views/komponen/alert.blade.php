@if (Session::has('success'))
    <div class=" pt-3 alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif


@if ($errors->any())
    <div class=" pt-3 alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
@endif
