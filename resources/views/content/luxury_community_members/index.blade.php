@extends('layouts.layoutMaster')

@section('title', __('luxury_community.title'))

@section('content')
<div class="container">
    <h2 class="mb-4">{{ __('luxury_community.title') }}</h2>

    <a href="{{ route('dashboard.luxury-members.create') }}" class="btn btn-success mb-3">
        {{ __('luxury_community.create') }}
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('luxury_community.name') }}</th>
                <th>{{ __('luxury_community.title_col') }}</th>
                <th>{{ __('luxury_community.company') }}</th>
                <th>{{ __('luxury_community.email') }}</th>
                <th>{{ __('luxury_community.phone') }}</th>
                <th>{{ __('luxury_community.image') }}</th>
                <th>{{ __('luxury_community.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $index => $member)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $member->name_ar }}</td>
                    <td>{{ $member->title_ar }}</td>
                    <td>{{ $member->company }}</td>
                    <td>{{ $member->email ?? '-' }}</td>
                    <td>{{ $member->phone ?? '-' }}</td>
                    <td>
                        @if($member->image)
                            <img src="{{ asset($member->image) }}" width="50" height="50" class="rounded">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('dashboard.luxury-members.edit', $member->id) }}" class="btn btn-sm btn-primary">
                            {{ __('luxury_community.edit') }}
                        </a>
                        <form method="POST" action="{{ route('dashboard.luxury-members.destroy', $member->id) }}" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('luxury_community.confirm_delete') }}')">
                                {{ __('luxury_community.delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
