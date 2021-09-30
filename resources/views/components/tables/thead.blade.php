<thead>
    <tr>
        <?php $a=end($thItem);   ?>
        @foreach ($thItem as $th)
        @if ($th=="nomor")
        <th
            class="pl-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-50 text-gray-500 border-gray-100 w-8">
            {{$th}}
        </th>
        @elseif($th==$a)
        <th
            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold bg-gray-50 text-gray-500 border-gray-100 w-40 text-left">
            {{$th}}
        </th>
        @else
        <th
            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-50 text-gray-500 border-gray-100">
            {{$th}}
        </th>
        @endif

        @endforeach
    </tr>
</thead>
