require('./bootstrap');
import Vue from "vue";
import Vuex from "vuex";
import VueRouter from "vue-router";
import axios from "axios";

import App  from "./components/main.vue";
import { create } from "lodash";

// import router from "./routes";

// window.Vue = require('vue').default;


Vue.use(Vuex);
Vue.use(VueRouter);


// // Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const router = new VueRouter({
    mode: 'history',
    routes: require('./routes.js')
})

const store = new Vuex.Store({
    state: {
        products: [],
        cart: [],
        order: {}
    },
    mutations: {
        updateProducts(state, products) {
            state.products = products;
        },
        addToCart(state, product) {
            let productInCartIndex = state.cart.findIndex(item => item.slug == product.slug);
            if (productInCartIndex != -1) {
                state.cart[productInCartIndex].quantity++;
                return;
            }

            product.quantity = 1;
            state.cart.push(product)
        },
        reduceFromCart(state, product) {
            let productInCartIndex = state.cart.findIndex(item => item.slug == product.slug);
            if (state.cart[productInCartIndex].quantity < 2) {
                state.cart.splice(productInCartIndex, 1);
                return 
            }
            state.cart[productInCartIndex].quantity--;

        },
        removeFromCart(state, index) {
            state.cart.splice(index, 1);
        },
        updateOrder(state, order) {
            state.order = order;
        },
        updateCart(state, cart) {
            state.cart = cart;
        }
    },
    actions: {
        getProducts({ commit }) {
            axios.get('/api/products')
                .then(response => {
                commit('updateProducts', response.data)
                })
                .catch(error => {
                console.error(error)
            })
        },
        clearCart({ commit }) {
            commit('updateCart', [])
        }
    }
})

const app = new Vue({
    router,
    store,
    el: '#app',
    components: {
        App
    },
    created() {
        store.dispatch('getProducts')
        .then(() => { })
        .catch(error => console.error(error))
    }
});
// new Vue({
//     el: '#app',
//     components: { App },

// })

