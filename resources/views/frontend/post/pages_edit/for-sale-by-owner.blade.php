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
                                <option value="new" {{ $ad->conditions == "new" ? "selected" : ""}}>new</option>
                                <option value="like new" {{ $ad->conditions == "like new" ? "selected" : ""}}>like new</option>
                                <option value="excellent" {{ $ad->conditions == "excellent" ? "selected" : ""}}>excellent</option>
                                <option value="good" {{ $ad->conditions == "good" ? "selected" : ""}}>good</option>
                                <option value="fair" {{ $ad->conditions == "fair" ? "selected" : ""}}>fair</option>
                                <option value="salvage" {{ $ad->conditions == "salvage" ? "selected" : ""}}>salvage</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="phone" class="form-label"><small class="text-success">language of posting <small class="text-danger">*</small></small></label>
                        <select name="language" id="language" class="form-control">
                                <option value="english" {{  $ad->language == "english"? "selected" : "" }}>english</option>
                                <option value="dansk" {{  $ad->language == "dansk"? "selected" : "" }}>dansk</option>
                                <option value="espanol" {{  $ad->language == "espanol"? "selected" : "" }}>espanol</option>
                                <option value="suomi" {{  $ad->language == "suomi"? "selected" : "" }}>suomi</option>
                                <option value="francais" {{  $ad->language == "francais"? "selected" : "" }}>francais</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" value="cats ok" id="cats_ok"
                         {{ isset($ad->services) && in_array('cats ok',$ad->services)? "checked" : "" }}>
                        <label class="form-check-label" for="cats_ok">
                            cryptocurrency ok
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" value="delivery available" id="delivery_available"
                        {{ isset($ad->services) && in_array('delivery available',$ad->services)? "checked" : "" }}>
                        <label class="form-check-label" for="delivery_available">
                            delivery available
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" value="include more ads by this user link" id="include_more"
                        {{ isset($ad->services) && in_array('include more ads by this user link',$ad->services)? "checked" : "" }}>
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
                    <input type="text" name="email" id="email"
                        value="{{ Auth::user()->email ?? old('email') }}" class="form-control"
                        placeholder="Your email address" required>
                </div>
                <div class="mb-3">
                    <span class="text-dark" style="font-weight:600;">email privacy
                        options</span>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="email_privacy" {{ $ad->email_privacy == "ffuts mail relay" ? "checked" : "" }} id="privacy_1"
                            value="ffuts mail relay">
                        <label class="form-check-label" for="privacy_1">
                            Ffuts mail relay (recommended)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" {{ $ad->email_privacy == 'show my real email address' ? "checked" : ""}} name="email_privacy"
                             id="privacy_2"
                            value="show my real email address">
                        <label class="form-check-label" for="privacy_2">
                            show my real email address
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                            name="email_privacy" {{ $ad->email_privacy == "no replies to this email"? "checked" : "" }} id="privacy_3"
                            value="no replies to this email">
                        <label class="form-check-label" for="privacy_3">
                            no replies to this email
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-8 inline_checkbox disabled_checked">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="show_phone"{{ $ad->show_phone ? 'checked' : '1' }} value="1" id="show_phone">
                    <label class="form-check-label" for="show_phone">
                        show my phone number
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="phone_call"{{ $ad->phone_call == "1" ? 'checked' : '' }} id="calls_ok" disabled
                        value="1">
                    <label class="form-check-label" for="calls_ok">
                        phone calls OK
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="phone_text"{{ $ad->phone_text  == "1" ? 'checked' : '' }} id="textorsms" disabled
                        value="1">
                    <label class="form-check-label" for="textorsms">
                        text/sms OK
                    </label>
                </div>
                <div class="row mt-1">
                    <div class="col-lg-6">
                        <div class="mb-1">
                            <label for="phone" class="form-label">Phone number </label>
                            <input type="number" name="phone" id="phone" class="form-control"
                                value="{{ $ad->phone }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-1">
                            <label for="phone_2" class="form-label">Local number </label>
                            <input type="number" name="phone_2" value="{{ $ad->phone_2 }}" id="phone_2"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-1">
                            <label for="contact_name" class="form-label">contact name </label>
                            <input type="text" name="contact_name" value="{{ $ad->contact_name }}"
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
            <input class="form-check-input" type="checkbox" id="term_condition" {{ $ad->other_contact ? "checked" : "" }} name="other_contact" value="1" required>
            <label class="form-check-label" for="term_condition" style="font-size: 14px;">
                ok for others to contact you about other services, products or commercial interests
            </label>
        </div>
    </div>
</div>
