@extends('admin.layouts.app')
@section('title')
    {{ __('faq_list') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title line-height-36">{{ __('faq_list') }}</h3>
            @if (userCan('faq.view'))
                <a href="{{ route('module.faq.category.index') }}"
                    class="btn bg-primary float-right d-flex align-items-center justify-content-center ml-2"><i
                        class="fas fa-th pr-2"></i>
                    {{ __('faq_category') }}</a>
            @endif
            @if (userCan('faq.create'))
                <a href="{{ route('module.faq.create') }}"
                    class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                        class="fas fa-plus pr-2"></i>
                    {{ __('create_faq') }}</a>
            @endif
        </div>
        <div class="card-body">
            <ul class="nav nav-pills mb-3">
                <li class="nav-item mr-3" role="presentation">
                    <a href="{{ route('module.faq.index') }}" class="nav-link bg-secondary">
                        @lang('all_faqs')
                        <span class="badge badge-pill badge-warning">{{ $all_faqs_count }}</span>
                    </a>
                </li>
                @foreach ($faq_category as $category)
                    <li class="nav-item mr-3" role="presentation">
                        <a class="nav-link bg-secondary"
                            href="{{ route('module.faq.index', $category->slug) }}">
                            {{ $category->name }}
                            <span class="badge badge-pill badge-warning">{{ $category->faqs_count }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-2">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link active" data-toggle="tab" href="#all">
                                {{ __('all') }}
                            </a>
                        </li>
                        @foreach ($faqs_group as $key => $faq)
                            <li class="nav-item border rounded mb-1">
                                <a class="nav-link" data-toggle="tab" href="#home_{{ $key }}">
                                    {{ getLanguageByCode($key) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-10">
                    <div class="tab-content no-padding">
                        <div class="tab-pane show active" id="all">
                            <div class="accordion" id="accordionExample">
                                @forelse($faqs as $faq)
                                    <div class="card mb-0">
                                        <div class="card-header p-0 d-flex align-items-center justify-content-between">
                                            <h4 class="card-title pt-2 w-100 py-3 px-3 pointer" id="heading{{ $faq->id }}"
                                                data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true"
                                                aria-controls="collapse{{ $faq->id }}">
                                                {{ $loop->iteration }}. {{ $faq->question }}
                                            </h4>
                                            <div class="d-flex align-items-center py-2 pr-3">
                                                @if (userCan('faq.delete'))
                                                    <form action="{{ route('module.faq.destroy', $faq->id) }}" method="POST"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top" title="{{ __('delete') }}"
                                                            onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                            class="btn bg-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                @if (userCan('faq.update'))
                                                    <a data-toggle="tooltip" data-placement="top" title="{{ __('edit') }}" href="{{ route('module.faq.edit', $faq->id) }}" class="btn bg-info ml-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="card">
                                        <div class="card-body text-center">
                                            @if (userCan('faq.create'))
                                                <x-admin.not-found word="faq" route="module.faq.create" />
                                            @else
                                                <x-admin.not-found word="faq" route="" />
                                            @endif
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        @foreach ($faqs_group as $key => $faqs)
                            <div class="tab-pane" id="home_{{ $key }}">
                                <div class="accordion" id="accordionExample">
                                    @forelse($faqs as $faq)
                                        <div class="card mb-0">
                                            <div class="card-header p-0 d-flex align-items-center justify-content-between">
                                                <h4 class="card-title pt-2 w-100 py-3 px-3 pointer" id="heading{{ $faq->id }}"
                                                    data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true"
                                                    aria-controls="collapse{{ $faq->id }}">
                                                    {{ $loop->iteration }}. {{ $faq->question }}
                                                </h4>
                                                <div class="d-flex align-items-center py-2 pr-3">
                                                    @if (userCan('faq.delete'))
                                                        <form action="{{ route('module.faq.destroy', $faq->id) }}" method="POST"
                                                            class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button data-toggle="tooltip" data-placement="top" title="{{ __('delete') }}"
                                                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                                class="btn bg-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (userCan('faq.update'))
                                                        <a href="{{ route('module.faq.edit', $faq->id) }}" class="btn bg-info ml-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}"
                                                data-parent="#accordionExample">
                                                <div class="card-body">
                                                    {!! $faq->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="card">
                                            <div class="card-body text-center">
                                                @if (userCan('faq.create'))
                                                    <x-admin.not-found word="faq" route="module.faq.create" />
                                                @else
                                                    <x-admin.not-found word="faq" route="" />
                                                @endif
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
