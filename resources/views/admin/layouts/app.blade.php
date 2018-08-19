<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('admin.layouts.head')

<body>
    <div id="app">
        @include('admin.layouts.header')
       

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
