@extends('admin.layouts.app')
@section('title')
    {{ __('post_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-sticky-note"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('total_post') }}</span>
                        <span class="info-box-number">
                            {{ $total_posts ?? '0' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-th"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('total_category') }}</span>
                        <span class="info-box-number">{{ $total_categories ?? '0' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 p-1">
                                <h3 class="card-title line-height-36">{{ __('post_list') }}</h3>
                            </div>
                            <div class="col align-self-end p-1">
                                @if (userCan('post.create'))
                                    <a href="{{ route('module.post.create') }}"
                                        class="btn btn-secondary float-right d-flex align-items-center justify-content-center"><i
                                            class="fas fa-plus"></i>&nbsp;{{ __('create_post') }}</a>
                                @endif
                                @if (userCan('postcategory.create'))
                                    <a href="{{ route('module.postcategory.index') }}"
                                        class="btn bg-success float-right d-flex align-items-center mx-1 justify-content-center">
                                        <i class="fas fa-plus"></i>&nbsp;{{ __('create_category') }}
                                    </a>
                                @endif
                                @if (userCan('postcategory.view'))
                                    <a href="{{ route('module.postcategory.index') }}"
                                        class="btn btn-outline-primary float-right d-flex align-items-center justify-content-center mx-1">
                                        <i class="fas fa-eye"></i>&nbsp;{{ __('all_category') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <!-- filter -->
                        <form id="formSubmit" action="" method="GET" onchange="this.submit();">
                            <div class="card-body border-bottom row">
                                <div class="col-12 col-md-3">
                                    <label>{{ __('search') }}</label>
                                    <input name="keyword" type="text" placeholder="{{ __('title') }}"
                                        class="form-control" value="{{ request('keyword') }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label>{{ __('category') }}</label>
                                    <select name="category" class="form-control w-100-p">
                                        <option value="" {{ !request('category') ? 'selected' : '' }}>
                                            {{ __('all') }}
                                        </option>
                                        @foreach ($categories as $category)
                                            <option {{ request('category') == $category->slug ? 'selected' : '' }}
                                                value="{{ $category->slug }}">
                                                {{ Str::ucfirst($category->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3 col-md-1">
                                    <label></label>
                                    <button type="submit" class="mt-2 form-control btn btn-primary">
                                        {{ __('search') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row" class="text-center">
                                            <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1"
                                                aria-label="Rendering engine: activate to sort column ascending"
                                                aria-sort="descending" width="10%">{{ __('image') }}</th>
                                            <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1"
                                                aria-label="Rendering engine: activate to sort column ascending"
                                                aria-sort="descending" width="50%">{{ __('title') }}</th>
                                            <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1"
                                                aria-label="Rendering engine: activate to sort column ascending"
                                                aria-sort="descending" width="20%">{{ __('category') }}</th>
                                            @if (userCan('post.edit') || userCan('post.delete'))
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                                    width="100px"> {{ __('actions') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($posts->count() > 0)
                                            @foreach ($posts as $post)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1 text-center" tabindex="0"><img width="50px"
                                                            height="50px" class="rounded" src="{{ $post->image_url }}"
                                                            alt=""></td>
                                                    <td class="sorting_1 text-center" tabindex="0">{{ $post->title }}
                                                    </td>
                                                    <td class="sorting_1 text-center" tabindex="0">
                                                        {{ Str::ucfirst($post->category->name) }}</td>
                                                    @if (userCan('post.update') || userCan('post.delete'))
                                                        <td class="sorting_1 text-center" tabindex="0">
                                                            @if (userCan('post.update'))
                                                                <a data-toggle="tooltip" data-placement="top"
                                                                    title="{{ __('edit_post') }}"
                                                                    href="{{ route('module.post.edit', $post->id) }}"
                                                                    class="btn bg-info"><i class="fas fa-edit"></i></a>
                                                            @endif
                                                            @if (userCan('post.delete'))
                                                                <form
                                                                    action="{{ route('module.post.destroy', $post->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button data-toggle="tooltip" data-placement="top"
                                                                        title="{{ __('delete_post') }}"
                                                                        onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                                        class="btn bg-danger"><i
                                                                            class="fas fa-trash"></i></button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center" colspan="4">{{ __('no_data_found') }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                @if (request('perpage') != 'all' && $posts->total() > $posts->count())
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-center">
                                            {{ $posts->links() }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
