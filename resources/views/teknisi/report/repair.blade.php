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
                                        <a href="/teknisi/report">Report</a>
                                    </li>
                                    <li>{{ $title }} Now</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-error mx-4 hidden">
                    <div class="flex-1">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="w-6 h-6 mx-2 stroke-current">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                            </path>
                        </svg>
                        <label id="error-message">Lorem ipsum dolor sit amet, consectetur adip!</label>
                    </div>
                </div>
                <div class="block w-full pb-5">
                    <!-- Projects table -->
                    <form
                        class="form-add-inventory-report init-validatation"
                        method="POST"
                        action="/teknisi/report/{{ $report->id }}"
                        novalidate>
                        <input
                            type="text"
                            hidden
                            readonly
                            name="_token"
                            value="{{ csrf_token() }}">
                        <input
                            type="text"
                            hidden
                            readonly
                            name="_method"
                            value="put">
                        <input
                            type="text"
                            name="type"
                            value="with_inventory"
                            hidden
                            readonly>

                        <div class="grid grid-cols-3  p-4">
                            <div class="col-span-2 flex space-x-2">
                                <div class="form-control w-full"><select
                                        id="select-inventory"
                                        class="form-select2 small w-full">
                                        <option
                                            disabled
                                            hidden
                                            value=""
                                            selected>Pilih Inventory</option>
                                        @foreach ($inventories as $i)
                                            <option value="{{ $i->id . ',' . $i->stock . ',' . $i->name }}">{{ $i->name }}
                                            </option>
                                        @endforeach
                                    </select></div>
                                <div class="form-control w-full">
                                    <input
                                        type="number"
                                        id="stock" required
                                        placeholder="STOK"
                                        class="form-input my-input"
                                        min="0">
                                    <label
                                        id="stock-error"
                                        class="error text-xs text-red-500 hidden"
                                        for="stock"></label>
                                </div>

                            </div>

                            <div> <button
                                    type="submit"
                                    id="btn-add-inventory"
                                    class="btn btn-info ml-4">
                                    Gunakan inventori
                                </button> </div>
                        </div>

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
                            <a
                                href="/teknisi/report"
                                class="btn btn-error ml-4">Back</a>
                            <button id="btn-submit-inventory" class="btn btn-success ml-4">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('templates.footer')
    </section>

@endsection
