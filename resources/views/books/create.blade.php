@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-4">
                    <div class="card-header">
                        <section class="content-header">

                            <div class="col-sm-6">
                                <h2>Add New Book</h2>
                            </div>

                        </section>
                    </div>
                    <div class="form-group">
                        @include('components.alerts')
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/book/store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="title">Title</label><span style="color: red">*</span><br>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="author">Author</label><span style="color: red">*</span><br>
                                        <input type="text" class="form-control" id="author" name="author"
                                            value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label><span style="color: red">*</span><br>
                                <input type="number" class="form-control" id="price" min="0" step="0.01" name="price" value=""
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label><span style="color: red">*</span><br>
                                <input type="number" class="form-control" id="stock" name="stock" value=""
                                    required><br>
                            </div>

                            <label for="category_id">Category</label><span style="color: red">*</span><br>
                            <select name="category_id" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select><br>

                            <button type="submit" class="btn btn-primary float-right">Save</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
