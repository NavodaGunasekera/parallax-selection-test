@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">

            <div class="col-sm-6">
                <h1>Users list</h1>
            </div>

        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="form-group">
                            @include('components.alerts')
                        </div>
                        <div class="card-body">

                            <a type="button" class="btn btn-primary mb-4 float-right" href="{{ url('user/create') }}">Add
                                New User</a>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">NIC</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($libUsers as $libUser)
                                        <tr>
                                            <td>{{ $libUser->name }}</td>
                                            <td>{{ $libUser->phone_number }}</td>
                                            <td>{{ $libUser->NIC }}</td>
                                            <td>{{ $libUser->address }}</td>


                                            <td><a class="btn btn-block btn-success"
                                                    href="{{ url('user/' . $libUser->id . '/edit') }}">Edit</a>
                                                <form method="POST" class="mt-2"
                                                    action="{{ url('/user/delete/' . $libUser->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-block btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $libUsers->appends(request()->query())->links() }}
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
