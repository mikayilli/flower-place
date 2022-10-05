@forelse($sliders as $slider)
   <div class="item">
        <div class="img">
            <img src="{{ url('storage/products/thumb_'. $slider->image ) }}" alt="{{ $slider->name }}" />

            @if($slider->discount)
                <div class="sale">
                    <img src="/assets/images/icons/saleBg.svg" alt="#" />
                    <span>{{ $slider->discount->percent }}%</span>
                </div>
            @endif
            <div class="bottom_actions">
                <add-to-favorite :product='@json($slider)'  :url='@json(product_url($slider->slug))'>
                    <button type="button" class="btn_action_cr">
                        <img src="/assets/images/icons/heart.svg" alt="#" />
                    </button>
                </add-to-favorite>
                <add-to-card :product='@json($slider)'>
                    <button type="button" class="btn_action_cr">
                        <img src="/assets/images/icons/basket.svg" alt="#" />
                    </button>
                </add-to-card>
                <button
                    type="button"
                    class="btn_action_cr show_btn"
                    href="{{ url('storage/products/thumb_'. $slider->image ) }}"
                >
                    <img src="/assets/images/icons/eyeVisible.svg" alt="#" />
                </button>
            </div>
        </div>
        <div class="content">
            <div class="content_title">
                <span class="name">{{ $slider->name }}</span>
                <div class="rating">
                    <span>4,2</span>
                    <img src="/assets/images/icons/star.svg" alt="#" />
                </div>
            </div>
            @if($slider->discount)<span class="price_product_sale">{{ $slider->price }} руб</span> @endif
            <span class="price_product">{{ get_product_price($slider->price, $slider?->discount?->percent) }} руб.</span>
            <a href="{{ product_url($slider->slug) }}" class="order_btn">Заказать</a>
        </div>
    </div>
@empty
@endforelse
