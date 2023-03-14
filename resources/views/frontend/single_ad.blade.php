<div class="col mb-3">
    <div class="card product_wrapper">
    <div class="product_img">
        <a href="{{ route('frontend.details', $item->slug) }}">
            <img src="{{ asset(isset($item->thumbnail) && File::exists($item->thumbnail) ? $item->thumbnail : 'frontend/images/no-img.png') }}" class="w-100"
                alt="image">
        </a>
    </div>
    <div class="card-body product_content d-flex flex-column">
        <h3>
            <a href="{{ route('frontend.details', $item->slug) }}">
                {{ Str::limit($item->title, '32',
                '...') }}
            </a>
        </h3>
        <div class="mb-4 mt-auto">
            <p class="location">
                <i class="fas fa-map-marker-alt"></i>
                {{ $item->city }}
                {{ isset($item->countries->name) ? ', ' .
                ucfirst(strtolower($item->countries->name)) : ''
                }}
            </p>
            <p class="time">
                <i class="fa fa-clock"></i>
                {{ date('d Y', strtotime($item->created_at)) }}
            </p>
        </div>
        <div class="d-flex mt-auto">
            <div class="price">
                @if($item->price)<h4>${{ $item->price }}</h4>@endif
            </div>
            <div class="features">
                <div class="form-check">
                    <input class="form-check-input" name="wishlist" type="checkbox"
                        id="wishlist_{{ $item->id }}" {{ isWishlisted($item->id) ? 'checked' : ''
                    }}
                    onchange="AddWishlist2({{ $item->id }}, {{ Auth::user()->id ?? '' }})">
                    <label class="form-check-label" for="wishlist_{{ $item->id }}"></label>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

