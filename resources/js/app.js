/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)
Vue.use(require('vue-moment'));


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))















// ------------------------- * * * ProjectManager * * * ------------------------------------------------------


//------------------- |||| ------------- manule attendance ----------  |||| --------------------------
Vue.component('manule-attending', require('./components/ProjectManager/ManuleAttending.vue').default);



//--------------------  |||| ----------- * * * Time Sheet * * * ------------   |||   -----------------------------------------

Vue.component('time-sheet-projectmanager', require('./components/ProjectManager/TimeSheet.vue').default);

//--------------------- |||    ----------- * * * charts * * * --------  |||   ----------------------------
Vue.component('project-time-sheet', require('./components/ProjectManager/report/TimeSheet/ProjectTimeSheet.vue').default);


Vue.component('attendace-project-hours', require('./components/ProjectManager/report/TimeSheet/ChartsProject_hours.vue').default);


Vue.component('charts-percentage-attendance', require('./components/ProjectManager/Report/TimeSheet/ChartsPercentageAttendance.vue').default);


Vue.component('chart-percentage-performance', require('./components/ProjectManager/Report/performance/ChartsPercentage.vue').default);

Vue.component('chart-point-performance', require('./components/ProjectManager/Report/performance/ChartsPoint.vue').default);



Vue.component('chart-project-overall', require('./components/ProjectManager/Report/project/OverAll.vue').default);


Vue.component('chart-out-in', require('./components/ProjectManager/Report/project/CashOut_In.vue').default);




// ----------------------------- * * * cost center * *  * ---------------------------------------------------------

Vue.component('report-component', require('./components/ProjectManager/costcenter/ReportComponent.vue').default);

Vue.component('po-component', require('./components/ProjectManager/costcenter/PoComponent.vue').default);


Vue.component('staff-component', require('./components/ProjectManager/costcenter/StaffComponent.vue').default);


Vue.component('subcontractor-component', require('./components/ProjectManager/costcenter/subcontractorComponent.vue').default);


Vue.component('petty-cash', require('./components/ProjectManager/costcenter/PettyCash.vue').default);



// -----------------------------   * * * DCC * * * ------------------------------------------------------------


Vue.component('dcc-projectmanager', require('./components/ProjectManager/DccComponent.vue').default);


// ------------------------------ END OF PROJECT MANAGER ---------------------------------------------------

// -------------------------- * * profile ** * ----------------------------------------------------------

Vue.component('timesheet-user', require('./components/user/TimeSheet.vue').default);

Vue.component('profile-component', require('./components/user/profile/ProfileComponent.vue').default);

Vue.component('profile-chart-project_overall', require('./components/user/profile/OverAll.vue').default);


// -------------------------- ** pricing supplierorder ** ------------------------------------------------


Vue.component('pricing-table-user', require('./components/princingsupplier/TablePricingComponent.vue').default);

Vue.component('pricing-create', require('./components/princingsupplier/PricingOrderComponent.vue').default);

Vue.component('pricing-print', require('./components/princingsupplier/PrintComponent.vue').default);

Vue.component('pricing-order-edit', require('./components/princingsupplier/UpdateComponent.vue').default);



// ----------------------------- * * * JobOffer * * * ------------------------------------
Vue.component('joboffer-create-user', require('./components/joboffer/CreateComponent.vue').default);

Vue.component('joboffer-index-user', require('./components/joboffer/TableComponent.vue').default);

Vue.component('joboffer-print-user', require('./components/joboffer/PrintComponent.vue').default);

Vue.component('joboffer-update-user', require('./components/joboffer/UpdateComponent.vue').default);



// ------------------------------ ** contractor ** ------------------------------------------
Vue.component('contractor-create-user', require('./components/contractor/CreateComponent.vue').default);

Vue.component('contractor-table-user', require('./components/contractor/TableComponent.vue').default);

Vue.component('contractor-update-user', require('./components/contractor/UpdateComponent.vue').default);


// -------------------------- * * *  service * * * ------------------------------------------------------



Vue.component('print-service', require('./components/service/PrintComponent.vue').default);

Vue.component('create-service', require('./components/service/CreateComponent.vue').default);

Vue.component('index-service', require('./components/service/TableComponent.vue').default);

Vue.component('update-service', require('./components/service/UpdateComponent.vue').default);


// -------------------------- * * *  daily report * * * ------------------------------------------------------



Vue.component('print-report', require('./components/daily_report/PrintComponent.vue').default);


Vue.component('projectmanager-daily-report', require('./components/daily_report/ProjectManager.vue').default);

Vue.component('daily-report', require('./components/daily_report/CreateComponent.vue').default);

Vue.component('index-daily-report', require('./components/daily_report/TableComponent.vue').default);

Vue.component('update-daily-report', require('./components/daily_report/UpdateComponent.vue').default);

//--------------------------** Suppliers ** ----------------------------

