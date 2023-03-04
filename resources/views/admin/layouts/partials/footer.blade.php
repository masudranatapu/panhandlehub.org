<footer class="main-footer">
    @php
        $string = preg_replace('/<\/?p>/i', '', cms('footer_text'));
    @endphp
    {!! $string !!}
    <div class="float-right d-none d-sm-inline-block">
        <b>{{ __('version') }}</b> {{ config('zakirsoft.app_version') }}
    </div>
</footer>
