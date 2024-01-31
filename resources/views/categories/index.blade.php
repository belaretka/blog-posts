@extends('main')

@section('title', '| All Categories')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Categories</h1>
            <hr>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th>{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td><td><a href="{{ route('categories.show', $category->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-default btn-sm">Edit</a></td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-3">
            <div class="well">
                {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
                <h2>New Category</h2>
                <hr>
                <div>
                    {{ Form::label('name', 'Name:') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
                <div>
                    {{ Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block btn-h2-spacing']) }}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