Vue.component('supplier-user', require('./components/supplier/SupplierComponent.vue').default);

Vue.component('supplier-table-user', require('./components/supplier/SupplierTableComponent.vue').default);





//----------------------------------------------------------------




// -----------------------------------------------------------


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('pru-component', require('./components/purchase/PruComponent.vue').default);

Vue.component('table-component', require('./components/purchase/TableComponent.vue').default);

Vue.component('print-purchase', require('./components/purchase/PrintPurchase.vue').default);

Vue.component('update-purchase', require('./components/purchase/UpdateComponent.vue').default);





//----------------------------------------



Vue.component('subcontractor-create-component', require('./components/subcontractor/CreateComponent.vue').default);


Vue.component('archives-component', require('./components/subcontractor/ArchivesComponent.vue').default);


Vue.component('subcontractor-create-component', require('./components/subcontractor/CreateComponent.vue').default);


Vue.component('subcontractor-table-component', require('./components/subcontractor/TableComponent.vue').default);




Vue.component('subcontractor-update', require('./components/subcontractor/UpdateComponent.vue').default);


Vue.component('print-sub', require('./components/subcontractor/PrintSub.vue').default);





// ------------------ -    * contract_withsubcontractor ----------------------------





Vue.component('cwc-create-component', require('./components/contract_withsubcontractor/CreateComponent.vue').default);


Vue.component('cws-print', require('./components/contract_withsubcontractor/CwsPrint.vue').default);


Vue.component('cwc-table-component', require('./components/contract_withsubcontractor/TableComponent.vue').default);


Vue.component('cwc-update', require('./components/contract_withsubcontractor/UpdateComponent.vue').default);




//-------------------------------------------------------------------------------------

Vue.component('frq-create-component', require('./components/frq/CreateComponent.vue').default);

Vue.component('frq-table-component', require('./components/frq/TableComponent.vue').default);

Vue.component('print-frq', require('./components/frq/Printfrq.vue').default);






Vue.component('employee-create-component', require('./components/employee/CreateComponent.vue').default);

Vue.component('employee-table-component', require('./components/employee/TableComponent.vue').default);


Vue.component('print-employee', require('./components/employee/PrintEmployee.vue').default);






Vue.component('site-create-component', require('./components/site/CreateComponent.vue').default);

Vue.component('site-table-component', require('./components/site/TableComponent.vue').default);

Vue.component('print-site', require('./components/site/PrintSite.vue').default);



//--------------------------** petty cash ** --------------------
Vue.component('petty-create-component', require('./components/petty/CreateComponent.vue').default);

Vue.component('petty-update-component', require('./components/petty/UpdateComponent.vue').default);

Vue.component('petty-table-component', require('./components/petty/TableComponent.vue').default);


Vue.component('print-petty', require('./components/petty/PrintPetty.vue').default);

//--------------------------------------------------------------------------------





import VueCookies from 'vue-cookies'
Vue.use(VueCookies)
Vue.$cookies.config('1d')

// --------------------------------- * * * notification * * *  ---------------------------------------------
Vue.component('notify-component', require('./components/notification/NotifyComponent.vue').default);

Vue.component('notification-menu', require('./components/notification/NotificationMenu.vue').default);

//------------------------------ *** matrial request * * * -----------------------------------------
Vue.component('matrial-table-component', require('./components/matrial_request/TableComponent.vue').default);

Vue.component('print-matrial', require('./components/matrial_request/PrintMatrial.vue').default);

Vue.component('create-matrial', require('./components/matrial_request/CreateComponent.vue').default);


Vue.component('update-matrial', require('./components/matrial_request/UpdateComponent.vue').default);






// -------------------------- ** task emp ---------------------------------------
Vue.component('task-emp', require('./components/task/TableComponent.vue').default);
Vue.component('update-emp-task', require('./components/task/UpdateComponent.vue').default);

// ----------------------- customer ------------------------------------------------








//-------------------------------------------------------------------------

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('laborers-component', require('./components/LaborersPage.vue').default);








import VueHtmlToPaper from 'vue-html-to-paper';

const options = {
    name: '_blank',
    specs: [
      'fullscreen=yes',
      'titlebar=yes',
  
      
      'scrollbars=yes'
    ],

    styles: [
    'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css'
,
'/preview/css/normalize.css',

'/preview/css/bootstrap.min.css',
'/preview/css/style.css',
'/preview/css/print2.css',
      'https://unpkg.com/kidlat-css/css/kidlat.css'
    ]
  }
  
Vue.use(VueHtmlToPaper, options);

import Print from 'vue-print-nb'
// Global instruction 
Vue.use(Print);



require('bootstrap/js/dist/modal');

Vue.component('pagination', require('laravel-vue-pagination'));
var VueEventBus = require('vue-event-bus')
Vue.use(VueEventBus,{name:'$eventbus'})


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 //window.Event = new Vue();

const app = new Vue({
    el: '#app',
   
});
