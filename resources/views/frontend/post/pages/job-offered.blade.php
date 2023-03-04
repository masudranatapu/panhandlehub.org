<div class="col-12 mb-4">
    <div class="form_wrapper">
        <div class="title mb-3">
            <h6>Ad Details</h6>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="employment_type" class="form-label text-success">kind of
                        employment <small class="text-danger">*</small></label>
                    <select name="employment_type" id="employment_type" class="form-control"
                        required>
                        <option value="" class="d-none">-</option>
                        <option value="full time">full time</option>
                        <option value="part time">part time</option>
                        <option value="contract">contract</option>
                        <option value="at the choice of the employee">at the choice of the
                            employee</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="services[]"
                        value="" id="service_1"
                        value="direct contact of personnel recruiters allowed">
                    <label class="form-check-label" for="service_1">
                        direct contact of personnel recruiters allowed
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="services[]"
                        value="" id="service_2" value="internship">
                    <label class="form-check-label" for="service_2">
                        internship
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="services[]"
                        value="" id="service_3" value="nonprofit organization">
                    <label class="form-check-label" for="service_3">
                        nonprofit organization
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="services[]"
                        value="" id="service_4"
                        value="availability of relocation assistance">
                    <label class="form-check-label" for="service_4">
                        availability of relocation assistance
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="services[]"
                        value="" id="service_5" value="possibility of teleworking">
                    <label class="form-check-label" for="service_5">
                        possibility of teleworking
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="mb-3">
        <label for="job_title" class="form-label text-success">job title <small class="text-danger">*</small></label>
        <input type="text" name="job_title" value="{{ $ad->job_title ?? old('job_title')}}" id="job_title" class="form-control" required>
    </div>
</div>
<div class="col-md-4">
    <div class="mb-3">
        <label for="salary" class="form-label text-success">salary</label>
        <input type="number" name="price" id="salary" value="{{ old('price') }}" class="form-control"
            placeholder="Salary">
    </div>
</div>
<div class="col-md-4">
    <div class="mb-3">
        <label for="company_name" class="form-label">company name</label>
        <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" class="form-control"
            >
    </div>
</div>
<div class="col-12 mb-4">
    <!-- Contact Form -->
    <div class="form_wrapper">
        <div class="title mb-3">
            <h6>Contact Info</h6>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                    <input type="text" name="email" id="email" value="{{ Auth::user()->email ?? old('email') }}" class="form-control"
                        placeholder="Your email address" required>
                </div>
                <div class="mb-3">
                    <span class="text-dark" style="font-weight:600;">email privacy
                        options</span>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="email_privacy"
                            id="privacy_1" value="ffuts mail relay">
                        <label class="form-check-label" for="privacy_1">
                            Ffuts mail relay (recommended)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="email_privacy"
                            id="privacy_2" value="show my real email address">
                        <label class="form-check-label" for="privacy_2">
                            show my real email address
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="email_privacy"
                            id="privacy_3" value="no replies to this email">
                        <label class="form-check-label" for="privacy_3">
                            no replies to this email
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-8 inline_checkbox disabled_checked">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="show_phone"
                        value="1" id="show_phone">
                    <label class="form-check-label" for="show_phone">
                        show my phone number
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="phone_call"
                        id="calls_ok" disabled value="1">
                    <label class="form-check-label" for="calls_ok">
                        phone calls OK
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="phone_text"
                        id="textorsms" disabled value="1">
                    <label class="form-check-label" for="textorsms">
                        text/sms OK
                    </label>
                </div>
                <div class="row mt-1">
                    <div class="col-lg-6">
                        <div class="mb-1">
                            <label for="phone" class="form-label">Phone number</label>
                            <input type="number" name="phone" {{ old('phone') }} id="phone"
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
                            <input type="text" name="contact_name" value="{{ old('contact_name') }}" id="contact_name"
                                class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="job_for_disabilities"
            required>
        <label class="form-check-label" for="job_for_disabilities" style="font-size: 14px;">
            job open to people with disabilities
        </label>
    </div>
</div>
