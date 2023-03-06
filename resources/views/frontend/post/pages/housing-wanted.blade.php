<div class="row">
    <div class="col-12 mb-4">
        <div class="form_wrapper">
            <div class="title mb-3">
                <h6>posting details</h6>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="services[]" value="cats ok" id="cats_ok">
                <label class="form-check-label" for="cats_ok">cats ok</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="services[]" value="dogs ok" id="dogs_ok">
                <label class="form-check-label" for="dogs_ok">dogs ok</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="services[]" value="air conditioning"
                    id="air_conditioning">
                <label class="form-check-label" for="air_conditioning">air conditioning</label>
            </div>
        </div>
    </div>

    <div class="col-12 mb-4">
        <div class="form_wrapper">
            <div class="title mb-3">
                <h6>fees and licensure</h6>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="broker_fee" id="broker_1" value="1">
                        <label class="form-check-label" for="broker_1">broker fee</label>
                    </div>
                    <div class="mb-1">
                        <label for="fee_detailed" class="form-label">detailed fee description
                            please</label>
                        <input type="text" name="fee_detailed" value="{{  old('fee_detailed') }}"
                            id="broker_fee_detailed" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="application_fee" id="application_1"
                            value="1">
                        <label class="form-check-label" for="application_1">application
                            fee</label>
                    </div>
                    <div class="mb-1">
                        <label for="fee_detailed" class="form-label">detailed fee description
                            please</label>
                        <input type="text" name="fee_detailed" value="{{  old('fee_detailed') }}"
                            id="application_fee_detailed" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mb-4">
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
                                value="panhandlehub mail relay (recommended)" checked>
                            <label class="form-check-label" for="privacy_1">
                                panhandlehub mail relay (recommended)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="email_privacy"
                                value="no replies to this email" id="privacy_2">
                            <label class="form-check-label" for="privacy_2">
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
                                <label for="contact_name" class="form-label">contact name </label>
                                <input type="text" name="contact_name" value="{{  old('contact_name') }}"
                                    id="contact_name" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="term_condition" name="other_contact" value="1" required>
            <label class="form-check-label" for="term_condition" style="font-size: 14px;">
                ok for others to contact you about other services, products or commercial interests
            </label>
        </div>
    </div>
</div>
