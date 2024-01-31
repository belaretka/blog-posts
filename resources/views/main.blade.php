<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._head')
</head>

<body>

@include('partials._nav')

<div class="container">
    @include('partials._messages')

    <div class="content-area">
        @yield('content')
    </div>

    @include('partials._footer')
</div> <!-- end of .container -->

@include('partials._javascript')

@yield('scripts')

</body>
</html>
