<template>
  <div style="width: 100%;">
    <header-menu></header-menu>
    <router-view></router-view>
  </div>
</template>

<script>
import HeaderMenu from "./includes/header.vue"
export default {
  components: {
    HeaderMenu
  }

}
</script>

<style>

</style>