<div class="card product_wrapper">
    <div class="product_img">
        <a href="{{ route('frontend.details', $row->slug) }}">
            <img src="{{ asset(isset($row->thumbnail) && File::exists($row->thumbnail) ? $row->thumbnail : 'frontend/images/no-img.png') }}" class="w-100"
                alt="image">
        </a>
    </div>
    <div class="card-body product_content d-flex flex-column">
        <h3>
            <a href="{{ route('frontend.details', $row->slug) }}">
                {{ Str::limit($row->title, '32',
                '...') }}
            </a>
        </h3>
        <div class="mb-4 mt-auto">
            <p class="location">
                <i class="fas fa-map-marker-alt"></i>
                {{ $row->city }}
                {{ isset($row->countries->name) ? ', ' .
                ucfirst(strtolower($row->countries->name)) : ''
                }}
            </p>
            <p class="time">
                <i class="fa fa-clock"></i>
                {{ date('d Y', strtotime($row->created_at)) }}
            </p>
        </div>
        <div class="d-flex mt-auto">
            <div class="price">
                @if($row->price)<h4>${{ $row->price }}</h4>@endif
            </div>
            <div class="features">
                <div class="form-check">
                    <input class="form-check-input" name="wishlist" type="checkbox"
                        id="wishlist_{{ $row->id }}" {{ isWishlisted($row->id) ? 'checked' : ''
                    }}
                    onchange="AddWishlist2({{ $row->id }}, {{ Auth::user()->id ?? '' }})">
                    <label class="form-check-label" for="wishlist_{{ $row->id }}"></label>
                </div>
            </div>
        </div>
    </div>
</div>
