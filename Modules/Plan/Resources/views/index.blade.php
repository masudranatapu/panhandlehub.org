@extends('admin.layouts.app')
@section('title')
    {{ __('plan_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">
            @if ($plans->count() > 0)
                <div class="col-sm-12 col-md-4">
                    @if (userCan('plan.update') && $plans->count())
                        <form action="{{ route('module.plan.recommended') }}" method="POST">
                            @csrf
                            <div>
                                <label class="" for="">{{ __('set_recommended_package') }}</label>
                            </div>
                            <div class="d-flex">
                                <select name="plan_id" class="form-control" id="">
                                    <option value="" hidden>{{ __('select_one') }}</option>
                                    @foreach ($plans as $plan)
                                        <option {{ $plan->recommended ? 'selected' : '' }} value="{{ $plan->id }}">
                                            {{ $plan->label }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary ml-2">{{ __('update') }}</button>
                            </div>
                        </form>
                    @endif
                </div>
            @endif
            <div class="col-sm-12 col-md-4">
                <form action="{{ route('module.plan.subscription') }}" method="POST">
                    @csrf
                    <div class="form-row align-items-end">
                        <div class="col-auto">
                            <x-forms.label name="default_subscription_type" for="inlineFormCustomSelect" class="mr-sm-2" />
                            <select name="subscription_type" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                <option {{ $setting->subscription_type == 'one_time' ? 'selected' : '' }} value="one_time">
                                    {{ __('one_time') }}
                                </option>
                                <option {{ $setting->subscription_type == 'recurring' ? 'selected' : '' }}
                                    value="recurring">
                                    {{ __('recurring') }}
                                </option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary "
                                style="margin-top:30px">{{ __('save') }}</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-12 col-md-4 text-md-right">
                <div>
                    <label class="" for=""></label>
                </div>
                @if (userCan('plan.create'))
                    <a href="{{ route('module.plan.create') }}" class="btn bg-primary rounded mt-2"><i
                            class="fas fa-plus"></i>&nbsp;
                        {{ __('create') }}
                    </a>
                @endif
            </div>
        </div>
        <div class="row h-100 mt-4">
            @forelse ($plans as $plan)
                <div class="col-md-6 col-lg-4 col-xl-3 mb-3 col-12">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header text-center py-4">
                            <h4>{{ $plan->label }}</h4>
                            @if ($plan->recommended)
                                <div class="badge badge-info">{{ __('recommended') }}</div>
                            @endif
                            @if ($plan->id == $setting->default_plan)
                                <div class="badge badge-secondary">{{ __('default') }}</div>
                            @endif
                            <div class="d-flex justify-content-center align-items-center text-center">
                                <h1 class="text-dark">
                                    {{ changeCurrency($plan->price) }}
                                </h1>
                                <div>
                                    @if ($setting->subscription_type == 'recurring')
                                        @if ($plan->interval == 'custom_date')
                                            <small>/{{ $plan->custom_interval_days }} {{ __('days') }}</small>
                                        @else
                                            <small>/{{ $plan->interval }}</small>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <p class="mb-0">{{ $plan->description }}</p>
                        </div>
                        <div class="card-body">
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        <x-svg.check-icon width="22" height="22" />
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('ads_limit') }} :
                                    </h5>
                                </div>
                                <h5 class="mb-0"> {{ $plan->ad_limit }}</h5>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        <x-svg.check-icon width="22" height="22" />
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('featured_ads_limit') }} :
                                    </h5>
                                </div>
                                <h5 class="mb-0"> {{ $plan->featured_limit }}</h5>
                            </div>
                            <div class="mb-2 align-items-center d-flex {{ $plan->frontend_show ? 'active' : '' }}">
                                <span class="icon mr-2">
                                    <x-svg.check-icon width="22" height="22" />
                                </span>
                                <h5 class="mb-0">
                                    @if ($plan->badge)
                                        {{ __('premium_badge') }}
                                    @else
                                        <del>{{ __('premium_badge') }}</del>
                                    @endif
                                </h5>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class=" d-flex justify-content-between">
                                @if (userCan('plan.update') || userCan('plan.delete'))
                                    @if (userCan('plan.update'))
                                        <a href="{{ route('module.plan.edit', $plan->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                            {{ __('edit') }}
                                        </a>
                                    @endif
                                    @if ($plan->id !== $setting->default_plan)
                                        @if (userCan('plan.delete'))
                                            <form action="{{ route('module.plan.delete', $plan->id) }}" class=""
                                                method="POST"
                                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}')">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger w-100-p">
                                                    <i class="fas fa-trash"></i>
                                                    {{ __('delete') }}
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <x-not-found route="module.plan.create" message="{{ __('no_data_found') }}" />
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>








    {{-- 
    <div class="container-fluid">
        @if (userCan('plan.update') && $plans->count())
            <div class="row align-items-end justify-content-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-2">
                        <form action="{{ route('module.plan.recommended') }}" method="POST" class="mr-4">
                            @csrf
                            <div class="form-row align-items-end">
                                <div class="col-auto">
                                    <x-forms.label name="set_recommended_package" for="inlineFormCustomSelect"
                                        class="mr-sm-2" />
                                    <select name="plan_id" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option value="" hidden>{{ __('select_plan') }}</option>
                                        @foreach ($plans as $plan)
                                            <option {{ $plan->recommended ? 'selected' : '' }}
                                                value="{{ $plan->id }}">
                                                {{ $plan->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary "
                                        style="margin-top:30px">{{ __('save') }}</button>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('module.plan.subscription') }}" method="POST">
                            @csrf
                            <div class="form-row align-items-end">
                                <div class="col-auto">
                                    <x-forms.label name="default_subscription_type" for="inlineFormCustomSelect"
                                        class="mr-sm-2" />
                                    <select name="subscription_type" class="custom-select mr-sm-2"
                                        id="inlineFormCustomSelect">
                                        <option {{ $setting->subscription_type == 'one_time' ? 'selected' : '' }}
                                            value="one_time">
                                            {{ __('one_time') }}
                                        </option>
                                        <option {{ $setting->subscription_type == 'recurring' ? 'selected' : '' }}
                                            value="recurring">
                                            {{ __('recurring') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary "
                                        style="margin-top:30px">{{ __('save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 d-flex mb-2 justify-content-end">
                    @if (userCan('plan.create'))
                        <a href="{{ route('module.plan.create') }}" class="btn2 d-inline-block">
                            <i class="fas fa-plus"></i>&nbsp; {{ __('add_plan') }}
                        </a>
                    @endif
                </div>
            </div>
        @endif
        <div class="row h-100 mt-4">
            @forelse ($plans as $plan)
                <div class="col-md-6 col-lg-4 col-xl-3 mb-3 col-12">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header text-center py-4">
                            <h4>{{ $plan->label }}</h4>
                            <span class="text-dark h2">{{ changeCurrency($plan->price) }}</span>
                            @if ($setting->subscription_type == 'recurring')
                                @if ($plan->interval == 'custom_date')
                                    <small>/{{ $plan->custom_interval_days }} {{ __('days') }}</small>
                                @else
                                    <small>/{{ $plan->interval }}</small>
                                @endif
                            @endif
                            <br>
                            @if ($plan->recommended)
                                <div class="badge badge-info">{{ __('recommended') }}</div>
                            @endif
                        </div>

                        <div class="card-body">
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        <x-svg.check-icon width="22" height="22"
                                            stroke="{{ $setting->frontend_primary_color }}" />
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('ads_limit') }}
                                    </h5>
                                </div>
                                <h5 class="mb-0"> {{ $plan->ad_limit }}</h5>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        <x-svg.check-icon width="22" height="22"
                                            stroke="{{ $setting->frontend_primary_color }}" />
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('featured_ads_limit') }}
                                    </h5>
                                </div>
                                <h5 class="mb-0"> {{ $plan->featured_limit }}</h5>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        @if ($plan->badge)
                                            <x-svg.check-icon width="22" height="22"
                                                stroke="{{ $setting->frontend_primary_color }}" />
                                        @else
                                            <x-svg.cross-icon width="22" height="22" stroke="#dc3545" />
                                        @endif
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('premium_badge') }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class=" d-flex justify-content-between">
                                @if (userCan('plan.update') || userCan('plan.delete'))
                                    @if (userCan('plan.update'))
                                        <a href="{{ route('module.plan.edit', $plan->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                            {{ __('edit_plan') }}
                                        </a>
                                    @endif
                                    @if (userCan('plan.delete'))
                                        <form action="{{ route('module.plan.delete', $plan->id) }}" class=""
                                            method="POST"
                                            onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger w-100-p">
                                                <i class="fas fa-trash"></i>
                                                {{ __('delete_plan') }}
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <x-not-found message="{{ __('no_data_found') }}" />
                            <p class="plan-p">{{ __('there_is_no_plan_found_in_this_page') }}.</p>
                            @if (userCan('plan.create'))
                                <a href="{{ route('module.plan.create') }}" class="plan-btn">
                                    {{ __('add_your_first_plan') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div> --}}
@endsection

@section('style')
    <style>
        .icon {
            height: 25px;
            width: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #007bff;
            border-radius: 50%;
            color: white;
        }
    </style>
@endsection

@section('script')
    <script>
        function MonthlyPrice(plan) {

            if ($('#customSwitch' + plan.id).is(":checked")) {
                $('#price' + plan.id).html("$" + plan.monthly_price);
                $('#monthoryear' + plan.id).html("{{ __('/monthly') }}");
            } else {
                $('#price' + plan.id).html("$" + plan.yearly_price);
                $('#monthoryear' + plan.id).html("{{ __('/yearly') }}");
            }
        }
    </script>
@endsection
