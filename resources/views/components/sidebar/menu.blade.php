<li class="items-center ">
    @if ($active)
    <a href="{{ $href }}" class="text-xs uppercase p-3 font-bold block text-blue-800 hover:text-blue-800">
        {{ $slot }}
    </a>
    @else
    <a href="{{ $href }}" class="text-xs uppercase p-3 font-bold block text-gray-500 hover:text-blue-800">
        {{ $slot }}
    </a>
    @endif
</li>