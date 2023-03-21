<div class="row">
    <div class="col-12 mb-4">
        <div class="form_wrapper availability_check">
            <div class="title mb-3">
                <h6 class="text-success">availability (you must select at least one) <small
                        class="text-danger">*</small></h6>
            </div>
            <div class="form-check me-3">
                <input class="form-check-input" type="checkbox" name="availability[]" id="availabillity_1"
                    value="morning">
                <label class="form-check-label" for="availabillity_1">
                    morning
                </label>
            </div>
            <div class="form-check me-3">
                <input class="form-check-input" type="checkbox" name="availability[]" id="availabillity_2"
                    value="afternoon">
                <label class="form-check-label" for="availabillity_2">
                    afternoon
                </label>
            </div>
            <div class="form-check me-3">
                <input class="form-check-input" type="checkbox" name="availability[]" id="availabillity_3"
                    value="evening">
                <label class="form-check-label" for="availabillity_3">
                    evening
                </label>
            </div>
            <div class="form-check me-3">
                <input class="form-check-input" type="checkbox" name="availability[]" id="availabillity_4"
                    value="overnight">
                <label class="form-check-label" for="availabillity_4">
                    overnight
                </label>
            </div>
            <div class="form-check me-3">
                <input class="form-check-input" type="checkbox" name="availability[]" id="availabillity_5"
                    value="weekdays">
                <label class="form-check-label" for="availabillity_5">
                    weekdays
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="availability[]" id="availabillity_6"
                    value="weekends">
                <label class="form-check-label" for="availabillity_6">
                    weekends
                </label>
            </div>
        </div>
    </div>

    <div class="col-12 mb-4">
        <div class="form_wrapper">
            <div class="title mb-3">
                <h6>posting details</h6>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="education" class="form-label text-success">education <small
                                class="text-danger">*</small></label>
                        <select name="education" id="education" class="form-control" required>
                            <option class="d-none">-</option>
                            <option value="less than high school">less than high school</option>
                            <option value="high school/GED">high school/GED</option>
                            <option value="some college">some college</option>
                            <option value="associates">associates</option>
                            <option value="bachelors">bachelors</option>
                            <option value="masters">masters</option>
                            <option value="doctoral">doctoral</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="direct_contact" id="direct_contact"
                            value="direct contact by recruiters is ok">
                        <label class="form-check-label" for="direct_contact">
                            direct contact by recruiters is ok
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mb-3">
        <div class="form-check me-3" style="display:inline-block;">
            <input class="form-check-input" type="radio" name="is_license" id="unlicensed" value="0" checked>
            <label class="form-check-label" for="unlicensed">
                unlicensed
            </label>
        </div>
        <div class="form-check me-3" style="display:inline-block;">
            <input class="form-check-input" type="radio" name="is_license" id="licensed" value="1">
            <label class="form-check-label" for="licensed">
                licensed
            </label>
        </div>
        <div class="mb-3">
            <label for="license_info" class="form-label">licensure information </label>
            <input type="text" name="license_info" id="license_info" class="form-control" disabled>
        </div>
    </div>

    {{-- <div class="col-12 mb-4">
        <div class="form_wrapper">
            <div class="title mb-3">
                <h6 class="text-success">contact info</h6>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                        <input type="text" name="email" id="email" value="{{ Auth::user()->email ?? old('email') }}"
                            class="form-control" placeholder="Your email address" required>
                    </div>
                    <div class="mb-3">
                        <span class="text-dark" style="font-weight:600;">email privacy
                            options</span>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="email_privacy" id="privacy_1"
                                value="panhandlehub mail relay">
                            <label class="form-check-label" for="privacy_1">
                                panhandlehub mail relay (recommended)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="email_privacy" id="privacy_2"
                                value="show my real email address">
                            <label class="form-check-label" for="privacy_2">
                                show my real email address
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="email_privacy" id="privacy_3"
                                value="no replies to this email">
                            <label class="form-check-label" for="privacy_3">
                                no replies to this email
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 inline_checkbox disabled_checked">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="show_phone" value="1" id="show_phone">
                        <label class="form-check-label" for="show_phone">
                            show my phone number
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="phone_call" id="calls_ok" disabled
                            value="1">
                        <label class="form-check-label" for="calls_ok">
                            phone calls OK
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="phone_text" id="textorsms" disabled
                            value="1">
                        <label class="form-check-label" for="textorsms">
                            text/sms OK
                        </label>
                    </div>
                    <div class="row mt-1">
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="phone" class="form-label">Phone number </label>
                                <input type="number" name="phone" value="{{ old('phone') }}" id="phone"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="phone_2" class="form-label">Local number </label>
                                <input type="number" name="phone_2" value="{{ old('phone_2') }}" id="phone_2"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="contact_name" class="form-label">contact name</label>
                                <input type="text" name="contact_name" value="{{ old('contact_name') }}"
                                    id="contact_name" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="term_condition" name="other_contact" value="1" required>
            <label class="form-check-label" for="term_condition" style="font-size: 14px;">
                ok for others to contact you about other services, products or commercial interests
            </label>
        </div>
    </div> --}}
</div>
