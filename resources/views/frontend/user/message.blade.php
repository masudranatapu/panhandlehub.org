@extends('frontend.layouts.app', ['nav' => 'yes'])

@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">User Profile</li>
                >
                <li class="breadcrumb-item active">Message</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="main_template mt-5">
    <div class="container">
        <div class="user_dashboard mb-4">
            @include('frontend.user.dashboard_nav')
        </div>
        <div class="user_dashboard_wrap">
            <div class="chat_box">
                <div class="row g-0">
                    <div class="col-12 col-lg-5 col-xl-3">
                        <div class="chat_user_wrapper">
                            <!-- user list -->
                            <a href="#" class="user_list active">
                                <div class="d-flex align-items-start">
                                    <img src="{{ asset('frontend/images/user2.jpg') }}" width="40" alt="">
                                    <div class="flex-grow-1 ml-3">
                                        <h3>Vanessa Tucker</h3>
                                        <span class="online">Active</span>
                                    </div>
                                </div>
                            </a>
                            <!-- user list -->
                            <a href="#" class="user_list">
                                <div class="d-flex align-items-start">
                                    <img src="{{ asset('frontend/images/user2.jpg') }}" width="40" alt="">
                                    <div class="flex-grow-1 ml-3">
                                        <h3>William Harris</h3>
                                        <span class="offline">Inactive</span>
                                    </div>
                                </div>
                            </a>
                            <!-- user list -->
                            <a href="#" class="user_list">
                                <div class="d-flex align-items-start">
                                    <img src="{{ asset('frontend/images/user.jpg') }}" width="40" alt="">
                                    <div class="flex-grow-1 ml-3">
                                        <h3>William Harris</h3>
                                        <span class="offline">Inactive</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-lg-7 col-xl-9">
                        <div class="selected_user header">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    <img src="{{ asset('frontend/images/user2.jpg') }}" class="rounded-circle me-2"
                                        alt="">
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <h5>Sharon Lessman</h5>
                                    <span>Active Now</span>
                                </div>

                            </div>
                        </div>

                        <div class="position-relative">
                            <div class="chat_messages">
                                <div class="chat_msg chat-message-right pb-4">
                                    <div>
                                        <img src="{{ asset('frontend/images/user.jpg') }}" width="40"
                                            class="rounded-circle ms-2" alt="">
                                        <div class="text-muted small text-nowrap mt-2">2:33
                                            am</div>
                                    </div>
                                    <div class="flex-shrink-1 rounded">

                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the
                                            industry's standard dummy text ever since the 1500s
                                        </p>
                                    </div>
                                </div>

                                <div class="chat_msg chat-message-left pb-4">
                                    <div>
                                        <img src="{{ asset('frontend/images/user2.jpg') }}" width="40"
                                            class="rounded-circle me-2" alt="">
                                        <div class="text-muted small text-nowrap mt-2">2:33
                                            am</div>
                                    </div>
                                    <div class="flex-shrink-1 rounded">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the
                                            industry's standard dummy text ever since the 1500s
                                        </p>
                                    </div>
                                </div>

                                <div class="chat_msg chat-message-right pb-4">
                                    <div>
                                        <img src="{{ asset('frontend/images/user.jpg') }}" width="40"
                                            class="rounded-circle ms-2" alt="">
                                        <div class="text-muted small text-nowrap mt-2">2:33
                                            am</div>
                                    </div>
                                    <div class="flex-shrink-1 rounded">

                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the
                                            industry's standard dummy text ever since the 1500s
                                        </p>
                                    </div>
                                </div>

                                <div class="chat_msg chat-message-left pb-4">
                                    <div>
                                        <img src="{{ asset('frontend/images/user2.jpg') }}" width="40"
                                            class="rounded-circle me-2" alt="">
                                        <div class="text-muted small text-nowrap mt-2">2:33
                                            am</div>
                                    </div>
                                    <div class="flex-shrink-1 rounded">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the
                                            industry's standard dummy text ever since the 1500s
                                        </p>
                                    </div>
                                </div>

                                <div class="chat_msg chat-message-right pb-4">
                                    <div>
                                        <img src="{{ asset('frontend/images/user.jpg') }}" width="40"
                                            class="rounded-circle ms-2" alt="">
                                        <div class="text-muted small text-nowrap mt-2">2:33
                                            am</div>
                                    </div>
                                    <div class="flex-shrink-1 rounded">

                                        <p>
                                            Lorem Ipsum is simply dummy text,
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="chat_form">
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input type="text" name="message" id="message" class="form-control"
                                        placeholder="Type your message" required="">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    // user chat box scroll bar set bottom
    $(function () {
        var ChatDiv = $('.chat_messages');
        var height = ChatDiv[0].scrollHeight;
        ChatDiv.scrollTop(height);
    });
</script>
@endpush
