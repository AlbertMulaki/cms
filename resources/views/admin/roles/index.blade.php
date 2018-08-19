@extends('admin.layouts.app')

@section('content')
    @foreach ($roles as $role)
        {{ $role->name }}
    @endforeach
@endsection