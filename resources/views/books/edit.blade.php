@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-4">
                    <div class="card-header">
                        <section class="content-header">

                            <div class="col-sm-6">
                                <h2>Edit Book Details</h2>
                            </div>

                        </section>
                    </div>

                    <div class="form-group">
                        @include('components.alerts')
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('book/update/' . $book->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="title">Title</label><span style="color: red">*</span><br>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ $book->title }}" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="author">Author</label><span style="color: red">*</span><br>
                                        <input type="text" class="form-control" id="author" name="author"
                                            value="{{ $book->author }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="price">Price</label><span style="color: red">*</span><br>
                                        <input type="number" class="form-control" id="price" name="price"
                                            value="{{ $book->price }}" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="stock">Stock</label><span style="color: red">*</span><br>
                                        <input type="number" class="form-control" id="stock" name="stock"
                                            value="{{ $book->stock }}" required>
                                    </div>
                                </div>
                            </div>
                            <label for="category_id">Category</label><span style="color: red">*</span><br>
                            <select name="category_id" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $book->book_category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select><br>

                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
