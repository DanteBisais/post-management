@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h2>Update category</h2>
        <div class="lead">
            Edit category.
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('categories.update', $Category->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Category name</label>
                    <input value="{{ $Category->name }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name" required>

                    @if ($errors->has('category'))
                        <span class="text-danger text-left">{{ $errors->first('category') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('categories.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection