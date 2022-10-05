<template>
    <span>
        <slot v-if="cards.length"></slot>
        <a v-else type="button" class="fast_order">Быстрый заказ</a>
    </span>
</template>

<script>
export default {
    name: "GoToCheckout",
    data: function(){
        return {
            cards: []
        }
    },
    methods:{
        getDb() {
            this.cards = localStorage.getItem('cards') ? JSON.parse(localStorage.getItem('cards')) : [];
        }
    },
    mounted() {
        this.$root.$on('updateMyCard', () => {
            this.getDb();
        });

        this.getDb();
    }
}
</script>

<style scoped>

</style>
