@extends('layouts.app')

@section('content')
    <div class="col-md-9 d-flex align-items-center justify-content-center" style="margin-bottom: 300px;">
        <div class="card w-50">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Add New Setting</h4>
                <form action="{{ route('settings.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="key" class="form-label">Key</label>
                        <input type="text" name="key" id="key"
                            class="form-control @error('key') is-invalid @enderror">
                        @error('key')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">Value</label>
                        <input type="text" name="value" id="value"
                            class="form-control @error('value') is-invalid @enderror">
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-primary w-100">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
