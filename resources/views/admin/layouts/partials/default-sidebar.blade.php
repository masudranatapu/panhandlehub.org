<aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- style="background-color: {{ $setting->dark_mode ? '' : $setting->sidebar_color }}"> --}}
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ $setting->favicon_image_url }}" alt="{{ __('Logo') }}" class="elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-nav-wrapper">
            <!-- Sidebar Menu -->
            <nav class="sidebar-main-nav mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @if ($user->can('dashboard.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('admin.dashboard') ? true : false" route="admin.dashboard" icon="fas fa-tachometer-alt">
                            {{ __('dashboard') }}
                        </x-admin.sidebar-list>
                    @endif
                    <li class="nav-header">{{ __('customer') }}</li>
                    {{-- @if (userCan('order.view'))
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}"
                                class="nav-link {{ Route::is('order.*') ? ' active' : '' }}">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>{{ __('order') }}</p>
                            </a>
                        </li>
                    @endif --}}
                    {{-- @if (Module::collections()->has('Customer') && userCan('customer.view')) --}}
                    <li class="nav-item">
                        <a href="{{ route('module.customer.index') }}"
                            class="nav-link {{ Route::is('module.customer.*') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>{{ __('customer') }}</p>
                        </a>
                    </li>
                    {{-- @endif --}}
                    {{-- @if (Module::collections()->has('Plan') && userCan('plan.view') && $priceplan_enable)
                        <x-sidebar-list :linkActive="Route::is('module.plan.index') || Route::is('module.plan.create') ? true : false" route="module.plan.index" icon="fas fa-credit-card">
                            {{ __('pricing_plan') }}
                        </x-sidebar-list>
                    @endif
                    <x-sidebar-list :linkActive="Route::is('report.index') ? true : false" route="report.index" icon="fas fa-file">
                        {{ __('seller_report') }}
                    </x-sidebar-list> --}}

                    <li class="nav-header">{{ __('ads') }}</li>
                    @if (Module::collections()->has('Ad') && userCan('ad.view'))
                        <x-sidebar-list :linkActive="Route::is('module.ad.*') ? true : false" route="module.ad.index" icon="fas fa-store">
                            {{ __('all_listings') }}
                        </x-sidebar-list>
                    @endif
                    <x-sidebar-list :linkActive="Route::is('adtypes.*') ? true : false" route="adtypes.index" icon="fa fa-bars">
                        {{ __('Ad Types') }}
                    </x-sidebar-list>

                    <x-sidebar-list :linkActive="Route::is('transaction.*') ? true : false" route="transaction.index" icon="fa fa-outdent">
                        {{ __('Transaction') }}
                    </x-sidebar-list>

                    <x-sidebar-list :linkActive="Route::is('city.*') ? true : false" route="city.index" icon="fa fa-plus-square">
                        {{ __('City') }}
                    </x-sidebar-list>

                    @if (Module::collections()->has('Category') && (userCan('category.view') || userCan('subcategory.view')))
                        <x-admin.sidebar-list :linkActive="Route::is('module.category.*') || Route::is('module.subcategory.*') ? true : false" route="module.category.index" icon="fas fa-th">
                            {{ __('category') }}
                        </x-admin.sidebar-list>
                    @endif
                    {{-- @if (Module::collections()->has('CustomField') && userCan('custom-field.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.custom.field.*') ? true : false" route="module.custom.field.index" icon="fas fa-edit">
                            {{ __('custom_field') }}
                        </x-admin.sidebar-list>
                    @endif --}}
                    {{-- @if (Module::collections()->has('Location'))
                        @if (userCan('city.view') || userCan('town.view'))
                            <x-sidebar-dropdown :linkActive="Route::is('module.city.*') || Route::is('module.town.*') ? true : false" :subLinkActive="Route::is('module.city.*') || Route::is('module.town.*') ? true : false" icon="fas fa-location-arrow">
                                @slot('title')
                                    {{ __('location') }}
                                @endslot

                                @if (userCan('city.view'))
                                    <ul class="nav nav-treeview">
                                        <x-sidebar-list :linkActive="Route::is('module.city.*') ? true : false" route="module.city.index"
                                            icon="fas fa-circle">
                                            {{ __('city') }}
                                        </x-sidebar-list>
                                    </ul>
                                @endif
                                @if (userCan('town.view'))
                                    <ul class="nav nav-treeview">
                                        <x-sidebar-list :linkActive="Route::is('module.town.*') ? true : false" route="module.town.index"
                                            icon="fas fa-circle">
                                            {{ __('town') }}
                                        </x-sidebar-list>
                                    </ul>
                                @endif

                            </x-sidebar-dropdown>
                        @endif
                    @endif --}}
                    {{-- @if (Module::collections()->has('Brand') && userCan('brand.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.brand.*') ? true : false" route="module.brand.index" icon="fas fa-award">
                            {{ __('brand') }}
                        </x-admin.sidebar-list>
                    @endif --}}

                    {{-- @if (Module::collections()->has('Map') && userCan('map.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.map.*') ? true : false" route="module.map.index" icon="fas fa-map-marker-alt">
                            {{ __('map') }}
                        </x-admin.sidebar-list>
                    @endif --}}

                    <li class="nav-header">{{ __('others') }}</li>
                    @if ($user->can('admin.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('user.*') || Route::is('role.*') ? true : false" route="user.index" icon="fas fa-users">
                            {{ __('user_role_manage') }}
                        </x-admin.sidebar-list>
                    @endif
                    {{-- Newsletter Subscription --}}
                    {{-- @if (Module::collections()->has('Newsletter') && $newsletter_enable)
                        @if (userCan('newsletter.view') || userCan('newsletter.mailsend'))
                            <x-sidebar-dropdown :linkActive="Route::is('module.newsletter.*') ? true : false" :subLinkActive="Route::is('module.newsletter.*') ? true : false" icon="fas fa-envelope">
                                @slot('title')
                                    {{ __('newsletter') }}
                                @endslot

                                @if (userCan('newsletter.view'))
                                    <ul class="nav nav-treeview">
                                        <x-sidebar-list :linkActive="Route::is('module.newsletter.index') ? true : false" route="module.newsletter.index"
                                            icon="fas fa-circle">
                                            {{ __('emails') }}
                                        </x-sidebar-list>
                                    </ul>
                                @endif
                                @if (userCan('newsletter.mailsend'))
                                    <ul class="nav nav-treeview">
                                        <x-sidebar-list :linkActive="Route::is('module.newsletter.send_mail') ? true : false" route="module.newsletter.send_mail"
                                            icon="fas fa-circle">
                                            {{ __('send_mail') }}
                                        </x-sidebar-list>
                                    </ul>
                                @endif

                            </x-sidebar-dropdown>
                        @endif
                    @endif --}}

                    <!-- Blog and Tag -->
                    {{-- @if (Module::collections()->has('Blog') && userCan('post.view') && $blog_enable)
                        <x-admin.sidebar-list :linkActive="Route::is('module.post.*') || Route::is('module.postcategory.*')  ? true : false" route="module.post.index" icon="fas fa-blog">
                            {{ __('blog') }}
                        </x-admin.sidebar-list>
                    @endif --}}
                    <!-- Blog and Tag End -->

                    {{-- @if (Module::collections()->has('Testimonial') && userCan('testimonial.view') && $testimonial_enable)
                        <x-admin.sidebar-list :linkActive="Route::is('module.testimonial.*') ? true : false" route="module.testimonial.index" icon="fas fa-comment">
                            {{ __('testimonial') }}
                        </x-admin.sidebar-list>
                    @endif --}}
                    <x-admin.sidebar-list :linkActive="Route::is('faq.*') ? true : false" route="faq.index" icon="fas fa-question">
                        {{ __('faq') }}
                    </x-admin.sidebar-list>
                    <x-admin.sidebar-list :linkActive="Route::is('contact.*') ? true : false" route="contact.index" icon="fa fa-phone-square">
                        {{ __('User Contact') }}
                    </x-admin.sidebar-list>
                    @if ($settings->ads_admin_approval)
                        <form action="{{ route('module.ad.index') }}" method="GET" id="pending_ads_form">
                            <input name="filter_by" type="text" value="pending" hidden>
                            <input name="sort_by" type="text" value="latest" hidden>
                        </form>
                        <button onclick="$('#pending_ads_form').submit();" type="button"
                            class="btn btn-primary mt-4 mx-3 text-white mb-3">
                            {{ __('pending_ads') }}
                        </button>
                    @endif
                </ul>
            </nav>
            <!-- Sidebar Menu -->
            <nav class="mt-2 nav-footer" style="border-top: 1px solid gray; padding-top: 20px;">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a target="_blank" href="/" class="nav-link"
                            style="background-color: #007bff; color: #fff;">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>{{ __('visit_website') }}</p>
                        </a>
                    </li>
                    @if ($user->can('setting.view') || $user->can('setting.update'))
                        <x-admin.sidebar-list :linkActive="request()->is('admin/settings/*') ? true : false" route="settings.general" icon="fas fa-cog">
                            {{ __('settings') }}
                        </x-admin.sidebar-list>
                    @endif
                    <li class="nav-item">
                        <a href="javascript:void(0" class="nav-link"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>{{ __('logout') }} </p>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            class="d-none invisible">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
