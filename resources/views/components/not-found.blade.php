@php
    $singuler = Str::plural($word, 1);
    $plural = Str::plural($word, 2);
@endphp

@if ($method == 'GET')
    <div class="empty py-5">
        <div class="empty-img">
            <img src="{{ asset('backend/image') }}/not-found.svg" height="128px" width="208px" alt="">
        </div>
        <h5 class="mt-4">{{ __('no_results_found') }}</h5>
        <p class="empty-subtitle text-muted">
            {{ __('there_is_no') }} {{ strtolower($plural) }} {{ __('found_in_the_page') }}
        </p>
        @if ($route)
            <div class="empty-action">
                <a href="{{ route($route) }}" class="d-flex justify-content-center align-items-center text-center">
                    {{-- <button type="button"
                        class="btn btn-primary d-flex justify-content-center align-items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span class="ml-2">{{ __('add_your_first') }} {{ strtolower($singuler) }}</span>
                    </button> --}}
                </a>
            </div>
        @endif
    </div>
@else
    <div class="empty py-5">
        <div class="empty-img">
            <img src="{{ asset('backend/image') }}/not-found.svg" height="128px" width="208px" alt="">
        </div>
        <h5 class="mt-4">{{ __('no_results_found') }}</h5>
        <p class="empty-subtitle text-muted">
            {{ __('there_is_no') }} {{ strtolower($plural) }} {{ __('found_in_the_page') }}
        </p>
        @if ($route)
            <div class="empty-action d-flex">
                @if ($route !== '')
                    <form action="{{ route($route) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            {{ __('add_your_first') }} {{ strtolower($singuler) }}
                        </button>
                    </form>
                @endif
            </div>
        @endif
    </div>
@endif
