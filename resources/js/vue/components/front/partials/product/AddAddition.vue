<template>
    <span @click="addToCard">
            <slot></slot>
    </span>
</template>

<script>
export default {
    name: "AddAddition" ,
    props: ["product", "addition"],
    methods: {
        addToCard() {
            this.$root.$emit('addAddition', this.product, this.addition);
        }
    }
}
</script>

<style scoped>

</style>
