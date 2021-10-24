<template>
    <div>
        <h1>Products</h1>
        <div>
            <label>search key</label>
            <input type="text" v-model="word" />
        </div>

        <div class="box" v-for="product in products" :key="product.id">
            <router-link
                :to="{ name: 'products.show', params: { slug: product.slug } }"
                >{{ product.name }}</router-link
            >
            <div>
                <span
                    class="tag"
                    v-for="category in product.categories"
                    :key="category.name"
                >
                    {{ category.name }}
                </span>
                <div v-text="fortmatPrice(product.price)"></div>
            </div>
        </div>

        <hr />

        <div v-if="titles.length > 0" style="text-align: center;">
            <li v-for="(title, index) in titles" :key="index">
                Book {{ title.title }} : ({{ title.author.name }})
            </li>
        </div>
        <div v-else>
            <p>検索に該当するものがありません</p>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            titles: [],
            word: null
        };
    },
    methods: {
        fortmatPrice(price) {
            return price.toLocaleString() + "円";
        },
        getTitles() {
            axios("/api/test-invoke")
                .then(res => {
                    this.titles = res.data;
                })
                .catch(err => console.log(err));
        }
        // honda2(name) {
        //   return name.toLocaleString() + "円"
        // }
    },
    mounted() {
        this.getTitles();
    },
    computed: {
        products() {
            return this.$store.state.products;
        },
        honda() {
            return "honda";
        }
    },
    watch: {
        word: function() {
            axios({
                method: "POST",
                url: "/api/find",
                data: { word: this.word }
            })
                .then(res => {
                    console.log(res.data);
                    this.titles = res.data;
                    console.log(this.titles);
                })
                .catch(err => console.log(err));
        }
    }
};
</script>

<style scoped>
h1 {
    text-align: center;
}
.box {
    border: 1px solid rgb(109, 106, 106);
    padding: 10px;
    width: 30%;
    margin: 0 auto 10px;
}

.tag {
    margin: 5px;
    color: orange;
}
</style>
