@extends('main')

@section('title', '| View Category')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h3 class="font-italic">Category</h3>
            <h1>{{$category->name}}</h1>
        </div>
        <div class="col-md-8">
            <table class="table">
                <thead>
                <th>#</th>
                <th>Title</th>
                <th>Created At</th>
                </thead>

                <tbody>

                @foreach ($category->posts as $post)

                    <tr>
                        <th>{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="well">
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('categories.edit', 'Edit', array($category->id), array('class' => 'btn btn-primary btn-block')) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE']) !!}

                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ Html::linkRoute('categories.index', '<< See All Categories', array(), ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                </div>
            </div>
        </div>
@endsection
