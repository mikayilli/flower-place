@forelse($results['collections_1'] as $collection)
    @if($collection->product)
        <a href="{{ product_url($collection->product->slug) }}" class="card_item">
            <span class="item_title">{{ $collection->product->name }}</span>
            <div class="card_img small_card_img">
                <img src="{{ url('storage/products/thumb_'. $collection->product->image ) }}" alt="{{ $collection->name .','. $collection->product->name }}" />
            </div>
            <div class="card_footer">
                <span class="price_card">{{ $collection->product->price }} руб.</span>
                <span  class="order_btn">Заказать</span>
            </div>
            <div class="mobile_card_foot">
                <span class="title_foot">{{ $collection->product->name }}</span>
                <span class="price">{{ $collection->product->price }} руб.</span>
                <span class="order_text">Перейти</span>
            </div>
        </a>
    @else
        <a href="{{ route("menu.collection", ["collection" => $collection->slug]) }}" class="card_item">
            <span class="item_title">
                {{ $collection->name }}
                <img src="/assets/images/icons/rightArrow.svg" alt="rightArrow.svg"/>
            </span>
            <div class="card_img">
                <img src="{{ url('storage/collections/thumb_'. $collection->image ) }}" alt="{{ $collection->name }}" />
            </div>
            <div class="mobile_card_foot">
                <span class="title_foot">{{ $collection->name }}</span>
                <span class="order_text">Перейти</span>
            </div>
        </a>
    @endif
@empty @endforelse
