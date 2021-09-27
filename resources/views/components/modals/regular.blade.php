<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
    id="{{$id}}">
    <div class="bg-gray-500 w-full h-full relative bg-opacity-40 flex justify-center">
        <div class="top-16 w-11/12 md:w-1/2 bg-white rounded-md absolute py-4">
            <div class="border-b px-4 text-lg pb-2 flex justify-between">
                <h1 class="font-semibold text-gray-700">{{ $title }}</h1>
                <button onclick="toggleModal('{{$id}}')" class="text-red-500"><i class="far fa-times-circle"></i></button>
            </div>
            {{ $slot }}
                 </div>
    </div>
</div>