@extends('templates.teknisi')
@section('content')

<section class="px-4 md:px-10 mx-auto w-full -m-24">
    <div class="w-full mb-12 px-4 mt-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
            
              
            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="relative w-full  max-w-full flex-grow flex-1 flex">
                        <div class="text-sm breadcrumbs">
                            <ul>
                                <li>
                                    <a href="/">Teknisi</a>
                                </li>
                                <li>
                                    <a href="/teknisi/installation">Installation</a>
                                </li>
                                <li>{{ $title }} Now</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-error mx-4 hidden">
                <div class="flex-1">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">    
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>                      
                  </svg> 
                  <label id="error-message">Lorem ipsum dolor sit amet, consectetur adip!</label>
                </div>
              </div>
            <div class="block w-full pb-5">
                <!-- Projects table -->
                <form action="/teknisi/installation/{{ $installation->id }}" class="form-installation init-validatation" method="POST" novalidate>
                    <input type="text" hidden readonly name="_token" value="{{ csrf_token() }}">
                    <input type="text" hidden readonly name="_method" value="put">
                    <div class="grid lg:grid-cols-2 lg:gap-4">
                        <div class="p-4">
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Username</span>
                                </label>
                                <input type="text" placeholder="username" name="username" class="input input-bordered"
                                    required>
                                    <label id="username-error" class="error text-xs text-red-500 hidden" for="username"></label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Google map</span>
                                </label>
                                <input type="text" name="location"
                                    placeholder="Q9C7+8H9, Taman Baru, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68416"
                                    class="input input-bordered" required>
                                    <label id="location-error" class="error text-xs text-red-500 hidden" for="location"></label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Nama paket</span>
                                </label>
                                <input type="text" value="{{ $installation->package->name }}"
                                    class="input input-bordered input-disabled" disabled>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Harga Paket</span>
                                </label>
                                <label class="input-group rounded-md">
                                    <span>Rp</span>
                                    <input type="text" value="@rupiah($installation->package->price)"
                                        class="input input-bordered input-disabled w-full rounded-md" disabled>
                                </label>
                            </div>

                        </div>
                        <div class="p-4">
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Redaman</span>
                                </label>
                                <input type="text" name="redaman" placeholder="" class="input input-bordered" required>
                                <label id="redaman-error" class="error text-xs text-red-500 hidden" for="redaman"></label>
                            </div>
                            <div class="flex lg:flex-row flex-col justify-between w-full">
                                <div class="form-control lg:w-1/3 w-full">
                                    <label class="label">
                                        <span class="label-text">Spliter</span>
                                    </label>
                                    <input type="text" name="spliter" placeholder="" class="input input-bordered"
                                        required>
                                        <label id="spliter-error" class="error text-xs text-red-500 hidden" for="spliter"></label>
                                </div>
                                <div class="form-control lg:w-1/5 w-full">
                                    <label class="label">
                                        <span class="label-text">Port</span>
                                    </label>
                                    <input type="text" data-rule-number="true" name="port" placeholder="" class="input input-bordered" required>
                                    <label id="port-error" class="error text-xs text-red-500 hidden" for="port"></label>
                                </div>
                                <div class="form-control lg:w-1/3 w-full">
                                    <label class="label">
                                        <span class="label-text truncate">Number modem</span>
                                    </label>
                                    <input type="text" data-rule-number="true" name="number_modem" placeholder="" class="input input-bordered"
                                        required>
                                        <label id="number_modem-error" class="error text-xs text-red-500 hidden" for="number_modem"></label>
                                </div>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Biaya tambahan</span>
                                </label>
                                <label class="input-group rounded-md">
                                    <span>Rp</span>
                                    <input data-rule-number="true" type="text" name="installation_costs" placeholder="500000"
                                        class="input input-bordered w-full rounded-md" required>
                                </label>
                                <label id="installation_costs-error" class="error text-xs text-red-500 hidden" for="installation_costs"></label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span  class="label-text">Discount <small>(optional)</small></span>
                                </label>
                                <label class="input-group rounded-md">
                                    <span>Rp</span>
                                    <input data-rule-number="true" type="text" name="discount" placeholder="20000"
                                        class="input input-bordered w-full rounded-md">
                                </label>
                            </div>
                            <label id="discount-error" class="error text-xs text-red-500 hidden" for="discount"></label>
                        </div>
                    </div>
                    <button onclick="modal_toggler('add-modal')" type="button" class="btn btn-info ml-4">Gunakan
                        inventori</button>
                    <div class="px-4 overflow-x-auto">
                        <table class="table-inventory table w-full table-zebra mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end px-4 mt-4 items-center">
                        <a href="/teknisi/installation" class="btn btn-error ml-4">Back</a>
                        <button class="btn btn-success ml-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('templates.footer')
</section>
<div id="add-modal" class="modal">
    <div class="modal-box">
        <h2 class="font-bold">ADD INVENTORY</h2>
        <hr>
        <form id="form-add-inventory" novalidate>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Inventory Name</span>
                </label>
                <select name="inventory-name" class="form-select" required>
                    <option disabled selected>Chose one</option>
                    @foreach ($inventories as $inv )
                    <option value="{{ $inv->id." | ".$inv->stock." | ".$inv->name }}">{{ $inv->name }}</option>
                    @endforeach
                </select>
                <label id="inventory-name-error" class="error text-sm text-red-500 hidden" for="inventory-name"></label>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Stock digunakan</span>
                </label>
                <input type="number" placeholder="qty" required name="stock" class="input input-bordered">
                <label id="stock-error" class="error text-sm text-red-500 hidden" for="stock"></label>
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-success add">Add</button>
                <button type="button" class="btn btn-error" onclick="modal_toggler('add-modal')">Close</button>
            </div>
        </form>
    </div>
</div>
@endsection