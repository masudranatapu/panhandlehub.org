<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ request()->routeIs('user.setting') ? 'active' : "" }}" id="setting-tab"
            data-bs-toggle="tab" data-bs-target="#setting-tab-pane" type="button" role="tab"
            aria-controls="setting-tab-pane" aria-selected="false"><a
                href="{{ route('user.setting') }}">Profile</a></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ request()->routeIs('user.profile') ? 'active' : "" }}" id="posting-tab"
            data-bs-toggle="tab" data-bs-target="#posting-tab-pane" type="button" role="tab"
            aria-controls="posting-tab-pane" aria-selected="true"><a href="{{ route('user.profile') }}">Published
                Ad</a></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ request()->routeIs('user.drafts') ? 'active' : "" }}" id="drafts-tab"
            data-bs-toggle="tab" data-bs-target="#drafts-tab-pane" type="button" role="tab"
            aria-controls="drafts-tab-pane" aria-selected="false"><a href="{{ route('user.drafts') }}">Unpublished
                Ad</a></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ request()->routeIs('user.favourite') ? 'active' : "" }}" id="searches-tab"
            data-bs-toggle="tab" data-bs-target="#searches-tab-pane" type="button" role="tab"
            aria-controls="searches-tab-pane" aria-selected="false"><a
                href="{{ route('user.favourite') }}">Favourites</a></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ request()->routeIs('user.transaction') ? 'active' : "" }}" id="searches-tab"
            data-bs-toggle="tab" data-bs-target="#searches-tab-pane" type="button" role="tab"
            aria-controls="searches-tab-pane" aria-selected="false"><a
                href="{{ route('user.transaction') }}">Transaction</a></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ request()->routeIs('user.message') ? 'active' : "" }}" id="searches-tab"
            data-bs-toggle="tab" data-bs-target="#searches-tab-pane" type="button" role="tab"
            aria-controls="searches-tab-pane" aria-selected="false"><a
                href="{{ route('user.message') }}">Message</a></button>
    </li>
    
</ul>
