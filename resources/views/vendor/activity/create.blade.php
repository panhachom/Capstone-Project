@extends('vendor/show')
@section('title', 'Activity')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <h3>Create New Activity</h3>
    <a href="{{ route('vendor.activity.index', ['vendor' => $vendor_id]) }}" class="btn btn-primary text-white">Back</a>
</div>

<div class="border p-5 rounded">
    <form method="POST" action="{{ route('vendor.activity.store', ['vendor' => $vendor_id]) }}">
        @csrf
        <div class="row">
            <div class="form-group col-12 my-2">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger my-1">
                    {{ $errors->first('name') }}
                </div>
            @endif
        
            <div class="form-group col-12 my-2">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" name="description" required>{{ old('description') }}</textarea>
            </div>
            @if ($errors->has('description'))
                <div class="alert alert-danger my-1">
                    {{ $errors->first('description') }}
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-success text-white mt-4">Create</button>
    </form>
</div>

@endsection