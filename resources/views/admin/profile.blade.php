@extends('templates.admin')
@section('content')
    <div class="relativ px-4">
        <div class="w-full bg-white shadow-lg rounded-md">
            <div class="grid grid-cols-5 gap-4 p-10">

                <div class="avatar">
                    <div class="mb-8 rounded-full w-32 h-32 ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img src="/img/default-user.png">
                    </div>
                </div>


                <div class="col-span-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">NAME</span>
                        </label>
                        <input name="stock" disabled class="form-input my-input" value="{{ strtoupper($user->name) }}">
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">EMAIL</span>
                        </label>
                        <input name="stock" disabled class="form-input my-input" value="{{ $user->email }}">
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">HANDPHONE</span>
                        </label>
                        <input name="stock" disabled class="form-input my-input" value="{{ $user->phone}}">
                    </div>
                    <div class="form-control w-full">
                     <label class="label">
                         <span class="label-text">ROLE</span>
                     </label>
                     <input disabled class="form-input my-input uppercase" value="{{ $user->role->name }}">
                 </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">ALAMAT</span>
                        </label>
                        <Textarea disabled class="form-input my-input">{{ $user->alamat }}</Textarea>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">GOOGLE MAP LOCATION</span>
                        </label>
                        <Textarea disabled class="form-input my-input">{{ $user->location }}</Textarea>
                    </div>
                

                </div>
            </div>
        </div>
    </div>
    @include('templates.footer')
@endsection
