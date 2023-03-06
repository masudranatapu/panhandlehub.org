<div class="row">
    <div class="col-12 mb-4">
        <div class="form_wrapper">
            <div class="title mb-3">
                <h6 class="text-success">posting details</h6>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="mb-3">
                        <label for="sqft" class="form-label">sqft</label>
                        <input type="number" name="sqft" value="{{  old('sqft') }}" id="sqft" value="0"
                            class="form-control">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="select_dropdown">
                        <label for="houssing_type">houssing type </label>
                        <select name="houssing_type" id="houssing_type" class="form-control">
                            <option value="apartment">apartment</option>
                            <option value="condo">condo</option>
                            <option value="cotage/cabin">cotage/cabin</option>
                            <option value="duplex">duplex</option>
                            <option value="flat">flat</option>
                            <option value="house">house</option>
                            <option value="in-law">in-law</option>
                            <option value="loft">loft</option>
                            <option value="townhouse">townhouse</option>
                            <option value="manufactured">manufactured</option>
                            <option value="assisted living">assisted living</option>
                        </select>
                    </div>
                    <div class="select_dropdown">
                        <label for="laundry" class="text-success">laundry <small class="text-danger">*</small></label>
                        <select name="laundry" id="laundry" class="form-control" required <option value=""
                            class="d-none">-</option>
                            <option value="w/d in unit">w/d in unit</option>
                            <option value="w/d hookups">w/d hookups</option>
                            <option value="laundry in bldg">laundry in bldg</option>
                            <option value="laundry on site">laundry on site</option>
                            <option value="no lanudry on site">no lanudry on site</option>
                        </select>
                    </div>
                    <div class="select_dropdown">
                        <label for="parking" class="text-success">parking <small class="text-danger">*</small></label>
                        <select name="parking" id="parking" class="form-control" required>
                            <option value="" class="d-none">-</option>
                            <option value="carport">carport</option>
                            <option value="attached garage">attached garage</option>
                            <option value="detached garage">detached garage</option>
                            <option value="off-street parking">off-street parking</option>
                            <option value="street parking">street parking</option>
                            <option value="valet parking">valet parking</option>
                            <option value="no parking">no parking</option>
                        </select>
                    </div>
                    <div class="select_dropdown">
                        <label for="bedrooms">bedrooms <small class="text-danger">*</small></label>
                        <select name="bedrooms" id="bedrooms" class="form-control" required>
                            <option value="" class="d-none">-</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                    <div class="select_dropdown">
                        <label for="bathrooms">bathrooms <small class="text-danger">*</small></label>
                        <select name="bathrooms" id="bathrooms" class="form-control" required>
                            <option value="" class="d-none">-</option>
                            <option value="shared">shared</option>
                            <option value="split">split</option>
                            <option value="1">1</option>
                            <option value="1.5">1.5</option>
                            <option value="2">2</option>
                            <option value="2.5">2.5</option>
                            <option value="3">3</option>
                            <option value="3.5">3.5</option>
                            <option value="4">4</option>
                            <option value="4.5">4.5</option>
                            <option value="5">5</option>
                            <option value="5.5">5.5</option>
                            <option value="6">6</option>
                            <option value="6.5">6.5</option>
                            <option value="7">7</option>
                            <option value="7.5">7.5</option>
                            <option value="8">8</option>
                            <option value="8.5">8.5</option>
                            <option value="9+">9+</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" id="cats_ok" value="cats ok">
                        <label class="form-check-label" for="cats_ok">cats ok</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" id="dogs_ok" value="dogs ok">
                        <label class="form-check-label" for="dogs_ok">dogs ok</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" id="furnished"
                            value="furnished">
                        <label class="form-check-label" for="furnished">furnished</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" id="no_smoking"
                            value="no smoking">
                        <label class="form-check-label" for="no_smoking">no smoking</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" id="wheelchair_accessible"
                            value="wheelchair accessible">
                        <label class="form-check-label" for="wheelchair_accessible">wheelchair accessible</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" id="air_conditioning"
                            value="air conditioning">
                        <label class="form-check-label" for="air_conditioning">air conditioning</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" id="EV charging"
                            value="EV charging">
                        <label class="form-check-label" for="EV charging">EV charging</label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mb-3">
                        <label for="available_on" class="form-label">available on</label>
                        <input type="date" name="available_on" id="available_on" class="form-control">
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
                                <label for="phone" class="form-label">Phone number</label>
                                <input type="number" name="phone" value="{{ old('phone')}}" id="phone"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="phone_2" class="form-label">Local number </label>
                                <input type="number" name="phone_2" value="{{ old('phone_2')}}" id="phone_2"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="contact_name" class="form-label">contact name </label>
                                <input type="text" name="contact_name" value="{{ old('contact_name')}}"
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
