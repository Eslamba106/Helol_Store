<div class="cart-items">
    <a href="{{ route('cart.index') }}" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items cart-total-items">{{ $items->count() }}</span>
    </a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ $items->count() }} Items</span>
            <a href="cart.html">View Cart</a>
        </div>
        <ul class="shopping-list">
            @foreach ($items as $item)
                <li id="{{ $item->id }}">
                    <a href="#" data-id="{{ $item->id }}" class="remove remove-item" title="Remove this item"><i
                            class="lni lni-close"></i></a>
                    <div class="cart-img-head">
                        <a class="cart-img" href="product-details.html"><img
                                src="{{ $item->product->image_url }}" alt="#"></a>
                    </div>

                    <div class="content">
                        <h4><a href="product-details.html">{{ $item->product->name }}</a></h4>
                        <p class="quantity">{{ $item->quantity }}x - <span class="amount">{{ Currency::format($item->product->price) }}</span></p>
                    </div>
                </li>
            @endforeach


        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">{{ Currency::format($total) }}</span>
            </div>
            <div class="button">
                <a href="{{ route('checkout') }}" class="btn animate">Checkout</a>
            </div>
        </div>
    </div>
    <!--/ End Shopping Item -->
</div>

{{-- <li>
    <a href="javascript:void(0)" class="remove" title="Remove this item"><i
            class="lni lni-close"></i></a>
    <div class="cart-img-head">
        <a class="cart-img" href="product-details.html"><img
                src="{{  asset('assets/images/header/cart-items/item2.jpg')  }}" alt="#"></a>
    </div>
    <div class="content">
        <h4><a href="product-details.html">Wi-Fi Smart Camera</a></h4>
        <p class="quantity">1x - <span class="amount">$35.00</span></p>
    </div>
</li> --}}
