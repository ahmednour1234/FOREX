@extends('layouts.layoutMaster')

@section('title', __('Registrations.title'))

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">{{ __('Registrations.title') }}</h4>

    <div class="d-flex gap-2">
      <a href="{{ route('dashboard.clients.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> {{ __('Registrations.add') }}
      </a>
      <a href="{{ route('dashboard.clients.excel') }}" class="btn btn-secondary">
        <i class="fas fa-file-excel"></i> {{ __('Registrations.excel_tools') }}
      </a>
    </div>
  </div>

  <div class="card-body">
    {{-- Filters --}}
    <form method="GET" class="row g-3 mb-4">
      <div class="col-md-3">
        <input type="text" name="name" class="form-control" placeholder="{{ __('Registrations.name') }}" value="{{ request('name') }}">
      </div>
      <div class="col-md-3">
        <input type="text" name="phone" class="form-control" placeholder="{{ __('Registrations.phone') }}" value="{{ request('phone') }}">
      </div>
      <div class="col-md-3">
        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
      </div>
      <div class="col-md-3">
        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
      </div>
      <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary">{{ __('Registrations.search') }}</button>
      </div>
    </form>

    {{-- Table --}}
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>{{ __('Registrations.name') }}</th>
            <th>{{ __('Registrations.email') }}</th>
            <th>{{ __('Registrations.country_code') }}</th>
            <th>{{ __('Registrations.phone') }}</th>
            <th>{{ __('Registrations.job') }}</th>
            <th>{{ __('Registrations.active') }}</th>
            <th>{{ __('Registrations.created_at') }}</th>
            <th>{{ __('Registrations.actions') }}</th>
          </tr>
        </thead>
        <tbody>
          @forelse($clients as $client)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $client->name }}</td>
              <td>{{ $client->email }}</td>
              <td>{{ $client->country_code }}</td>
              <td>{{ $client->phone }}</td>
              <td>{{ $client->job }}</td>
              <td>
                <span class="badge {{ $client->active ? 'bg-success' : 'bg-secondary' }}">
                  {{ $client->active ? __('Registrations.active_yes') : __('Registrations.active_no') }}
                </span>
              </td>
              <td>{{ $client->created_at->format('Y-m-d') }}</td>
              <td>
                <a href="{{ route('dashboard.clients.show', $client->id) }}" class="btn btn-sm btn-info">
                  {{ __('Registrations.show') }}
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="text-center">{{ __('Registrations.no_data') }}</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
      @if ($clients->hasPages())
        <nav>
          <ul class="pagination justify-content-center">
            {{-- Previous --}}
            @if ($clients->onFirstPage())
              <li class="page-item disabled"><span class="page-link">‹</span></li>
            @else
              <li class="page-item">
                <a class="page-link" href="{{ $clients->previousPageUrl() }}" rel="prev">‹</a>
              </li>
            @endif

            {{-- Pages --}}
            @foreach ($clients->getUrlRange(1, $clients->lastPage()) as $page => $url)
              <li class="page-item {{ $clients->currentPage() == $page ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
              </li>
            @endforeach

            {{-- Next --}}
            @if ($clients->hasMorePages())
              <li class="page-item">
                <a class="page-link" href="{{ $clients->nextPageUrl() }}" rel="next">›</a>
              </li>
            @else
              <li class="page-item disabled"><span class="page-link">›</span></li>
            @endif
          </ul>
        </nav>
      @endif
    </div>
  </div>
</div>
@endsection
