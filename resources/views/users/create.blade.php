@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-4">
                    <div class="card-header">
                        <section class="content-header">

                            <div class="col-sm-6">
                                <h2>Add New User</h2>
                            </div>

                        </section>
                    </div>

                    <div class="form-group">
                        @include('components.alerts')
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/user/store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name</label><span style="color: red">*</span><br>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label><span style="color: red">*</span><br>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nic">NIC</label><span style="color: red">*</span><br>
                                <input type="text" class="form-control" id="nic" name="nic" value="" required><br>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label><span style="color: red">*</span><br>
                                <textarea type="text" class="form-control" id="address" name="address" value="" required></textarea>
                            </div>


                            <button type="submit" class="btn btn-primary float-right">Save</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
