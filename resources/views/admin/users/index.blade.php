@extends('admin.layouts.app')
@section('title')
    {{ __('users_list') }}
@endsection

@section('content')
    @php
        $userr = Auth::user();
    @endphp

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title" style="line-height: 36px;">{{ __('users_list') }}</h3>
                            <div class="d-flex align-items center">
                                <a href="{{ route('role.index') }}" class="btn btn-outline-dark mr-2">
                                    <i class="fas fa-lock mr-1"></i>
                                    {{ __('all_roles') }}
                                </a>
                                <a href="{{ route('user.create') }}" class="btn bg-primary">
                                    <i class="fas fa-plus mr-1"></i> &nbsp;
                                    {{ __('create_user') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="row">
                            @forelse ($users as $key => $user)
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="card card-margin position-releative">
                                        <div class="card-body pt-0">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper mt-4 items-align-center">
                                                    <div class="widget-49-date-pridmary">
                                                        <img class="rounded" width="50px" height="50px"
                                                            src="{{ $user->image_url }}" alt="category image">
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="text-capitalize text--xl">
                                                            {{ $user->name }}
                                                        </span>
                                                        <span class="widget-49-meeting-time -mt-5">
                                                            {{ $user->email }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="widget-49-meeting-action">
                                                    @if (userCan('brand.update'))
                                                        <a href="{{ route('user.edit', $user->id) }}"
                                                            class="btn btn-sm btn-outline-primary mr-1">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    @if (userCan('brand.delete'))
                                                        <form action="{{ route('user.destroy', $user->id) }}"
                                                            method="POST" class="d-inline mt-2">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button data-toggle="tooltip" data-placement="top"
                                                                title="{{ __('delete_tag') }}"
                                                                class="btn btn-sm btn-outline-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-absolute badge bg-primary px-4 custom-badge">
                                        @foreach ($user->roles as $key => $role)
                                            <span
                                                class="visually-hidden text-capitalize {{ $user->roles->count() > 1 ? 'mr-1' : '' }}">
                                                {{ $role->name }}
                                                {{ $user->roles->count() > 1 && $user->roles->count() != $key + 1 ? ' ,' : '' }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <x-not-found route="user.create" word="user" />
                                </div>
                            @endforelse
                        </div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <x-admin.simple-card-design />
    <style>
        .text--xl {
            font-size: 30px;
            margin: 0;
        }

        .-mt-5 {
            margin-top: -5px;
        }

        .text--xl {
            font-size: 1.5rem !important;
        }

        .custom-badge {
            top: 0;
            right: 0;
            top: -5px;
            height: 31px;
            line-height: 24px;
        }
    </style>
@endsection
