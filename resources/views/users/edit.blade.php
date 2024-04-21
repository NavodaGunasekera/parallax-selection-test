@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-4">
                    <div class="card-header">
                        <section class="content-header">

                            <div class="col-sm-6">
                                <h2>Edit User Details</h2>
                            </div>

                        </section>
                    </div>

                    <div class="form-group">
                        @include('components.alerts')
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('user/update/' . $user->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name</label><span style="color: red">*</span><br>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $user->name }}" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label><span style="color: red">*</span><br>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ $user->phone_number }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="nic">NIC</label><span style="color: red">*</span><br>
                                        <input type="text" class="form-control" id="nic" name="nic"
                                            value="{{ $user->NIC }}" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="address">Address</label><span style="color: red">*</span><br>
                                        <textarea type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required>{{ $user->address }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
