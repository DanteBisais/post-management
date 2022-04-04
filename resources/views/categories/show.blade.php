@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h2>Show category</h2>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <div>
                Title: {{ $Category->name }}
            </div>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('categories.edit', $Category->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('categories.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection