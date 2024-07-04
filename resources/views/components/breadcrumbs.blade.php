
<nav {{ $attributes }}>

    <ul class="flex space-x-4 text-slate-500">

        <li>
            <a href="/">Home</a>
        </li>

        @foreach ($links as $label => $link)

            <li>/</li>

            <li>
                @if($loop->last)
                    <span>{{ $label }}</span>
                @else
                    <a href="{{ $link }}">{{ $label }}</a>
                @endif
            </li>
            
        @endforeach

    </ul>

</nav>
