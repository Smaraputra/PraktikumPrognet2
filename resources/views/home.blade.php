@extends('layouts.app')

@section('content')
    <!-- STEPS =============================-->
    <div class="item content">
        <div class="container toparea">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="col editContent">
                        <span class="numberstep"><i class="fa fa-shopping-cart"></i></span>
                        <h3 class="numbertext">Choose our Products</h3>
                        <p>
                            Explore our extensive collection of cutting-edge gadgets and unlock a world of innovation and
                            convenience. We pride ourselves in offering a diverse range of state-of-the-art gadgets designed
                            to enhance every aspect of your life.
                        </p>
                    </div>
                    <!-- /.col-md-4 -->
                </div>
                <!-- /.col-md-4 col -->
                <div class="col-md-4 editContent">
                    <div class="col">
                        <span class="numberstep"><i class="fa fa-gift"></i></span>
                        <h3 class="numbertext">DISCOUNT AND COUPON</h3>
                        <p>
                            Unlock incredible savings with our exclusive discounts and coupons. We believe in rewarding our
                            valued customers with special offers and deals that help you save money on your purchases.
                        </p>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.col-md-4 col -->
                <div class="col-md-4 editContent">
                    <div class="col">
                        <span class="numberstep"><i class="fa fa-clock-o"></i></span>
                        <h3 class="numbertext">Delivery 24/7</h3>
                        <p>
                            Experience unparalleled convenience with our round-the-clock delivery service. We understand
                            that your time is valuable, which is why we offer 24/7 delivery to ensure that your products
                            reach you when you need them.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LATEST ITEMS =============================-->
    <section class="item content">
        <div class="container">
            <div class="underlined-title">
                <div class="editContent">
                    <h1 class="text-center latestitems">LATEST ITEMS</h1>
                </div>
                <div class="wow-hr type_short">
                    <span class="wow-hr-h">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="productbox">
                            <div class="fadeshop">
                                <div class="captionshop text-center" style="display: none;">
                                    <h3>{{ $product->product_name }}</h3>
                                    <p>
                                        <a href="/product/{{ $product->slug }}" class="learn-more detailslearn"><i
                                                class="fa fa-link"></i> Details</a>
                                    </p>
                                </div>

                                @if ($product->product_image->count())
                                    @foreach ($product->product_image as $image)
                                        @php
                                            $pathhome = base_path();
                                            $path = $pathhome . '/public/uploads/product_images/' . $image->image_name;
                                            $statusgambar = 0;
                                            
                                            if (file_exists($path)) {
                                                $statusgambar = 1;
                                            }
                                        @endphp
                                        @if ($statusgambar == 1)
                                            <span class="maxproduct"><img
                                                    src="/uploads/product_images/{{ $image->image_name }}"
                                                    alt=""></span>
                                        @else
                                            <span class="maxproduct"><img src="/uploads/product_images/noimage.jpg"
                                                    alt=""></span>
                                        @endif
                                    @break
                                @endforeach
                            @else
                                <span class="maxproduct"><img src="/uploads/product_images/noimage.jpg"
                                        alt=""></span>
                            @endif
                        </div>
                        <div class="product-details">
                            <a href="/product/{{ $product->slug }}">
                                <h1>{{ $product->product_name }}</h1>
                            </a>
                            @if ($product->stock == 0)
                                <h4>Out of Stock!</h4>
                            @endif

                            @if ($product->discount->count())
                                @php
                                    $current_date = strtotime(date('Y-m-d'));
                                    $statusDiskon = 0;
                                @endphp
                                @foreach ($product->discount as $key => $diskon)
                                    @if (strtotime($diskon->start) <= $current_date && strtotime($diskon->end) >= $current_date)
                                        @php
                                            $statusDiskon = 1;
                                        @endphp
                                    @endif
                                @endforeach
                                @foreach ($product->discount as $key => $diskon)
                                    @if (strtotime($diskon->start) <= $current_date && strtotime($diskon->end) >= $current_date)
                                        <h4>-{{ $diskon->percentage }}%</h4>
                                        <span class="price">
                                            <del class="edd_price">Rp.{{ number_format($product->price) }}</del>
                                        </span>
                                        <span class="price">
                                            <span
                                                class="edd_price">Rp.{{ number_format($product->price * ((100 - $diskon->percentage) / 100)) }}</span>
                                        </span>
                                    @else
                                        @if ($key == 0 && $statusDiskon == 0)
                                            <span class="price">
                                                <span class="edd_price">Rp.{{ number_format($product->price) }}</span>
                                            </span>
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                <span class="price">
                                    <span class="edd_price">Rp.{{ number_format($product->price) }}</span>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
</section>

<!-- BUTTON =============================-->
<div class="item content">
    <div class="container text-center">
        <a href="/shop" class="homebrowseitems">Browse All Products
            <div class="homebrowseitemsicon">
                <i class="fa fa-star fa-spin"></i>
            </div>
        </a>
    </div>
</div>
<br />

<!-- CALL TO ACTION =============================-->
<section class="content-block" style="background-color:#00bba7;">
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="item" data-scrollreveal="enter top over 0.4s after 0.1s">
                    <h1 class="callactiontitle"> We Have Discount! <span class="callactionbutton"><i
                                class="fa fa-gift"></i> ORDER NOW</span>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
