<template>
  <div style="margin:0 auto; display: flex;justify-contents: center;">
    <table>
      <thead>
        <tr>
          <th>
            Item
          </th>
           <th>
            Quantity
          </th>
           <th>
            Price
          </th>
           <th>
            Actions
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in cart" :key="item.id">
          <td v-text="item.name"></td>
          <td v-text="item.quantity"></td>
          <td v-text="cartLineTotal(item)"></td>
          <td>
            <button @click="$store.commit('removeFromCart', index)">Remove</button>
             <button @click="$store.commit('reduceFromCart', item)">Reduce</button>
          </td>
        </tr>
        <tr>
          <td>Total Amount</td>
          <td v-text="cartQuantity"></td>
          <td v-text="cartTotal"></td>


        </tr>
      </tbody>


    </table>



  </div>
  
</template>

<script>
export default {

  data() {
    return {
      customer: {
        first_name: '',
        last_name: '',
        email: '',
        address: '',
        city:'',
        state: '',
        zip_code: ''
      }

    }
  },
  methods: {
    cartLineTotal(item) {
      let price = (item.price * item.quantity);
      return price.toLocaleString() + "円";
    },
    reduceCart(item) {

    }

  },
  computed: {
    cart() {
      return this.$store.state.cart;
    },
    cartQuantity() {
      return this.cart.reduce((acc, item) =>
        acc + item.quantity, 0
      )
    },
    cartTotal() {
      let price = this.cart.reduce((acc, item) => acc + (item.price * item.quantity), 0)

     return price.toLocaleString() + "円";
    }
  }

}
</script>

<style scoped>
table {
   border-collapse:  collapse; 
   margin: 0 auto;
}

th, td {
      border: solid 1px;  /* 枠線指定 */
    padding: 10px;      /* 余白指定 */
}

</style>