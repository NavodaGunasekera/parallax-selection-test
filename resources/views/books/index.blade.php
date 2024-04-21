@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">

            <div class="col-sm-6">
                <h1>Books list</h1>
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

                            <div class="row">
                                <div class="col-6">

                                    <form method="GET" action="{{ url('book/') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">

                                            <select class="form-control" name="category_id" onchange="this.form.submit()">
                                                <option value = "0">All</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $categoryId == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </form>
                                </div>
                                <div class="col-6">
                                    <a type="button" class="btn btn-primary mb-4 float-right"
                                        href="{{ url('book/create') }}">Add New Book</a>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ $book->price }}</td>
                                            <td>{{ $book->stock }}</td>
                                            <td>{{ $book->bookCategory->name }}</td>
                                            <td><a class="btn btn-block btn-success"
                                                    href="{{ url('book/' . $book->id . '/edit') }}">Edit</a>
                                                <form method="POST" class="mt-2"
                                                    action="{{ url('/book/delete/' . $book->id) }}">
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
                                    {{ $books->appends(request()->query())->links() }}
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
