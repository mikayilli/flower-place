<template>
    <button type="button" class="btn_basket">
        <span class="badge">{{ count }}</span>
        <img src="/assets/images/icons/basket.svg" alt="#" />
    </button>
</template>

<script>
export default {
    name: "CardCountIcon",
    data: function (){
        return {
            count: 0
        }
    },
    mounted() {
        this.$root.$on("updateCardIconCount", count => this.count = count)
    }
}
</script>

<style scoped>

</style>
