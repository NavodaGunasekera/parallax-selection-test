@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-4">
                    <div class="card-header">
                        <section class="content-header">

                            <div class="col-sm-6">
                                <h2>Edit Book Borrowal Details</h2>
                            </div>

                        </section>
                    </div>

                    <div class="form-group">
                        @include('components.alerts')
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/borrowal-book/' . $borrowal->id . '/update') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <label for="book_id">Book Title</label><span style="color: red">*</span><br>
                            <select name="book_id" class="form-control" required>

                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}"
                                        {{ $borrowal->book_id == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }}
                                    </option>
                                @endforeach
                            </select><br>

                            <label for="user_id">User Name</label><span style="color: red">*</span><br>
                            <select name="user_id" class="form-control" required>

                                @foreach ($libUsers as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $borrowal->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select><br>

                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="period">Period(Days)</label><span style="color: red">*</span><br>
                                        <input type="number" min="1" class="form-control" id="period"
                                            name="period" value="{{ $borrowal->days_count }}" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="borrowal_date">Issued Date</label><span style="color: red">*</span><br>
                                        <input type="date" class="form-control" id="borrowal_date" name="borrowal_date"
                                            value="{{ $borrowal->borrowal_date }}" required>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary float-right">Submit</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("borrowal_date")[0].setAttribute('min', today);
    </script>
@endsection
