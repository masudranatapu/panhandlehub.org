@extends('admin.layouts.app')
@section('title')
    {{ __('category_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('category_list') }}</h3>
                        @if (userCan('post.view'))
                            <a href="{{ route('module.post.index') }}"
                                class="btn btn-primary float-right d-flex align-items-center justify-content-center mx-1">
                                <i class="fas fa-eye"></i>
                                <span class="ml-2">{{ __('all_posts') }}</span>
                            </a>
                        @endif
                    </div>
                    <div class="">
                        <div class="row p-4">
                            @forelse ($categories as $key => $category)
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="card card-margin">
                                        <div class="card-body pt-0">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper mt-4 items-align-center">
                                                    <div class="widget-49-date-pridmary">
                                                        <img class="rounded" width="50px" height="50px"
                                                            src="{{ $category->image_url }}" alt="category image">
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="text-capitalize text--xl">
                                                            {{ $category->name }}
                                                        </span>
                                                        <span class="widget-49-meeting-time -mt-5">
                                                            {{ date('M d, Y', strtotime($category->created_at)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="widget-49-meeting-action">
                                                    @if (userCan('postcategory.update'))
                                                        <a href="{{ route('module.postcategory.index', $category->slug) }}"
                                                            class="btn btn-sm btn-outline-primary mr-1">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    @if (userCan('postcategory.delete'))
                                                        <form
                                                            action="{{ route('module.postcategory.destroy', $category->id) }}"
                                                            method="POST" class="d-inline mt-2">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button data-toggle="tooltip" data-placement="top"
                                                                title="{{ __('delete_tag') }}"
                                                                onclick="return confirm('Are you sure to delete this item?')"
                                                                class="btn btn-sm btn-outline-danger"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <x-not-found route="" word="Category" />
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @if ($categories->total() > $categories->count())
                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">
                            @if ($edit_category)
                                <span>{{ __('edit_category') }}</span>
                            @else
                                <span>{{ __('add_category') }}</span>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        @if ($edit_category && userCan('postcategory.update'))
                            <form class="form-horizontal"
                                action="{{ route('module.postcategory.update', $edit_category->slug) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <x-forms.label name="name" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $edit_category->name }}" name="name" type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            placeholder="{{ __('enter_name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="change_image" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input accept="image/*" value="{{ old('name') }}" name="image" type="file"
                                            class="form-control border-0 pl-0 {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-12">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>&nbsp;
                                            {{ __('update') }}</button>
                                        <a href="{{ route('module.postcategory.index') }}" class="btn btn-danger"><i
                                                class="fas fa-times"></i>&nbsp; {{ __('cancel') }}</a>
                                    </div>
                                </div>
                            </form>
                        @elseif (!$edit_category && userCan('postcategory.create'))
                            <form class="form-horizontal" action="{{ route('module.postcategory.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="name" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('name') }}" name="name" type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            placeholder="{{ __('enter_name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="image" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input accept="image/*" value="{{ old('name') }}" name="image"
                                            type="file"
                                            class="form-control border-0 pl-0 {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                            {{ __('create') }}</button>
                                    </div>
                                </div>
                            </form>
                        @endif
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
    </style>
@endsection
