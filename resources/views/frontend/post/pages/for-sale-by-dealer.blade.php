<div class="row">
    <div class="col-12 mb-4">
        <div class="form_wrapper">
            <div class="title mb-3">
                <h6>posting details</h6>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4">
                    <div class="mb-1">
                        <label for="manufacturer" class="form-label">make / manufacturer </label>
                        <input type="text" name="manufacturer" value="{{ $ad->manufacturer ?? old('manufacturer') }}" id="manufacturer" class="form-control">
                    </div>
                    <div class="mb-1">
                        <label for="model_name" class="form-label">model name / number </label>
                        <input type="text" name="model_name" value="{{ $ad->model_name ?? old('model_name') }}" id="model_name" class="form-control">
                    </div>
                    <div class="mb-1">
                        <label for="dimension" class="form-label">size / dimensions </label>
                        <input type="text" name="dimension" value="{{ $ad->dimension ?? old('dimension') }}" id="dimension" value="{{ $ad->dimension ?? old('dimension') }}" placeholder="length x width x height" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="col-lg-10">
                        <div class="mb-1">
                            <label for="phone" class="form-label">condition </label>
                            <select name="condition" id="condition" class="form-control">
                                <option value="" selected disabled>Choose One</option>
                                <option value="new">new</option>
                                <option value="like new ">like new</option>
                                <option value="excellent">excellent</option>
                                <option value="good">good</option>
                                <option value="fair">fair</option>
                                <option value="salvage">salvage</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="phone" class="form-label"><small class="text-success">language of posting <small class="text-danger">*</small></small></label>
                        <select name="language" id="language" class="form-control" required>
                            <option value="english">english</option>
                            <option value="dansk">dansk</option>
                            <option value="espanol">espanol</option>
                            <option value="suomi">suomi</option>
                            <option value="francais">francais</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" value="cryptocurrency ok" id="cryptocurrency_ok">
                        <label class="form-check-label" for="cryptocurrency_ok">
                            cryptocurrency ok
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" value="delivery available" id="delivery_available">
                        <label class="form-check-label" for="delivery_available">
                            delivery available
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" value="include more ads by this user link" id="include_more">
                        <label class="form-check-label" for="include_more">
                            include "more ads by this user" link
                        </label>
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
                        <input type="text" name="email" id="email" value="{{ Auth::user()->email ?? old('email') }}" class="form-control"
                            placeholder="Your email address" required>
                    </div>
                    <div class="mb-3">
                        <span class="text-dark" style="font-weight:600;">replies use Ffuts mail relay <a href="#" class="text-success">[?]</a></span><br>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="email_privacy"
                            id="privacy_1" checked>
                        <label class="form-check-label" for="privacy_1">
                            Ffuts mail relay (recommended)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="email_privacy"
                            id="privacy_1">
                        <label class="form-check-label" for="privacy_1">
                           no replies to this email
                        </label>
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
                                <label for="phone" class="form-label">Phone number </label>
                                <input type="number" name="phone" value="{{ old('phone') }}" id="phone"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-1">
                                <label for="phone_2" class="form-label">extention </label>
                                <input type="number" name="phone_2" value="{{ old('phone_2') }}" id="phone_2"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="contact_name" class="form-label">contact name </label>
                                <input type="text" name="contact_name" value="{{  old('contact_name') }}" id="contact_name"
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
            <input class="form-check-input" type="checkbox" id="term_condition" name="other_contact" value="1" required>
            <label class="form-check-label" for="term_condition" style="font-size: 14px;">
                ok for others to contact you about other services, products or commercial interests
            </label>
        </div>
    </div>
</div>
