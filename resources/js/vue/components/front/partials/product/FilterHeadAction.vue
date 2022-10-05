<template>
    <div class="products_head_actions">
        <button type="button" class="btn_product_filter">Фильтры</button>
        <select name="#" class="select" v-model="filter.action" v-on:change="filterChange">
            <option value="">--select--</option>
            <option value="trend">В тренде</option>
            <option value="new">Новые</option>
            <option value="popular">Популярные</option>
            <option value="action">По акции</option>
            <option value="discount">На скидке</option>
        </select>
        <div class="download_col">
            <button type="button" class="download_btn" v-on:click="price">
                <span>Цена</span>
                <img src="/assets/images/icons/download.svg" alt="#" />
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "FilterHeadAction",
    data: function() {
        return {
            filter: {
                price_sort: 'asc',
                'page': 1,
                action: ""
            }
        }
    },
    methods : {
        price() {
            if(this.filter.price_sort === 'asc') {
                this.filter.price_sort = 'desc';
            }else {
                this.filter.price_sort = 'asc';
            }

            this.$emit("changeOrder", this.filter.price_sort);
        },
        filterChange() {
            this.$emit("filterChange", this.filter);
        }
    }
}
</script>

<style scoped>

</style>
