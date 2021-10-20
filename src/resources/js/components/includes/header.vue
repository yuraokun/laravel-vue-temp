<template>
  <div style="text-align: center; padding: 20px;">
    <h1>Honda Shopping Site ^-^</h1>
    <nav>
      <router-link :to="{name: 'products.index'}">
        Products
      </router-link>
      <router-link :to="{name: 'orders.checkout'}">
        Check Out
        <span>({{$store.state.cart.length}} ) items</span>
      </router-link>
      
    </nav>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>