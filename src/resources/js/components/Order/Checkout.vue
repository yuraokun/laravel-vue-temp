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
                        <button @click="$store.commit('removeFromCart', index)">
                            Remove
                        </button>
                        <!-- <button @click="$store.commit('reduceFromCart', item)">Reduce</button> -->
                    </td>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td v-text="cartQuantity"></td>
                    <td v-text="cartTotal"></td>
                </tr>
            </tbody>

            <div style="margin-top: 30px">
                <div>
                    <label>first name</label>
                    <input
                        type="text"
                        name="first_name"
                        v-model="customer.first_name"
                    />
                </div>
                <div>
                    <label>last name</label>
                    <input
                        type="text"
                        name="last_name"
                        v-model="customer.last_name"
                    />
                </div>
                <div>
                    <label>email</label>
                    <input type="email" name="email" v-model="customer.email" />
                </div>

                <div>
                    <label>Address</label>
                    <input
                        type="text"
                        name="address"
                        v-model="customer.address"
                    />
                </div>
                <div>
                    <label>City</label>
                    <input type="text" name="city" v-model="customer.city" />
                </div>
                <div>
                    <label>Zip Code</label>
                    <input
                        type="text"
                        name="city"
                        v-model="customer.zip_code"
                    />
                </div>
                <div>
                    <label for="card_element">Payment</label>
                    <div id="card-element"></div>
                </div>
                <button
                    @click="processPayment"
                    :disabled="paymentProcessing"
                    v-text="paymentProcessing ? 'Processing' : 'Pay Now'"
                ></button>
            </div>
        </table>
    </div>
</template>

<script>
import { loadStripe } from "@stripe/stripe-js";
export default {
    data() {
        return {
            stripe: {},
            cardElement: {},
            customer: {
                first_name: "",
                last_name: "",
                email: "",
                address: "",
                city: "",
                state: "",
                zip_code: "",
                payment_method_id: ""
            },
            paymentProcessing: false
        };
    },

    async mounted() {
        console.log(process.env.MIX_HONDA);
        console.log(process.env.MIX_STRIPE_KEY);

        this.stripe = await loadStripe(process.env.MIX_STRIPE_KEY);

        const elements = this.stripe.elements();

        this.cardElement = elements.create("card", {
            classes: {
                base: "payment"
            }
        });

        this.cardElement.mount("#card-element");
    },

    methods: {
        cartLineTotal(item) {
            let price = item.price * item.quantity;
            return price.toLocaleString() + "円";
        },
        reduceCart(item) {},
        async processPayment() {
            this.paymentProcessing = true;

            const {
                paymentMethod,
                error
            } = await this.stripe.createPaymentMethod(
                "card",
                this.cardElement,
                {
                    billing_details: {
                        name:
                            this.customer.first_name +
                            " " +
                            this.customer.last_name,
                        email: this.customer.email,
                        address: {
                            line1: this.customer.address,
                            city: this.customer.city,
                            state: this.customer.state,
                            postal_code: this.customer.zip_code
                        }
                    }
                }
            );

            if (error) {
                this.paymentProcessing = false;
                // alert(error);
                console.log(error);
            } else {
                this.customer.payment_method_id = paymentMethod.id;
                this.customer.amount = this.cart.reduce(
                    (acc, item) => acc + item.price * item.quantity,
                    0
                );
                this.customer.cart = JSON.stringify(this.cart);

                axios
                    .post("/api/purchase", this.customer)
                    .then(response => {
                        this.paymentProcessing = false;
                        this.$store.commit("updateOrder", response.data);
                        this.$store.dispatch("clearCart");

                        this.$router.push({
                            name: "order.summary"
                        });
                    })
                    .catch(error => {
                        this.paymentProcessing = false;
                        // alert(error);
                        console.log(error);
                    });
            }
        }
    },
    computed: {
        cart() {
            return this.$store.state.cart;
        },
        cartQuantity() {
            return this.cart.reduce((acc, item) => acc + item.quantity, 0);
        },
        cartTotal() {
            let price = this.cart.reduce(
                (acc, item) => acc + item.price * item.quantity,
                0
            );

            return price.toLocaleString() + "円";
        }
    }
};
</script>

<style scoped>
table {
    border-collapse: collapse;
    margin: 0 auto;
}

th,
td {
    border: solid 1px; /* 枠線指定 */
    padding: 10px; /* 余白指定 */
}

.payment {
    border: 1px solid teal;
}
</style>
