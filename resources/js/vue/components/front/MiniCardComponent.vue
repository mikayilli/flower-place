<template>
    <div class="result_block">
        <div class="head_result">
            <span class="title_head">Итог</span>
            <span class="price_head">{{ cardTotal }} руб</span>
        </div>
        <a :href="frontUrl + '/checkout'" type="button" class="btn_order">Оформить заказ</a>
    </div>
</template>

<script>
export default {
    name: "MiniCardComponent",
    data: function(){
      return {
          cardTotal: 0,
          frontUrl: window.frontBaseUrl
      }
    },
    mounted() {
        this.$root.$on('updateMyCard', (data) => {
            this.cardTotal = data.cardTotal;
        });
    },
}
</script>

<style scoped>
    .btn_order {
        text-align: center;
        line-height: 40px !important;
    }
</style>
