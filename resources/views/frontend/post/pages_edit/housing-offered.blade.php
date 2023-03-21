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
                        <input type="number" name="sqft" value="{{  $ad->sqft }}" id="sqft" value="0"
                            class="form-control">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="select_dropdown">
                        <label for="houssing_type">houssing type</label>
                        <select name="houssing_type" id="houssing_type" class="form-control">
                            <option value="apartment" {{ $ad->houssing_type == "apartment" ? "selected" : ""}}>apartment
                            </option>
                            <option value="condo" {{ $ad->houssing_type == "condo" ? "selected" : ""}}>condo</option>
                            <option value="cotage/cabin" {{ $ad->houssing_type == "cotage/cabin" ? "selected" :
                                ""}}>cotage/cabin</option>
                            <option value="duplex" {{ $ad->houssing_type == "duplex" ? "selected" : ""}}>duplex</option>
                            <option value="flat" {{ $ad->houssing_type == "flat" ? "selected" : ""}}>flat</option>
                            <option value="house" {{ $ad->houssing_type == "house" ? "selected" : ""}}>house</option>
                            <option value="in-law" {{ $ad->houssing_type == "in-law" ? "selected" : ""}}>in-law</option>
                            <option value="loft" {{ $ad->houssing_type == "loft" ? "selected" : ""}}>loft</option>
                            <option value="townhouse" {{ $ad->houssing_type == "townhouse" ? "selected" : ""}}>townhouse
                            </option>
                            <option value="manufactured" {{ $ad->houssing_type == "manufactured" ? "selected" :
                                ""}}>manufactured</option>
                            <option value="assisted living" {{ $ad->houssing_type == "assisted living" ? "selected" :
                                ""}}>assisted living</option>
                        </select>
                    </div>
                    <div class="select_dropdown">
                        <label for="laundry" class="text-success">laundry</label>
                        <select name="laundry" id="laundry" class="form-control">
                            <option value="" class="d-none">-</option>
                            <option value="w/d in unit" {{ $ad->laundry == "w/d in unit"? "selected" : "" }}>w/d in unit
                            </option>
                            <option value="w/d hookups" {{ $ad->laundry == "w/d hookups"? "selected" : "" }}>w/d hookups
                            </option>
                            <option value="laundry in bldg" {{ $ad->laundry == "laundry in bldg"? "selected" : ""
                                }}>laundry in bldg</option>
                            <option value="laundry on site" {{ $ad->laundry == "laundry on site"? "selected" : ""
                                }}>laundry on site</option>
                            <option value="no lanudry on site" {{ $ad->laundry == "no lanudry on site"? "selected" : ""
                                }}>no lanudry on site</option>
                        </select>
                    </div>
                    <div class="select_dropdown">
                        <label for="parking" class="text-success">parking</label>
                        <select name="parking" id="parking" class="form-control">
                            <option value="" class="d-none">-</option>
                            <option value="carport" {{ $ad->parking == "carport"? "selected" : "" }}>carport</option>
                            <option value="attached garage" {{ $ad->parking == "attached garage"? "selected" : ""
                                }}>attached garage</option>
                            <option value="detached garage" {{ $ad->parking == "detached garage"? "selected" : ""
                                }}>detached garage</option>
                            <option value="off-street parking" {{ $ad->parking == "off-street parking"? "selected" : ""
                                }}>off-street parking</option>
                            <option value="street parking" {{ $ad->parking == "street parking"? "selected" : ""
                                }}>street parking</option>
                            <option value="valet parking" {{ $ad->parking == "valet parking"? "selected" : "" }}>valet
                                parking</option>
                            <option value="no parking" {{ $ad->parking == "no parking"? "selected" : "" }}>no parking
                            </option>
                        </select>
                    </div>
                    <div class="select_dropdown">
                        <label for="bedrooms">bedrooms</label>
                        <select name="bedrooms" id="bedrooms" class="form-control">
                            <option value="" class="d-none">-</option>
                            <option value="0" {{ $ad->bedrooms == 0? "selected" : "" }}>0</option>
                            <option value="1" {{ $ad->bedrooms == 1? "selected" : "" }}>1</option>
                            <option value="2" {{ $ad->bedrooms == 2? "selected" : "" }}>2</option>
                            <option value="3" {{ $ad->bedrooms == 3? "selected" : "" }}>3</option>
                            <option value="4" {{ $ad->bedrooms == 4? "selected" : "" }}>4</option>
                            <option value="5" {{ $ad->bedrooms == 5? "selected" : "" }}>5</option>
                            <option value="6" {{ $ad->bedrooms == 6? "selected" : "" }}>6</option>
                            <option value="7" {{ $ad->bedrooms == 7? "selected" : "" }}>7</option>
                            <option value="8" {{ $ad->bedrooms == 8? "selected" : "" }}>8</option>
                        </select>
                    </div>
                    <div class="select_dropdown">
                        <label for="bathrooms">bathrooms</label>
                        <select name="bathrooms" id="bathrooms" class="form-control">
                            <option value="" class="d-none">-</option>
                            <option value="shared" {{ $ad->bathrooms == "shared"? "selected" : "" }}>shared</option>
                            <option value="split" {{ $ad->bathrooms == "split"? "selected" : "" }}>split</option>
                            <option value="1">1</option>
                            <option value="1.5" {{ $ad->bathrooms == "1.5"? "selected" : "" }}>1.5</option>
                            <option value="2" {{ $ad->bathrooms == "2"? "selected" : "" }}>2</option>
                            <option value="2.5" {{ $ad->bathrooms == "2.5"? "selected" : "" }}>2.5</option>
                            <option value="3" {{ $ad->bathrooms == "3"? "selected" : "" }}>3</option>
                            <option value="3.5" {{ $ad->bathrooms == "3.5"? "selected" : "" }}>3.5</option>
                            <option value="4" {{ $ad->bathrooms == "4"? "selected" : "" }}>4</option>
                            <option value="4.5" {{ $ad->bathrooms == "4.5"? "selected" : "" }}>4.5</option>
                            <option value="5" {{ $ad->bathrooms == "5"? "selected" : "" }}>5</option>
                            <option value="5.5" {{ $ad->bathrooms == "5.5"? "selected" : "" }}>5.5</option>
                            <option value="6" {{ $ad->bathrooms == "6"? "selected" : "" }}>6</option>
                            <option value="6.5" {{ $ad->bathrooms == "6.5"? "selected" : "" }}>6.5</option>
                            <option value="7" {{ $ad->bathrooms == "7"? "selected" : "" }}>7</option>
                            <option value="7.5" {{ $ad->bathrooms == "7.5"? "selected" : "" }}>7.5</option>
                            <option value="8" {{ $ad->bathrooms == "8"? "selected" : "" }}>8</option>
                            <option value="8.5" {{ $ad->bathrooms == "8.5"? "selected" : "" }}>8.5</option>
                            <option value="9+" {{ $ad->bathrooms == "9+"? "selected" : "" }}>9+</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" {{ isset($ad->services) &&
                        in_array('cats ok',$ad->services)? "checked" : "" }}
                        id="cats_ok" value="cats ok">
                        <label class="form-check-label" for="cats_ok">cats ok</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" {{ isset($ad->services) &&
                        in_array('dogs ok',$ad->services)? "checked" : "" }}
                        id="dogs_ok" value="dogs ok">
                        <label class="form-check-label" for="dogs_ok">dogs ok</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" {{ isset($ad->services) &&
                        in_array('furnished',$ad->services)? "checked" : "" }}
                        id="furnished" value="furnished">
                        <label class="form-check-label" for="furnished">furnished</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" {{ isset($ad->services) &&
                        in_array('no smoking',$ad->services)? "checked" : "" }}
                        id="no_smoking" value="no smoking">
                        <label class="form-check-label" for="no_smoking">no smoking</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" {{ isset($ad->services) &&
                        in_array('wheelchair accessible',$ad->services)? "checked" : "" }}
                        id="wheelchair_accessible" value="wheelchair accessible">
                        <label class="form-check-label" for="wheelchair_accessible">wheelchair accessible</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" {{ isset($ad->services) &&
                        in_array('air conditioning',$ad->services)? "checked" : "" }}
                        id="air_conditioning" value="air conditioning">
                        <label class="form-check-label" for="air_conditioning">air conditioning</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" {{ isset($ad->services) &&
                        in_array('EV charging',$ad->services)? "checked" : "" }}
                        id="EV charging" value="EV charging">
                        <label class="form-check-label" for="EV charging">EV charging</label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mb-3">
                        <label for="available_on" class="form-label">available on</label>
                        <input type="text"  name="available_on" {{ date('d M Y',strtotime($ad->available_on)) }}
                        id="datepicker" class="form-control">
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
                        <span class="text-dark" style="font-weight:600;">email privacy
                            options</span>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="email_privacy" id="privacy_1"
                                value="panhandlehub mail relay" {{ $ad->email_privacy == "panhandlehub mail relay"?
                            'checked' : '' }}>
                            <label class="form-check-label" for="privacy_1">
                                CL mail relay (recommended)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="email_privacy" {{ $ad->email_privacy ==
                            "show my real email address"? 'checked' : '' }} id="privacy_2"
                            value="show my real email address">
                            <label class="form-check-label" for="privacy_2">
                                show my real email address
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="email_privacy" {{ $ad->email_privacy ==
                            "no replies to this email"? 'checked' : '' }} id="privacy_3"
                            value="no replies to this email">
                            <label class="form-check-label" for="privacy_3">
                                no replies to this email
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 inline_checkbox disabled_checked">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="show_phone" {{ $ad->show_phone == "1"?
                        'checked' : '' }} value="1" id="show_phone">
                        <label class="form-check-label" for="show_phone">
                            show my phone number
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="phone_call" {{ $ad->phone_call == "1"?
                        'checked' : '' }} id="calls_ok" disabled
                        value="1">
                        <label class="form-check-label" for="calls_ok">
                            phone calls OK
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="phone_text" {{ $ad->phone_text == "1"?
                        'checked' : '' }} id="textorsms" disabled
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
                                <input type="text" name="contact_name" value="{{ $ad->contact_name }}" id="contact_name"
                                    class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="term_condition" {{ $ad->other_contact == "1" ? "checked"
            : "" }} name="other_contact" value="1" required>
            <label class="form-check-label" for="term_condition" style="font-size: 14px;">
                ok for others to contact you about other services, products or commercial interests
            </label>
        </div>
    </div> --}}
</div>
