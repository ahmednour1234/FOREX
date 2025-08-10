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

    <div class="col-md-3">
        <select name="form_id" class="form-select">
            <option value="">{{ __('Registrations.all_forms') }}</option>
            @foreach ($forms as $form)
                <option value="{{ $form->id }}" {{ request('form_id') == $form->id ? 'selected' : '' }}>
                    {{ $form->number }}
                </option>
            @endforeach
        </select>
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
 <th>Experience</th>
            <th>Status</th>
            <th>{{ __('Registrations.created_at') }}</th>
            <th>{{ __('Registrations.actions') }}</th>
          </tr>
        </thead>
        <tbody>
           @forelse($clients as $client)
            <tr id="row-{{ $client->id }}">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $client->name }}</td>
              <td>{{ $client->email }}</td>
              <td>{{ $client->country_code }}</td>
              <td>{{ $client->phone }}</td>
              <td>{{ $client->job }}</td>
              <td>
                <span class="badge {{ $client->do_you_have_experince ? 'bg-success' : 'bg-danger' }}">
                  {{ $client->do_you_have_experince ? 'Yes' : 'No' }}
                </span>
              </td>
              <td>
                <span class="badge {{ $client->status == 'complete' ? 'bg-success' : 'bg-warning' }}">
                  {{ ucfirst($client->status) }}
                </span>
              </td>
              <td>{{ $client->created_at->format('Y-m-d') }}</td>
             <td>
  <div class="mb-2">
    <a href="{{ route('dashboard.clients.show', $client->id) }}" class="btn btn-sm btn-info btn-block">
      Show
    </a>
  </div>
  @if($client->status === 'pending')
    <div>
      <button class="btn btn-sm btn-outline-primary btn-block send-code-btn" data-id="{{ $client->id }}">
        Send Code
      </button>
    </div>
  @endif
</td>

            </tr>
          @empty
            <tr>
              <td colspan="10" class="text-center">No data found</td>
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
        @php
          $total = $clients->lastPage();
          $current = $clients->currentPage();
          $range = 1; // عدد الصفحات التي تُعرض قبل وبعد الصفحة الحالية
          $showPages = [];

          // عرض أول صفحتين
          for ($i = 1; $i <= 2 && $i <= $total; $i++) {
              $showPages[] = $i;
          }

          // عرض صفحتين قبل وبعد الحالية
          for ($i = $current - $range; $i <= $current + $range; $i++) {
              if ($i > 2 && $i < $total - 1) {
                  $showPages[] = $i;
              }
          }

          // عرض آخر صفحتين
          for ($i = $total - 1; $i <= $total; $i++) {
              if ($i > 2) {
                  $showPages[] = $i;
              }
          }

          $showPages = array_unique($showPages);
          sort($showPages);
        @endphp

        @php $last = 0; @endphp
        @foreach ($showPages as $page)
          @if ($last + 1 < $page)
            <li class="page-item disabled"><span class="page-link">...</span></li>
          @endif

          <li class="page-item {{ $page == $current ? 'active' : '' }}">
            <a class="page-link" href="{{ $clients->url($page) }}">{{ $page }}</a>
          </li>
          @php $last = $page; @endphp
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
{{-- JS for AJAX Send Code --}}
<script>
  document.querySelectorAll('.send-code-btn').forEach(button => {
    button.addEventListener('click', function () {
      const clientId = this.dataset.id;
      this.disabled = true;
      this.innerText = 'Sending...';

      fetch(`/api/dashboard/clients/${clientId}/send-code`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Verification code sent successfully!');
        } else {
          alert('Failed to send code.');
        }
      })
      .catch(() => alert('Error sending code.'))
      .finally(() => {
        this.disabled = false;
        this.innerText = 'Send Code';
      });
    });
  });
</script>
@endsection
