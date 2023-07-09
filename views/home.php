@layout("layouts.main")
<div>
    @if($firstname == 'Abdumannon')
        <div>Ok</div>
    @else
        <div>Noooo</div>
    @endif
</div>
<div>
    @foreach($ar as $key => $item)
        <div>{{ $item }}</div>
    @endforeach

    @for($i=0; $i<=10; $i++)
        <div>{{ $i }}</div>
    @endfor
</div>
@endlayout