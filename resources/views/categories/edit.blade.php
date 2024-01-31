@extends('main')

@section('title', '| Edit Category')

@section('stylesheets')

    {!! Html::style('css/select2.min.css') !!}

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link code',
            menubar: false
        });
    </script>

@endsection

@section('content')
    <div class="row">
        {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PUT']) !!}
        <div class="col-md-3">
            {{ Form::label('name', 'Category Name:')  }}
            {{ Form::text('name', null, ["class" => 'form-control']) }}

            {{ Form::label('posts', 'Posts:', ['class' => 'form-spacing-top']) }}
            {{ Form::select('posts[]', $posts, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}
        </div>
        <div class="col-md-3">
            <div class="well">
                <div class="row">
                    <div class="col-sm-12">
                        {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                    <hr>
                    <div class="col-lg-12">
                        {!! Html::linkRoute('categories.show', 'Cancel', array($category->id), array('class' => 'btn btn-danger btn-block')) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('scripts')

    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">

        $('.select2-multi').select2();
        $('.select2-multi').select2().val({!! json_encode($category->posts()->allRelatedIds()) !!}).trigger('change');

    </script>

@endsection
