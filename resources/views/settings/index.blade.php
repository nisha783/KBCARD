@extends('layouts.app')
@section('content')
      <div class="col-md-9 p-4">
          <div class="d-flex justify-content-between mt-3">
            <h3 class="fw-bold">Discount</h3>
            <a href="{{ route('settings.create') }}" class="btn btn-primary mt-2 me-4">Add New Setting</a>
          </div>
            <table class="table table-borderd mt-5">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Key</th>
                        <th>Value</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  <tbody>
                    @forelse ($settings as $setting)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $setting->key }}</td>
                        <td>{{ $setting->value }}%</td>
                        <td>
                            <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No settings found.</td>
                    </tr>
                    @endforelse
                </tbody>
                
                </tbody>
            </table>
            {{ $settings->links('vendor.pagination.bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>
@endsection
