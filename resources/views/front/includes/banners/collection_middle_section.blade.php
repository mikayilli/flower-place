@forelse($results['collections_2'] as $collection)
    @if($collection->product)
        <div class="item">
            <h4 class="title_item">{{ $collection->product->name }}</h4>
            <span class="desc">{{ $collection->description }} </span>
            <img src="{{ url('storage/products/thumb_'. $collection->product->image ) }}" alt="{{ $collection->name .','. $collection->product->name }}" />
            <div class="item_foot">
                <span class="price">{{ $collection->product->price }} руб.</span>
                <a href="{{ product_url($collection->product->slug) }}" class="order_btn">Подарить</a>
            </div>
        </div>
    @else
        <div class="item">
            <h4 class="title_item">{{ $collection->name }}</h4>
            <img src="{{ url('storage/collections/thumb_'. $collection->image ) }}" alt="{{ $collection->name }}" />
            <div class="item_foot">
                <span class="price"></span>
                <a href="{{ route("menu.collection", ["collection" => $collection->slug]) }}" class="order_btn">Посмотреть</a>
            </div>
        </div>
    @endif
@empty
@endforelse
