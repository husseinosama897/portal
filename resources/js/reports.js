/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

require('bootstrap/js/dist/modal');

Vue.component('pagination', require('laravel-vue-pagination'));


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))




Vue.component('ar-vendors', require('./components/managers/reports/Ap_by_Vendors.vue').default);

Vue.component('balance-sheet', require('./components/managers/reports/BalanceSheet.vue').default);

Vue.component('general-ledger', require('./components/managers/reports/General_Ledger.vue').default);

Vue.component('journal-reports', require('./components/managers/reports/Journal_Reports.vue').default);

Vue.component('purchase-order-charts', require('./components/managers/reports/PurchaseOrderCharts.vue').default);

Vue.component('tax-report', require('./components/managers/reports/TaxReport.vue').default);

Vue.component('sales-purchases', require('./components/managers/reports/sales_and_purchases.vue').default);

Vue.component('summary-account', require('./components/managers/reports/SummaryAccount.vue').default);

Vue.component('trial-balances', require('./components/managers/reports/Trial_Balances.vue').default);

Vue.component('ar-customers', require('./components/managers/reports/Ar_by_Customers.vue').default);









/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
