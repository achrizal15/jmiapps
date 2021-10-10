@extends('templates.admin')
@section('content')

<section class="px-4 md:px-10 mx-auto w-full -m-24">
    <div class="w-full mb-12 px-4 mt-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
            @if (session("success"))
            <div class="p-4" id="alert">
                <x-alert type="success">
                    {{session('success')}}
                </x-alert>
            </div>
            @endif
            @if (session("error"))
            <div class="p-4" id="alert">
                <x-alert type="error">
                    {{session('error')}}
                </x-alert>
            </div>
            @endif
            @if ($errors->any())
            <div class="p-4" id="alert">
                <x-alert type="error">
                    Gagal! silahkan coba lagi.
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </x-alert>
            </div>
            @endif

            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="relative w-full  max-w-full flex-grow flex-1 flex">
                        <h3 class="font-semibold text-lg text-gray-700 inline">
                            FORM PEMASANGAN BARU
                        </h3>
                    </div>
                    <a href="/admin/installation"
                        class="font-semibold rounded-sm px-3 py-0.5 shadow-lg bg-red-600 text-sm text-white">BACK</a>
                </div>
            </div>
            <div class="block w-full overflow-x-auto pb-5 px-4">
                <form action="/admin/installation" method="POST" autocomplete="on">
                    @csrf
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="md:w-1/2 w-full">
                            <label for="member-name" class="font-semibold text-gray-500">Member</label>
                            <input type="text" id="member-name" placeholder="Nomor hp/Nama" name="user_id"
                                class="block rounded-md w-full" autocomplete="on">
                        </div>
                        <div class="md:w-1/2 w-full">
                            <label for="package" class="font-semibold text-gray-500">Package</label>
                            <select name="package_id" id="" class="block rounded-md w-full">
                                <option hidden disabled selected>Pilih Package</option>
                                @if (!count($packages))
                                <option disabled>Kosong</option>
                                @endif
                                @foreach ($packages as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="md:w-1/2 w-full">
                            <label for="detail" class="font-semibold text-gray-500">Detail</label>
                            <textarea id="detail" name="detail" class="rounded-md w-full"
                                placeholder="Jelaskan jika ada"></textarea>
                        </div>
                        <div class="md:w-1/2 w-full">
                            <label for="inv-name" class="font-semibold text-gray-500">Inventory Digunakan</label>
                            <div class="flex space-x-2 mb-2">
                                <input type="text" id="inv-name" placeholder="Nama" class="rounded-md w-full"
                                    autocomplete="on">
                                <input type="number" id="inv-stc" min="0" placeholder="Stock" class="rounded-md w-1/3"
                                    autocomplete="on">
                                <button type="button" id="gunakan"
                                    class="bg-white shadow-md px-4 py-1 hover:bg-gray-200">Gunakan</button>
                            </div>
                            <ul class="todo-list list-decimal ml-4"> </ul>
                        </div>
                    </div>

                    <button type="submit"
                        class="bg-green-500 text-white font-semibold px-4 py-1 rounded-sm shadow-md hover:bg-green-700">Ajukan
                        Sekaran</button>
                </form>
            </div>
        </div>
    </div>
    @include('templates.footer')
</section>

<script>
    $(document).ready(function() {
        setTimeout(function(){ $('#alert').hide('slow') }, 5000);
        let nama=[];
        let barang=[];
        $.ajax({
        url:"/admin/installation/selectJquery",
        type:"get",
        data:{"_token": $('meta[name="csrf-token"]').attr('content'),"inventory":"inv"},
        dataType:"json",
        success:function(data) {
           data.forEach(element => {
               barang.push(`${element.name}-${element.id}`);
              })
           }})
        $.ajax({
        url:"/admin/installation/selectJquery",
        type:"get",
        data:{"_token": $('meta[name="csrf-token"]').attr('content'),"search":"user"},
        dataType:"json",
        success:function(data) {
           data.forEach(element => {
               nama.push(element.name+`-${element.phone}`);
              })
           }})
     $(function(){ $("#member-name").autocomplete({ source:nama })})
     $(function(){ $("#inv-name").autocomplete({ source:barang })})
     $(function(){
        $('#gunakan').click(
            function(){
                var name = $('#inv-name').val();
                var stock = $('#inv-stc').val();
                if(name !=="" && stock !== ""){
                    $('.todo-list').append(`<li>
                    <div class='flex justify-between'>
                    <input type="text" class="focus:ring-0 border-none" name="inventory[${name}][name]" readonly value="${name}">
                    <div class="flex justify-between">
                    <input type="text" class="focus:ring-0 border-none w-14" name="inventory[${name}][stock]" readonly value="${stock}">
                    <button type="button" id="del-inv"> <i class="fas fa-trash text-red-500"></i></button>
                    </div></div></li>`);
                }
            });

       $("#inv-name").keyup(function(event){
          if(event.keyCode == 13){
            $("#gunakan").click();
          }
      });

      $(document).on('click','#del-inv', function(){
        $(this).parents("li:first").toggleClass('strike').fadeOut('slow');
      });
     })
});
</script>
@endsection
