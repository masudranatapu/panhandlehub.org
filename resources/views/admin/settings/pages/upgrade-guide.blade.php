@extends('admin.settings.setting-layout')
@section('title')
    {{ __('upgrade_guide') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title" style="line-height: 36px;">{{ __('upgrade_guide') }}</h3>
            <strong>Current version {{ env('APP_VERSION') }}</strong>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                
            </div>
        </div>
        <div class="card-footer text-center">
            <form action="{{ route('settings.upgrade.apply') }}" method="POST">
                @csrf
                <button onclick="return confirm('Would you like to upgrade your application ?')" style="width: 250px;" type="submit" class="btn btn-primary">{{ __('upgrade_now') }}</button>
            </form>
        </div>
    </div>
@endsection

