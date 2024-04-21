@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">

            <div class="col-sm-6">
                <h1>Borrowal Book list</h1>
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

                            <a type="button" class="btn btn-primary mb-4 float-right"
                                href="{{ url('/issue-book') }}">Borrowal Book</a>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Book Title</th>
                                        <th>User Name</th>
                                        <th>Period(Days)</th>
                                        <th>Borrowal Date</th>
                                        <th>Return Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookList as $book)
                                        <tr>
                                            <td>{{ $book->books->title }}</td>
                                            <td>{{ $book->libUsers->name }}</td>
                                            <td>{{ $book->days_count }}</td>
                                            <td>{{ $book->borrowal_date }}</td>
                                            <td>{{ $book->return_date }}</td>
                                            <td>
                                                @if ($book->return_date)
                                                    <span class="badge badge-secondary">Returned</span>
                                                @else
                                                    <a type="button" class="btn btn-block btn-success"
                                                        href="{{ url('borrowal-book/edit/' . $book->id) }}">Edit</a>
                                                    <form method="POST" class="mt-2"
                                                        action="{{ url('/borrowal-book/return/' . $book->id) }}">
                                                        @csrf

                                                        <button type="submit"
                                                            class="btn btn-block btn-warning">Return</button>
                                            </td>

                                            </form>
                                    @endif

                                    </tr>
                                    @endforeach


                                </tbody>

                            </table>

                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $bookList->appends(request()->query())->links() }}
                            </ul>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
