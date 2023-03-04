<table class="table table-hover text-nowrap table-bordered">
    <thead>
        <tr class="text-center">
            <th width="5%">{{ __('thumbnail') }}</th>
            <th width="30%">{{ __('name') }}</th>
            <th>{{ __('price') }}</th>
            <th>{{ __('Ad Type') }}</th>
            @if ($showCategory)
                <th>{{ __('category') }}</th>
            @endif
            @if ($showCity)
                <th>{{ __('country') }}</th>
            @endif
            @if ($showCustomer)
                <th>{{ __('author') }}</th>
            @endif
            <th>{{ __('status') }}</th>
            <th width="5%">{{ __('actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ads as $key =>$ad)
            <tr>
                <td class="text-center">
                    <img src="{{ $ad->image_url }}" class="rounded" height="50px" width="50px" alt="image">
                </td>
                <td class="text-center">
                    {{ $ad->title }}
                    @if ($ad->featured)
                        <span class="badge badge-warning">
                            {{ __('featured') }}
                        </span>
                    @endif
                </td>
                <td class="text-center">
                    {{ changeCurrency($ad->price) }}
                </td>
                <td class="text-center">
                    {{ $ad->ad_type->name }}
                </td>
                @if ($showCategory)
                    <td class="text-center">
                        <a href="{{ route('module.category.show', $ad->category->slug) }}">{{ $ad->category->name }}</a>
                    </td>
                @endif
                @if ($showCity)
                    <td class="text-center">
                        <a href="javascript:void(0)">
                            {{ $ad->countries->name ?? '-' }}
                        </a>
                    </td>
                @endif
                @if ($showCustomer)
                    <td class="text-center">
                        <a href="{{ route('module.customer.show', ['customer' => $ad->customer->username]) }}">
                            {{ $ad->customer->username }}
                        </a>
                    </td>
                @endif
                <td class="text-center">
                    <button type="button"
                        class="dropdown-toggle btn-sm btn btn-{{ $ad->status == 'active' ? 'success' : ($ad->status == 'pending' ? 'warning' : 'secondary') }}"
                        data-toggle="dropdown" aria-expanded="false">
                        {{ ucfirst($ad->status) }}
                    </button>
                    <ul class="dropdown-menu" x-placement="bottom-start"
                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        @if ($ad->status == 'pending' || $ad->status == 'sold' || $ad->status == 'declined')
                            <li><a onclick="return confirm('Are you sure to perform this action?')"
                                    class="dropdown-item"
                                    href="{{ route('module.ad.status', [$ad->slug, 'active']) }}">
                                    <i class="fas fa-check text-success"></i> {{ __('mark_as_active') }}
                                </a>
                            </li>
                        @endif
                        @if ($ad->status == 'active')
                            <li><a onclick="return confirm('Are you sure to perform this action?')"
                                    class="dropdown-item"
                                    href="{{ route('module.ad.status', [$ad->slug, 'sold']) }}">
                                    <i class="fas fa-hourglass-end text-danger"></i> {{ __('mark_as_sold') }}
                                </a>
                            </li>
                        @endif
                        @if ($ad->status == 'pending' && $settings->ads_admin_approval)
                            <li><a onclick="return confirm('Are you sure to perform this action?')"
                                    class="dropdown-item"
                                    href="{{ route('module.ad.status', [$ad->slug, 'declined']) }}">
                                    <i class="fas fa-times text-danger"></i> {{ __('mark_as_declined') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                        {{ __('options') }}
                    </button>
                    <ul class="dropdown-menu" x-placement="bottom-start"
                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <li><a class="dropdown-item" href="{{ route('frontend.details', $ad->slug) }}" target="_blank">
                                <i class="fas fa-eye text-info"></i> {{ __('view_details') }}
                            </a></li>
                        {{-- <li><a class="dropdown-item" href="{{ route('frontend.details', $ad->slug) }}">
                                <i class="fas fa-link text-secondary"></i> {{ __('website_link') }}
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('module.ad.edit', $ad->id) }}">
                                <i class="fas fa-edit text-success"></i> {{ __('edit_ad') }}
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('module.ad.show_gallery', $ad->id) }}">
                                <i class="fas fa-images text-warning"></i></i> {{ __('ad_gallary') }}
                            </a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('module.ad.custom.field.value.edit', $ad->id) }}">
                                <i class="fas fa-edit text-info"></i> {{ __('edit_custom_fields') }}
                            </a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('module.ad.custom.field.value.sorting', $ad->id) }}">
                                <i class="fas fa-arrows-alt text-warning"></i> {{ __('sorting_custom_fields') }}
                            </a>
                        </li> --}}
                        <li>
                            <form action="{{ route('module.ad.destroy', $ad->id) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="dropdown-item"
                                    onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}?');">
                                    <i class="fas fa-trash text-danger"></i> {{ __('delete_ad') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center">
                    <x-not-found word="Ad" route="module.ad.create" />
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
