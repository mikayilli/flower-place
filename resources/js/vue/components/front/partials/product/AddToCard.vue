<template>
    <span @click="addToCard">
        <slot></slot>
    </span>
</template>

<script>
export default {
    props: ["product"],
    name: "AddToCard",
    methods: {
        addToCard() {
            this.$root.$emit('addToCard', this.product);
            window.open_card()
        }
    }
}
</script>

<style scoped>

</style>
