<template>
    <div class="basket_overlay">
        <div class="overlay_inner">
            <div class="basket_inner">
                <button type="button" class="close_basket">
                    <img src="/assets/images/icons/close.svg" alt="#">
                </button>
                <div class="start_inner">
                    <span class="title_basket">Моя корзина</span>
                    <div class="items">
                        <div class="item"  v-for="(card, index) in cards">
                            <div class="left_column">
                                <div class="img">
                                    <img  :src="frontUrl + '/storage/products/thumb_' + card.image" alt="#">
                                </div>
                            </div>
                            <div class="right_column">
                                <div class="head_column">
                                    <div class="head_left_col">
                                        <span class="item_title"> {{ card.name }} </span>
                                    </div>
                                    <button type="button" @click="remove(index)">
                                        <img src="/assets/images/icons/trash.svg" alt="#">
                                    </button>
                                </div>
                                <div class="foot_column">
                                    <div class="counter">
                                        <button type="button" class="decrease"  @click="decrease(card)">
                                            <img src="/assets/images/icons/minus.svg" alt="#">
                                        </button>
                                        <span class="count">{{ card.count }}</span>
                                        <button type="button" class="increase"  @click="increase(card)">
                                            <img src="/assets/images/icons/pluse.svg" alt="#">
                                        </button>
                                    </div>
                                    <div class="price_col">
                                        <span class="price"> {{ getPrice(card) }} руб. </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span v-for="(card, cardIndex) in cards" v-if="card.items.length">
                            <div class="item"  v-for="(item, index) in card.items">
                                <div class="left_column">
                                    <div class="img">
                                        <img  :src="frontUrl + '/storage/products/thumb_' + item.image" alt="#">
                                    </div>
                                </div>
                                <div class="right_column">
                                    <div class="head_column">
                                        <div class="head_left_col">
                                            <span class="item_title"> {{ item.name }} </span>
                                            <span class="item_label" v-if="item.type.description"> ({{ item.type.description }}) </span>
                                        </div>
                                        <button type="button" @click="removeItem(cardIndex, index)">
                                            <img src="/assets/images/icons/trash.svg" alt="#">
                                        </button>
                                    </div>
                                    <div class="foot_column">
                                        <div class="counter">
                                            <button type="button" class="decrease"  @click="decrease(item)">
                                                <img src="/assets/images/icons/minus.svg" alt="#">
                                            </button>
                                            <span class="count">{{ item.count }}</span>
                                            <button type="button" class="increase"  @click="increase(item)">
                                                <img src="/assets/images/icons/pluse.svg" alt="#">
                                            </button>
                                        </div>
                                        <div class="price_col">
                                            <span class="price_sale" v-if="item.addition_discount"> {{ getPriceWithDiscount(item) }} руб. </span>
                                            <span class="price"> {{ getItemPrice(item) }} руб. </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="foot_inner_basket">
                    <div class="total_price">
                        <span class="total_label">Всего</span>
                        <span class="total_count">{{ getTotalPrice(cards) }} руб</span>
                    </div>
                    <a :href="cards.length ? '/checkout' : null" type="button" class="btn_order">Заказать</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CardComponent",
    data: function() {
        return {
            cards: [],
            frontUrl: window.frontBaseUrl,
            checkout: {
                delivery: {}
            }
        }
    },
    methods: {
        setDb() {
            localStorage.setItem('cards', JSON.stringify(this.cards));
            this.$root.$emit('updateMyCard', {cardTotal: this.getTotalPrice(this.cards)});
            this.$root.$emit('updateCardIconCount', this.cards.length);
        },
        getDb(){
            this.cards = localStorage.getItem('cards') ? JSON.parse(localStorage.getItem('cards')) : [];
            this.$root.$emit('updateMyCard', {cardTotal: this.getTotalPrice(this.cards)});
            this.$root.$emit('updateCardIconCount', this.cards.length);
        },
        getTotalPrice(cards){
            let total = cards.reduce((current, item) => {
                    //get card additions total
                   let additionTotal = item.items.reduce((additionCurrent, addition) => additionCurrent + this.getItemPrice(addition), 0);

                    //get card total
                   return  current + this.getPrice(item) + additionTotal;
                }, 0);

            return total.toFixed(2);
        },
        getPrice(item) {
            let size = localStorage.getItem('sizes') ? JSON.parse(localStorage.getItem('sizes')) : null;
            if(item.sizes && size) {
                if([item.sizes.name_small, item.sizes.name_medium, item.sizes.name_big].includes(size.name) && item.slug === size.slug) {
                    item.price = size.price;
                    this.setSelectedSize(item,size);
                }
            }

            if(item.discount) {
                let price = +item.count * (+item.price)
                return price - (price * (+item.discount.percent)) / 100;
            }

            return +item.count * (+item.price);
        },
        getPriceWithDiscount(item){
            if(item.discount) {
                let price = +item.count * (+item.price)
                return price - (price * (+item.discount.percent)) / 100;
            }

            return +item.count * (+item.price);
        },
        getItemPrice(item) {
            if(item.addition_discount) {
                let price = +item.count * this.getPriceWithDiscount(item)
                return price - (price * (+item.addition_discount)) / 100;
            }

            return +item.count * (+item.price);
        },
        decrease(card){
            if(card.count === 1) return;

            card.count -= 1;
            this.setDb();
        },
        increase(card) {
            card.count += 1;
            this.setDb();
        },
        remove(index) {
            this.cards.splice(index,1);
            this.setDb();
        },
        removeItem(cardIndex, index) {
            this.cards[cardIndex].items.splice(index,1);
            this.setDb();
        },
        setSelectedSize(product,size){
            let index = this.cards.findIndex(item => item.slug === product.slug);
            if(index >= 0) {
                this.cards[index].selected_size = size;
            }
        }
    },
    mounted() {
        this.$root.$on('addToCard', (product) => {
            let index = this.cards.findIndex(function(item){
                return item.slug === product.slug;
            });

            if(index >= 0) {
                this.cards[index].count = +this.cards[index].count + 1;
            } else {
                product.count = 1;
                product.items = [];
                this.cards.push(product);
            }

            this.setDb();
        });

        this.$root.$on('updateCard', () => {
           this.getDb();
        });

        this.$root.$on('addAddition', (product, addition) => {

            addition.count = 1;

            let index = this.cards.findIndex(function(item){
                return item.slug === product.slug;
            });

            if(index >= 0) {
                let itemIndex = this.cards[index].items.findIndex(function(item){
                    return item.slug === addition.slug;
                });

                if(itemIndex >= 0){
                    this.cards[index].items[itemIndex].count = +this.cards[index].items[itemIndex].count + 1;
                } else {
                    this.cards[index].items.push(addition);
                }
            } else {
                product.count = 1;
                product.items = []
                product.items.push(addition);
                this.cards.push(product);
            }

            this.setDb();
        });

        this.$root.$on('getPrice', (product) => {
            return this.getPrice(product);
        });

        this.getDb();
    }
}
</script>

<style scoped>

</style>
