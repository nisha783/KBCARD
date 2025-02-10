@extends('layouts.app')
@section('content')
      <div class="col-md-9 d-flex align-items-center justify-content-center" style="margin-bottom: 300px;">
        <div class="card w-50 shadow">
          <div class="card-body">
            <h4 class="card-title text-center mb-4 fw-bold">Edit Setting</h4>
            <form action="{{ route('settings.update', $setting->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="key" class="form-label">Key</label>
                <input type="text" name="key" id="key" class="form-control" value="{{ $setting->key }}" disabled>
              </div>
              <div class="mb-3">
                <label for="value" class="form-label">Value</label>
                <input type="text" name="value" id="value" class="form-control" value="{{ $setting->value }}">
              </div>

              <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

 @endsection
