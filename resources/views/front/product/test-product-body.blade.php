@forelse($categoryProducts as $category)
@forelse ($category->products()->where('status', 'Publish')->get() as $product)
<div class="col-lg-3 col-md-5 col-12">
<div class="wall-wrapper">
<div class="wall-image">
        <img src="{{asset('/uploads/product/'.$product->path.'/main/'.$product->image)}}" class="">
</div>
            <div class="wall-content">
            <div class="product-title">
            <h3>{{ $product->title }}</h3>
            </div>
            <!--<div class="price-tag-wrap">-->
            <!--    <span>$ {{discount($product->price, $product->discount)}} -->
            <!--        <p>-->
            <!--        @if($product->discount > 0)-->
            <!--            $ {{number_format($product->price, 2)}}-->
            <!--        @endif-->
            <!--        </p>-->
            <!--    </span>-->
            <!--    @if($product->discount > 0)-->
            <!--    <p> {{ $product->discount }} % OFF</p>-->
            <!--    @endif-->
            <!--</div>-->
            <div class="lsting-btn-wrapper">
                <!-- <a class="more-btn list-buy-btn    " href="{{route('buyNow', $product->slug)}}">Order Now</a> -->
                <!-- <a class="view-pro-btn more-btn" href="{{route('ProductDetail', $product->slug)}}">View Product</a> -->
                <a class="more-btn list-buy-btn" href="{{route('ProductDetail', $product->slug)}}">View Product</a>

            </div>
        </div>
    </div>
</div>
@empty
<div class="alert alert-warning" role="alert">
    Sorry ! No product found in this category.
</div>
@endforelse
@empty
<div class="alert alert-warning" role="alert">
    Sorry ! No product found in this category.
</div>
@endforelse