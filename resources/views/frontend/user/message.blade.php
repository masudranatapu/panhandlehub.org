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
                    <div class="dashboard_wrapper p-0">
                        <div class="recent_ads">
                            <div class="chat_box">
                                <div class="card">
                                    <div class="row g-0">
                                        <div class="col-12 col-lg-5 col-xl-3 border-right">
                                            <!-- user list -->
                                            <div class="chat_user_wrapper">
                                                @forelse ($users as $chatuser)
                                                <a href="{{ route('user.message', $chatuser->username) }}"
                                                    class="user_list {{ request()->route('username') == $chatuser->username ? 'active' : '' }}">
                                                    <div class="d-flex align-items-start">
                                                        <img src="{{ asset($chatuser->image) }}" width="40" alt="">
                                                        <div class="flex-grow-1 ml-3">
                                                            <h3>{{ $chatuser->name ?? $chatuser->username }}</h3>
                                                            @if ($chatuser->unread)
                                                            <span id="unread_count{{ $chatuser->id }}"
                                                                amount="{{ $chatuser->unread }}"
                                                                class="text-danger h6 {{ $chatuser->unread ? '' : 'd-none' }}">
                                                                ({{ $chatuser->unread }})
                                                            </span>
                                                            @else
                                                            @if (isset($selected_user) && Cache::has('isOnline' .
                                                            $selected_user->id))
                                                            <span class="online">{{ __('online') }}</span>
                                                            @else
                                                            <span class="offline">{{ __('offline') }}</span>
                                                            @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </a>
                                                @empty
                                                <div class="user user--profile active">
                                                    <div class="user-info">
                                                        <p class="message-hint center-el">
                                                            <span>{{ __('empty_contact') }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-7 col-xl-9">
                                            @if (!is_null($selected_user))
                                            <div class="selected_user header">
                                                <div class="d-flex align-items-center py-1">
                                                    <div class="position-relative">
                                                        <img src="{{ asset($selected_user->image) }}" width="40"
                                                            class="rounded-circle me-2" alt="">
                                                    </div>
                                                    <div class="flex-grow-1 pl-3">
                                                        <h5>{{ $selected_user->name ?? $selected_user->username }}
                                                        </h5>
                                                        @if (Cache::has('isOnline' . $selected_user->id))
                                                        <span class="online">{{ __('online') }}</span>
                                                        @else
                                                        <span class="offline">{{ __('offline') }}</span>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                            @endif

                                            <div class="position-relative">
                                                <div class="chat_messages message-body">
                                                    @if (!is_null($selected_user))
                                                    @forelse ($messages as $message)
                                                    @if ($message->from_id == auth()->user()->id)
                                                    <div class="chat_msg chat-message-right pb-4">
                                                        <div>
                                                            <img src="{{ asset(Auth::user()->image) }}" width="40"
                                                                class="rounded-circle ms-2" alt="">
                                                            <div class="text-muted small text-nowrap mt-2">
                                                                {{ date('H:i A', strtotime($message->created_at)) }}
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-1 rounded">
                                                            <h3>You</h3>
                                                            <p>
                                                                {!! nl2br(e($message->body)) !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="chat_msg chat-message-left pb-4">
                                                        <div>
                                                            <img src="{{ asset($selected_user->image) }}" width="40"
                                                                class="rounded-circle me-2" alt="">
                                                            <div class="text-muted small text-nowrap mt-2">
                                                                {{ date('H:i A', strtotime($message->created_at)) }}
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-1 rounded">
                                                            <h3>{{ $selected_user->name ?? $selected_user->username }}
                                                            </h3>
                                                            <p>
                                                                {!! nl2br(e($message->body)) !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @empty
                                                    <p class="message-hint center-el text-center margin-t-30px">
                                                        <span>{{ __('empty_message') }}</span>
                                                    </p>
                                                    @endforelse
                                                    <div class="newMessage"></div>
                                                    @else
                                                    <div class="vertical-center text-center margin-t-30px">
                                                        <p>{{ __('select_someone_to_start_conversation') }}</p>
                                                    </div>
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="chat_form">
                                                @if (!is_null($selected_user))
                                                <form id="messageForm"
                                                    action="{{ route('user.message.store', $selected_user->username) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="text" name="body" id="messageBody"
                                                            class="form-control" placeholder="Type your message"
                                                            required>
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                    </div>
                                                </form>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

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
        $(function() {
            var ChatDiv = $('.chat_messages');
            var height = ChatDiv[0].scrollHeight;
            ChatDiv.scrollTop(height);
        });
</script>
<script src="{{ asset('frontend') }}/js/axios.min.js"></script>

<script>
    $('#messageBody').on('input', function() {
            $(this).height('auto').height(this.scrollHeight);
        });

        // for message scroll bottom 0
        var messageBody = document.querySelector('.message-body');
        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

        // for text get proper
        function nl2br(str, is_xhtml) {
            if (typeof str === 'undefined' || str === null) {
                return '';
            }
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }

        // message send to backend form submit & more
        const messageForm = document.getElementById('messageForm');
        if (messageForm) {
            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const username = "{!! $selected_user ? $selected_user->username : '' !!}";
                const message = document.getElementById('messageBody');
                const url = messageForm.getAttribute('action');

                if (message.value == '') {
                    alert('Message body required')
                    return;
                } else {

                    const options = {
                        method: 'POST',
                        url: url,
                        data: {
                            username: username,
                            body: message.value,
                        }
                    }
                    axios(options).then((res) => {


                        if (res.data.user) {
                            message.value = '';
                            // $("#messageBody").css('height', '100%');

                            // remove no message show div
                            $('.message-hint').addClass('d-none');

                            $('.newMessage').append(
                                `<div class="chat_msg chat-message-right pb-4">
                                    <div>
                                        <img src="${res.data.user.image_url}"
                                             width="40"
                                             class="rounded-circle ms-2" alt="">
                                        <div class="text-muted small text-nowrap mt-2">${res.data.message.created_at}</div>
                                    </div>
                                    <div class="flex-shrink-1 rounded">
                                        <h3>You</h3>
                                        <p>
                                             ${nl2br(res.data.message.body)}
                                        </p>
                                    </div>
                                </div>`
                            );

                            var messageBody = document.querySelector('.message-body');
                            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                        }
                    }).catch((e) => {
                        if (e.response.data.message) {
                            toastr.error("Error!! Message not send .", 'Error!')
                        }
                    });
                }
            });
        }
</script>
@endpush