@extends('templates.admin')
@section('content')
<section class="px-4 md:px-10 mx-auto w-full -m-24">
    <article class="flex flex-wrap">
        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-gray-700">
               Pelanggan terbaru
               Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus, alias? Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, accusantium. Atque quasi necessitatibus maiores aliquam numquam quaerat sequi tenetur quae nostrum eum error fuga facilis suscipit deleniti quod natus, aperiam nisi, debitis officiis dolor distinctio neque. Deserunt aliquam natus veritatis.
            </div>
        </div>
    <div class="relative">Report gangguan terbaru</div>
    </article>
    {{-- <article class="flex flex-wrap mt-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui expedita saepe
        rerum non voluptate delectus at provident itaque, repellat nihil ea consequatur commodi libero magnam, animi
        enim minus a nulla.</article> --}}
    @include('templates.footer')
</section>
@endsection