<template>
  <div>
    <h1>Products</h1>

<div class="box" v-for="product in products" :key="product.id">
  <router-link :to="{name: 'products.show', params: {slug: product.slug}}">{{product.name}}</router-link>
  <div>
  <span class="tag" v-for="category in product.categories" :key="category.name">
{{category.name}}
  </span>
<div v-text="fortmatPrice(product.price)"></div>
  </div>
</div>
  
  </div>
</template>

<script>
export default {
  methods: {
    fortmatPrice(price) {
      return price.toLocaleString() + "円";
    },
    // honda2(name) {
    //   return name.toLocaleString() + "円"
    // }
  },

  computed: {
    products() {
      return this.$store.state.products;
    },
    honda() {
      return "honda"
    }
  }



}
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