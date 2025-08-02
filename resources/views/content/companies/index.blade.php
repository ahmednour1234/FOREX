@extends('layouts.layoutMaster')

@section('title', __('Companies'))

@section('content')
<div class="container">
    <h4 class="mb-4">{{ __('Companies List') }}</h4>

    <a href="{{ route('dashboard.companies.create') }}" class="btn btn-primary mb-3">
        + {{ __('Add Company') }}
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Name (AR)') }}</th>
                <th>{{ __('Name (EN)') }}</th>
                <th>{{ __('Country') }}</th>
                <th>{{ __('Votes') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($companies as $company)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $company->name_ar }}</td>
                    <td>{{ $company->name_en }}</td>
                    <td>{{ $company->country }}</td>
                    <td>{{ $company->count_vote }}</td>
                    <td>
                        @if ($company->active)
                            <span class="badge bg-success">{{ __('Active') }}</span>
                        @else
                            <span class="badge bg-danger">{{ __('Inactive') }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($company->image)
                            <img src="{{ asset($company->image) }}" alt="Image" width="60">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('dashboard.companies.show', $company->id) }}" class="btn btn-info btn-sm">{{ __('Show') }}</a>
                        <a href="{{ route('dashboard.companies.edit', $company->id) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>

                        @if($company->active)
                            <form action="{{ route('dashboard.companies.deactivate', $company->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Deactivate') }}</button>
                            </form>
                        @else
                            <form action="{{ route('dashboard.companies.activate', $company->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">{{ __('Activate') }}</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">{{ __('No companies found.') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $companies->links() }}
    </div>
</div>
@endsection
