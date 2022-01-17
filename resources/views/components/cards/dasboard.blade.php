<div class="w-full lg:w-6/12 xl:w-3/12 px-4">
    <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
        <div class="flex-auto p-4">
            <div class="flex flex-wrap">
                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-gray-400 uppercase font-bold text-xs">
                        {{ $title }}
                    </h5>
                    <span class="font-semibold text-xl text-gray-700">
                        {{$subtitle}}
                    </span>
                </div>
                <div class="relative w-auto pl-4 flex-initial">
                    <div
                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500">
                        <i class="{{ $icon }}"></i>
                    </div>
                </div>
            </div>
            {{-- <p class="text-sm text-gray-400 mt-4">
                @if ($upper)
                <span class="text-green-400 mr-2">
                    <i class="fas fa-arrow-up"></i> {{ $percentase }}
                </span>
                @else
                <span class="text-red-500 mr-2">
                    <i class="fas fa-arrow-down"></i> {{ $percentase }}
                </span>
                @endif
                <span class="whitespace-nowrap">
                  {{ $footer }}
                </span>
            </p> --}}
        </div>
    </div>
</div>