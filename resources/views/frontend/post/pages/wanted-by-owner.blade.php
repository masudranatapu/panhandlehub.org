<div class="row">
    <div class="col-12 mb-4">
        <div class="form_wrapper">
            <div class="title mb-3">
                <h6>posting details</h6>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4">
                    <div class="mb-1">
                        <label for="dimension" class="form-label">size / dimensions </label>
                        <input type="text" name="dimension" id="dimension" value="{{ old('dimension') }}"
                            class="form-control" placeholder="length x width x height">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="col-lg-10">
                        <div class="mb-1">
                            <label for="condition" class="form-label">condition </label>
                            <select name="condition" id="condition" class="form-control">
                                <option value="" selected disabled>-</option>
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
                        <label for="language" class="form-label"><small class="text-success">language of posting <small
                                    class="text-danger">*</small></small></label>
                        <select name="language" id="language" class="form-control">
                            <option value="" selected disabled>-</option>
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
                        <input class="form-check-input" type="checkbox" name="services[]" value=" cryptocurrency ok"
                            id=" cryptocurrency_ok">
                        <label class="form-check-label" for=" cryptocurrency_ok">
                            cryptocurrency ok
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" value="cats ok"
                            id="delivery_available">
                        <label class="form-check-label" for="delivery_available">
                            delivery available
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]"
                            value="include more ads by this user link" id="include_more">
                        <label class="form-check-label" for="include_more">
                            include "more ads by this user" link
                        </label>
                    </div>
                </div>
            </div>
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
                        <span class="text-dark" style="font-weight:600;">replies use panhandlehub mail relay</span><br>
                        <a href="#" class="text-success">[?]</a>
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
                        <div class="col-lg-4">
                            <div class="mb-1">
                                <label for="phone_2" class="form-label">extension </label>
                                <input type="number" name="phone_2" value="{{ old('phone_2') }}" id="phone_2"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="contact_name" class="form-label">contact name </label>
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
