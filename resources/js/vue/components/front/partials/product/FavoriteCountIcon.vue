<template>
    <a :href="url">
        <span class="badge">{{ count }}</span>
        <img src="/assets/images/icons/heart.svg" alt="#" />
    </a>
</template>

<script>
export default {
    name: "FavoriteCountIcon",
    props: ["url"],
    data: function (){
        return {
            count: 0
        }
    },
    methods: {
        getDb(){
            this.favorites = localStorage.getItem('favorites') ? JSON.parse(localStorage.getItem('favorites')) : [];
            this.count = this.favorites.length;
        }
    },
    mounted() {
        this.getDb();

        this.$root.$on("updateFavoriteIconCount", count => this.count = count)
    }
}
</script>

<style scoped>

</style>
