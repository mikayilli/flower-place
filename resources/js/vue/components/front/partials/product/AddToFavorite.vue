<template>
    <span @click="addToFavorite">
        <slot></slot>
    </span>
</template>

<script>
export default {
    props: ["product", "url"],
    name: "AddToFavorite",
    methods: {
        addToFavorite(){
            let favorites = localStorage.getItem('favorites') ? JSON.parse(localStorage.getItem('favorites')) : [];
            self = this;
            let index = favorites.findIndex(function (item) {
                return item.slug === self.product.slug;
            });

            if (index < 0) {
                self.product.count = 1;
                self.product.url = self.url;
                self.product.items = [];
                favorites.push(this.product);
            } else {
                favorites.splice(index, 1);
            }

            localStorage.setItem('favorites', JSON.stringify(favorites));
            this.$root.$emit('updateFavoriteIconCount', favorites.length)
            this.$root.$emit('updateFavorites', favorites)
        }
    }
}
</script>

<style scoped>

</style>
