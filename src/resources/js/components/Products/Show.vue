<template>
  <section v-if="product">
    <img style="box-shadow: 1px 2px 9px rgba(115, 115, 115, 0.8)" src="https://dummyimage.com/600x400/efefef/000" alt="">
    <div>
      <h1>{{ product.name}}</h1>
      <span style="color: orange;" v-for="category in product.categories" :key="category.id">{{category.name}}</span>
    </div>
    <p>{{ product.description}}</p>
    <h3 v-text="fortmatPrice(product.price)"></h3>



  </section>
</template>

<script>
export default {

  methods: {
    fortmatPrice(price) {
      return price.toLocaleString() + "円";
    },
  },

  computed: {
  products() {
    return $this.$store.state.products;
  },
  product() {
    return this.$store.state.products.find(product => product.slug == this.$route.params.slug)
  }

  }

}
</script>

<style>

</style>