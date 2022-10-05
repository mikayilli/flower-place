<template>
    <div class="left_column" id="productFilter">
        <div class="column_inner_product">
            <!-- price -->
            <div class="filter_item">
                <button type="button" class="accordion_btn">
                    <span>По цене</span>
                    <img src="/assets/images/icons/downArrow.svg" alt="#" />
                </button>
                <div class="accordion">
                    <div class="multi-range-container">
                        <div class="multi-range">
                            <input
                                class="range"
                                type="range"
                                min="0"
                                max="10"
                                value="0"
                                step="0.1"
                                id="lower"
                                v-model="filter.price.range.min"
                                v-on:input="setRange('min')"

                            />
                            <span id="range-color" class="range-color"></span>
                            <input
                                class="range"
                                type="range"
                                min="0"
                                max="10"
                                value="10"
                                step="0.1"
                                id="upper"
                                v-model="filter.price.range.max"
                                v-on:input="setRange('max')"
                            />
                        </div>
                    </div>
                    <div class="range_inputs_col">
                        <input type="number" v-model="filter.price.min" @input="filterChange"/>
                        <span>-</span>
                        <input type="number" v-model="filter.price.max" @input="filterChange"/>
                    </div>
                </div>
            </div>

            <!-- color -->
            <div class="filter_item">
                <button type="button" class="accordion_btn active_accordion">
                    <span>По цвету</span>
                    <img src="/assets/images/icons/downArrow.svg" alt="#" />
                </button>
                <div class="accordion">
                    <div class="colors_block">
                        <button
                            v-for="color in colors"
                            type="button"
                            class="color_item"
                            :class="{'color_item': true, 'active_item': isActiveColor(color.id)}"
                            :style="`border-color: ${color.code}`"
                            @click="addColor(color.id)"
                        >
                      <span
                          :data-color="color.code"
                          :style="`background: ${color.code}`"
                      ></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- sostav -->
            <div class="filter_item">
                <button type="button" class="accordion_btn">
                    <span>Состав</span>
                    <img src="/assets/images/icons/downArrow.svg" alt="#" />
                </button>
                <div class="accordion">
                    <label class="custom_checkbox" v-for="tag in tags">
                        {{ tag }}
                        <input type="checkbox" v-on:click="updateTags(tag)" :checked="isChecked(tag)"/>
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <!-- quantity -->
            <div class="filter_item">
                <button type="button" class="accordion_btn">
                    <span>Количество</span>
                    <img src="/assets/images/icons/downArrow.svg" alt="#" />
                </button>
                <div class="accordion">
                    <input type="number" class="quantity_input" v-model="filter.quantity" v-on:input="filterChange"/>
                </div>
            </div>
            <!-- length -->
            <div class="filter_item">
                <button type="button" class="accordion_btn active_accordion">
                    <span>Длина</span>
                    <img src="/assets/images/icons/downArrow.svg" alt="#" />
                </button>
                <div class="accordion">
                    <label class="custom_checkbox reverse" v-for="range in lengthRange">
                        {{ range }} см
                        <input type="checkbox" :checked="filter.lengths.some(item => item == range)" @click="setLengthRange(range)"/>
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FilterSideAction",
    props: ["tags", "getParams"],
    data: function() {
        return {
            filter: {
                page: 1,
                price: {
                    range : {min:0, max:100},
                    min:0,
                    max: 10000
                },
                lengths: [],
                colors: [],
                tags: [],
                quantity: false
            },
            colors: [],
            lengthRange: [40,50,60,70,80,90,100],
            frontUrl: window.frontBaseUrl,
        }
    },
    methods: {
        setRange(val) {
            if(val === 'min') {
                this.filter.price.min = this.filter.price.range.min * 1000
            } else {
                this.filter.price.max = this.filter.price.range.max * 1000
            }
            this.filterChange();
        },
        setLengthRange(val) {
            let index = this.filter.lengths.findIndex(item => item == val);

            if(index >= 0) {
                this.filter.lengths.splice(index, 1);
            } else {
                this.filter.lengths.push(val)
            }
            this.filterChange();
        },
        getColors() {
            axios.post(this.frontUrl + '/colors/filter')
                .then(response => {
                        this.colors = response.data;
                }).finally(_ => {
                    this.setParams()
            });
        },
        addColor(id) {
            let index = this.filter.colors.findIndex(color => color == id);
            if(index >= 0) {
                this.filter.colors.splice(index,1);
            }else {
                this.filter.colors.push(id);
            }

            this.filterChange()
        },
        isActiveColor(id) {
          return this.filter.colors.some(item => item == id);
        },
        isChecked(tag) {
            return this.filter.tags.some(item => item == tag)
        },
        setParams(){
            for(let item in this.getParams) {
                if(typeof this.getParams[item] == 'object') {
                    for(let param in this.getParams[item]){
                        this.filter[item][param] = this.getParams[item][param];
                    }
                }else {
                    this.filter[item] =  this.getParams[item];
                }
            }
            this.filterChange({});
        },
        updateTags(tag){
            let index = this.filter.tags.indexOf(tag);
            if(index >= 0) {
                this.filter.tags.splice(index,1);
            }else {
                this.filter.tags.push(tag);
            }

            this.filterChange();
        },
        filterChange() {
            let filter = {...this.filter};

            if(filter.price.min == 0 && filter.price.max == 10000)
                delete  filter.price;

            this.$emit("filterChange", filter);
        }
    },
    mounted() {
        this.getColors();
    }
}
</script>

<style scoped>

</style>
