
module.exports = [
  {
    path: '/',
    name: 'products.index',
    component: () => import('./components/Products/Index.vue')
  },
  {
    path: '/product/:slug',
    name: 'products.show',
    component: () => import('./components/Products/Show.vue')

  },
  {
    path: '/checkout',
    name: 'orders.checkout',
    component: () => import('./components/Order/Checkout.vue')

  },
  {
    path: '/summary',
    name: 'orders.summary',
    component: () => import('./components/Order/Summary.vue')

  },
]





// import ExampleComponent from "./components/ExampleComponent";
// import VueRouter from "vue-router";

// const routes = [
//   {
//     path: "/",
//     component: ExampleComponent,
//     name: "home"
//   }
// ]

// const router = new VueRouter({
//   routes
// })

// export default router;