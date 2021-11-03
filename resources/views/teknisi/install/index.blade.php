@extends('templates.teknisi')
@section('content')

<body class="bg-gray-50">
    <div class="w-full flex justify-center ">
        <div class="shadow-md rounded-md w-1/2 mt-10 bg-white px-5 py-5">
            <div class="flex justify-between border-b">
                <h1 class="font-semibold text-gray-600">FORM INSTALLED</h1>
                <div class="flex space-x-2">
                    <button class="bg-red-500 px-4 py-0.5 text-white rounded-sm">Back</button>
                </div>
            </div>
            <div class="mt-4">
                <form action="/teknisi/{{ $installation->id }}" method="post">
                    @method("put")
                    @csrf
                    <div class="md:flex block w-full md:space-x-2">
                        <div class="w-1/2">
                            <label>Username</label>
                            <input type="text" name="username" class="block w-full" value="pelanggan231">
                        </div>
                        <div class="w-1/2">
                            <label>Nama Pelanggan</label>
                            <input type="text" class="block w-full opacity-50 focus:ring-white"
                                value="{{ $installation->user->name }}" readonly disabled>
                        </div>
                    </div>
                    <div class="md:flex block w-full md:space-x-2">
                        <div class="w-1/2">
                            <label>Package</label>
                            <input disabled type="text" class="block w-full opacity-50 focus:ring-white"
                                value="{{ $installation->package->name }}">
                        </div>
                        <div class="w-1/2">
                            <label>Biaya Pemasangan</label>
                            <input type="number" min="0" name="installation_costs" placeholder="100000"
                                class="block w-full">
                        </div>
                    </div>
                    <div class="md:flex block w-full md:space-x-2">
                        <div class="w-1/2">
                            <label>Discount</label>
                            <input type="text" class="block w-full" name="discount" placeholder="50000"
                                value="{{ $installation->package->discount }}">
                        </div>
                        <div class="w-1/3">
                            <label>Number Modem</label>
                            <input type="number" min="0" name="number_modem" placeholder="321" class="block w-full">
                        </div>
                        <div class="w-1/3">
                            <label>Port</label>
                            <input type="number" min="0" name="port" placeholder="25" class="block w-full">
                        </div>
                    </div>
                    <div class="md:flex block w-full md:space-x-2 md:items-end">
                        <div class="w-1/2">
                            <label>Inventory</label>
                            <input type="text" id="inv-name" placeholder="Cari nama inventory" class="block w-full">
                        </div>
                        <div class="w-1/3">
                            <label>Stock</label>
                            <input type="number" id="inv-stc" min="0" placeholder="12" class="block w-full">
                        </div>
                        <div class="w-1/5">
                            <button type="button" id="gunakan"
                                class="py-2.5 px-4 bg-gray-400 w-full font-semibold text-white">Gunakan</button>
                        </div>
                    </div>
                    <div class="md:flex block w-full md:space-x-2 border-t mt-3">
                        <ol class="list-decimal todo-list ml-4 inline-block w-full">

                        </ol>
                    </div>
                    <button class="bg-green-500 px-4 py-0.5 text-white rounded-sm mt-5">Install</button>
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function() {
            setTimeout(function(){ $('#alert').hide('slow') }, 5000);
            let barang=[];
             $.ajax({
            url:"/teknisi/selectjquery",
            type:"get",
            data:{"_token": $('meta[name="csrf-token"]').attr('content'),"_method":"get"},
            dataType:"json",
            success:function(data) {
                data.forEach(e => {
                barang.push(e['id']+"-"+e['name']);
              });
             }})
         $(function(){ $("#inv-name").autocomplete({ source:barang })})
         $(function(){
        $('#gunakan').click(
            function(){
                var name = $('#inv-name').val();
                var stock = $('#inv-stc').val();
                if(name !=="" && stock !== "" && name!=$(`#${name}`).val() ){
                    $('.todo-list').append(`   <li>
                                <div class="flex justify-between  w-full items-center">
                                    <input type="text" id=${name}  name="inventory[${name}][name]" readonly value="${name}"
                                        class="border-none focus:ring-transparent">
                                    <div class="flex space-x-2">
                                        <input type="text" name="inventory[${name}][stock]" readonly value="${stock}"
                                            class="border-none focus:ring-transparent">
                                            <button type="button" id="delete"> <i class="fas fa-trash text-red-500"></i></button>
                                    </div>
                                </div>
                            </li>`);
                }
            });
      $(document).on('click','#delete', function(){
        $(this).parents("li:first").toggleClass('strike').fadeOut('slow');
      });
     })

    });
        </script>
</body>
@endsection