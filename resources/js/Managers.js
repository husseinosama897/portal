/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import draggable from 'vuedraggable'

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

Vue.component('qr-email', require('./components/QrComponent.vue').default);




//----------------------** entry manuale **--------------------

Vue.component('opening-credit', require('./components/Entry_Manule/OpeningCredit1Component.vue').default);


Vue.component('opening-product', require('./components/Entry_Manule/OpeningCreditProduct.vue').default);


Vue.component('accounting-component', require('./components/Entry_Manule/AccountingComponent.vue').default);

Vue.component('openingcredit2-component', require('./components/Entry_Manule/OpeningCredit2Component.vue').default);


Vue.component('manule-component', require('./components/Entry_Manule/ManuleComponent.vue').default);


Vue.component('openingcredit-edit', require('./components/Entry_Manule/OpeningCredit1Edit.vue').default);


Vue.component('openingcredit-supplier-edit', require('./components/Entry_Manule/OpeningCredit2Edit.vue').default);


Vue.component('openingcredit-product-edit', require('./components/Entry_Manule/OpeningCreditProductedit.vue').default);



Vue.component('accounting-edit', require('./components/Entry_Manule/AccountingEdit.vue').default);


Vue.component('print-entry', require('./components/Entry_Manule/PrintManule.vue').default);

Vue.component('create-manule', require('./components/Entry_Manule/CreateManule.vue').default);


//-------------------------------------------------------------

//------------------------** dcc **---------------------------------------

Vue.component('dcc-component', require('./components/managers/DCC/TableComponent.vue').default);




//----------------------** easy *-------------------------------

Vue.component('movements-component', require('./components/easy_restriction/MovementsComponent.vue').default);

Vue.component('capital-component', require('./components/easy_restriction/CapitalComponent.vue').default);


Vue.component('fixedasset-component', require('./components/easy_restriction/FixedassetComponent.vue').default);

Vue.component('withdraw-component', require('./components/easy_restriction/WithdrawComponent.vue').default);


Vue.component('profits-component', require('./components/easy_restriction/ProfitsComponent.vue').default);

Vue.component('home-component', require('./components/easy_restriction/HomeComponent.vue').default);


Vue.component('payrollaccounting-component', require('./components/easy_restriction/PayrollaccountingComponent.vue').default);

Vue.component('movements-edit', require('./components/easy_restriction/MovementsEdit.vue').default);


Vue.component('fixedasset-edit', require('./components/easy_restriction/FixedassetEdit.vue').default);

Vue.component('withdraw-edit', require('./components/easy_restriction/WithdrawEdit.vue').default);



Vue.component('capital-edit', require('./components/easy_restriction/CapitalEdit.vue').default);


Vue.component('profits-edit', require('./components/easy_restriction/ProfitsEdit.vue').default);

Vue.component('Payroll-edit', require('./components/easy_restriction/PayrollaccountingEdit.vue').default);

Vue.component('print-easy_entry', require('./components/easy_restriction/PrintEasy_entry.vue').default);


//----------------------------------------------------------------


///// -------------- ** products components  --------------------------------


Vue.component('product-component', require('./components/product/ProductComponent.vue').default);

Vue.component('product-table-component', require('./components/product/ProductTableComponent.vue').default);

Vue.component('product-edit', require('./components/product/ProductEdit.vue').default);




// -----------------------------------------------------------

//--------------------------** Suppliers ** ----------------------------

Vue.component('supplier-component', require('./components/managers/supplier/SupplierComponent.vue').default);

Vue.component('supplier-table-component', require('./components/managers/supplier/SupplierTableComponent.vue').default);



//----------------------** ends of suppliers ----------------------------


///// -------------- ** tree components  --------------------------------


Vue.component('account-component', require('./components/tree/AccountComponent.vue').default);

Vue.component('table-account-component', require('./components/tree/TableAccountComponent.vue').default);

Vue.component('account-edit', require('./components/tree/AccountEdit.vue').default);



// ----------------------------------- * * * princingsupplier * * * -------------------------------------------------


Vue.component('pricing-update-manager', require('./components/managers/pricing_supplier/UpdateComponent.vue').default);


Vue.component('pricing-table-manager', require('./components/managers/pricing_supplier/TableComponent.vue').default);


Vue.component('pricing-print-manager', require('./components/managers/pricing_supplier/PrintComponent.vue').default);



// ----------------------------------- * * * CWS * * * -------------------------------------------------


Vue.component('cws-update-component', require('./components/managers/contract_withsubcontractor/UpdateComponent.vue').default);

Vue.component('cws-table-component', require('./components/managers/contract_withsubcontractor/TableComponent.vue').default);


Vue.component('cws-print-component', require('./components/managers/contract_withsubcontractor/CwsPrint.vue').default);



import VueCookies from 'vue-cookies'
Vue.use(VueCookies)
Vue.$cookies.config('1d')

// --------------------------------- * * * notification * * *  ---------------------------------------------
Vue.component('notify-component', require('./components/notification/NotifyComponent.vue').default);

Vue.component('notification-menu', require('./components/notification/NotificationMenu.vue').default);



// --------------------------------- managers ----------------------------------------------------------


// -------------------------- * * *  service * * * ------------------------------------------------------



Vue.component('print-service-manager', require('./components/managers/service/PrintComponent.vue').default);

Vue.component('index-service-manager', require('./components/managers/service/TableComponent.vue').default);

Vue.component('update-service-manager', require('./components/managers/service/UpdateComponent.vue').default);




// --------------------------- * * * job offer * * * ---------------------------------------------

Vue.component('joboffer-update-manager', require('./components/managers/joboffer/UpdateComponent.vue').default);

Vue.component('joboffer-index-manager', require('./components/managers/joboffer/TableComponent.vue').default);

Vue.component('joboffer-print-manager', require('./components/managers/joboffer/PrintComponent.vue').default);



//managers matrial 


Vue.component('matrial-update-manager', require('./components/managers/matrial_request/UpdateComponent.vue').default);

Vue.component('matrial-table-manager', require('./components/managers/matrial_request/TableComponent.vue').default);

Vue.component('print-matrial-manager', require('./components/managers/matrial_request/PrintMatrial.vue').default);



/// -------------------------   ** Subcontractor Inv **  --------------------------------------

Vue.component('subcontractor-update-manager', require('./components/managers/subcontractor/UpdateComponent.vue').default);

Vue.component('subcontractor-table-manager', require('./components/managers/subcontractor/TableComponent.vue').default);

Vue.component('print-sub-manager', require('./components/managers/subcontractor/PrintSub.vue').default);


//-------------------------* Users -------------------------------------------
Vue.component('add-user', require('./components/AddUser.vue').default);

Vue.component('edit-user', require('./components/EditUser.vue').default);


Vue.component('table-user', require('./components/TableUser.vue').default);


//-------------------* project *-----------------------------

Vue.component('project-component', require('./components/project/TableComponent.vue').default);
Vue.component('report-component', require('./components/project/ReportComponent.vue').default);

Vue.component('po-component', require('./components/project/PoComponent.vue').default);


Vue.component('staff-component', require('./components/project/StaffComponent.vue').default);


Vue.component('subcontractor-component', require('./components/project/subcontractorComponent.vue').default);


Vue.component('petty-cash', require('./components/project/PettyCash.vue').default);


// ----------------------- customer ------------------------------------------------

Vue.component('customer-create-component', require('./components/managers/customer/CreateComponent.vue').default);

Vue.component('customer-table-component', require('./components/managers/customer/CustomerTableComponent.vue').default);

Vue.component('customer-update-component', require('./components/managers/customer/UpdateComponent.vue').default);
// ----------------------------------- * * *  ROLE * * * ------------------------------------------------------

Vue.component('role-create-component', require('./components/managers/role/CreateComponent.vue').default);

Vue.component('role-update-component', require('./components/managers/role/UpdateComponent.vue').default);

Vue.component('role-index-component', require('./components/managers/role/IndexComponent.vue').default);



// ----------------------------------- * * *  section * * * ------------------------------------------------------

Vue.component('section-create-component', require('./components/managers/section/CreateComponent.vue').default);

Vue.component('section-update-component', require('./components/managers/section/UpdateComponent.vue').default);

Vue.component('section-index-component', require('./components/managers/section/IndexComponent.vue').default);




// ------------------------------ ** contractor ** ------------------------------------------
Vue.component('contractor-create-component', require('./components/managers/contractor/CreateComponent.vue').default);

Vue.component('contractor-table-component', require('./components/managers/contractor/TableComponent.vue').default);

Vue.component('contractor-update-component', require('./components/managers/contractor/UpdateComponent.vue').default);

Vue.component('contractor-profile-component', require('./components/managers/contractor/ProfileComponent.vue').default);


// ------------------------------- supplier order -------------------------------------------


Vue.component('supplierorder-table-component', require('./components/managers/supplierorder/TableSupplierorderComponent.vue').default);

Vue.component('supplierorder-create-component', require('./components/managers/supplierorder/SupplierOrderComponent.vue').default);



//------------------------------- **task-manager** ---------------------------------------




Vue.component('update-task-manager', require('./components/managers/task/UpdateComponent.vue').default);

Vue.component('table-task-manager', require('./components/managers/task/TableComponent.vue').default);


Vue.component('task-manager', require('./components/managers/task/CreateComponent.vue').default);

// ------------------------ * * * export * * * ----------------------------------------------------

Vue.component('export-petty_cash', require('./components/managers/export/Petty_cashComponent.vue').default);

Vue.component('export-purchase_order', require('./components/managers/export/Purchase_orderComponent.vue').default);


Vue.component('export-subcontractor', require('./components/managers/export/SubcontrctorComponent.vue').default);


// -------------------------- * * *  managers daily report * * * ------------------------------------------------------




Vue.component('index-daily-manager', require('./components/managers/daily_report/TableComponent.vue').default);

Vue.component('update-daily-manager', require('./components/managers/daily_report/UpdateComponent.vue').default);




//-------------------------   ** WorkFlow  ---------------------------------------------

Vue.component('workflow-purchase-manager', require('./components/managers/workflow/PurchaseComponent.vue').default);

Vue.component('workflow-petty_cash-manager', require('./components/managers/workflow/Petty_cashComponent.vue').default);

Vue.component('workflow-subcontractor-manager', require('./components/managers/workflow/SubcontractorComponent.vue').default);

Vue.component('workflow-joboffer-manager', require('./components/managers/workflow/JobofferComponent.vue').default);

Vue.component('workflow-service-manager', require('./components/managers/workflow/ServiceComponent.vue').default);

Vue.component('workflow-cws-manager', require('./components/managers/workflow/CwsComponent.vue').default);

Vue.component('workflow-employee-manager', require('./components/managers/workflow/EmployeeComponent.vue').default);

Vue.component('workflow-matrial_request-manager', require('./components/managers/workflow/Matrial_requestComponent.vue').default);

Vue.component('workflow-pricing_supplier-manager', require('./components/managers/workflow/Pricing_supplierComponent.vue').default);

// ----------------- Invoice -----------------------------------------


Vue.component('invoice-create-component', require('./components/managers/invoice/CreateComponent.vue').default);

Vue.component('invoice-table-component', require('./components/managers/invoice/TableComponent.vue').default);

Vue.component('invoice-edit-component', require('./components/managers/invoice/EditComponent.vue').default);



///---------------------------- *** Petty cash *** -----------------------------------------

Vue.component('petty_cash-update-manager', require('./components/managers/petty_cash/UpdateComponent.vue').default);

Vue.component('petty_cash-table-manager', require('./components/managers/petty_cash/TableComponent.vue').default);

Vue.component('print-petty-manager', require('./components/managers/petty_cash/PrintPetty.vue').default);




/// ---------------------------- RFQ ---------------------------------------------

Vue.component('rfq-update-manager', require('./components/managers/rfq/UpdateComponent.vue').default);

Vue.component('rfq-table-manager', require('./components/managers/rfq/TableComponent.vue').default);

Vue.component('print-frq-manager', require('./components/managers/rfq/Printfrq.vue').default);


// ///// ///       laborers    //////// ///// ////// /////// ////// ////// //////
Vue.component('table-laborers-manager', require('./components/managers/Laborers/TableComponent.vue').default);

Vue.component('create-laborers-manager', require('./components/managers/Laborers/CreateComponent.vue').default);

Vue.component('update-laborers-manager', require('./components/managers/Laborers/UpdateComponent.vue').default);

Vue.component('performance-laborers-manager', require('./components/managers/Laborers/PerformanceComponent.vue').default);







Vue.component('manule-attending', require('./components/managers/Laborers/ManuleAttending.vue').default);

// ---------- END HR -------------------

Vue.component('add-user', require('./components/AddUser.vue').default);

Vue.component('profile-component', require('./components/managers/Report/profile/ProfileComponent.vue').default);


Vue.component('card-component', require('./components/managers/Report/profile/CardComponent.vue').default);


Vue.component('profile-chart-project_overall', require('./components/managers/Report/profile/OverAll.vue').default);

Vue.component('attendance-list', require('./components/managers/Report/attendance/AttendanceList.vue').default);



//--------------------------------------------------------------

Vue.component('edit-user', require('./components/EditUser.vue').default);

Vue.component('table-user', require('./components/TableUser.vue').default);
//--------------------------------- COST CENTER ---------------------------------
Vue.component('cost_center-component', require('./components/cost_center/TableComponent.vue').default);


// ---------------------------------- PURCHASE ORDER * --------------------------------------------

Vue.component('purchase-update-manager', require('./components/managers/purchase/UpdateComponent.vue').default);

Vue.component('purchase-table-manager', require('./components/managers/purchase/TableComponent.vue').default);

Vue.component('print-purchase-manager', require('./components/managers/purchase/PrintPurchase.vue').default);

// ------------------------------- *** Site Request ** ------------------------------


Vue.component('site-update-manager', require('./components/managers/site/UpdateComponent.vue').default);

Vue.component('site-table-manager', require('./components/managers/site/TableComponent.vue').default);

Vue.component('print-site-manager', require('./components/managers/site/PrintSite.vue').default);
// ----------------------------------- Employee Request -----------------------------------



Vue.component('employee-update-manager', require('./components/managers/employee/UpdateComponent.vue').default);

Vue.component('employee-table-manager', require('./components/managers/employee/TableComponent.vue').default);

Vue.component('print-employee-manager', require('./components/managers/employee/PrintEmployee.vue').default);

//-------------------------------------------------------------------------

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// ----------------------- Salary ----------------------------------

Vue.component('salary-component', require('./components/managers/salary/TableCompoent.vue').default);

/// --------------------- reports -------------------------------------------------

Vue.component('stock-component', require('./components/managers/report/StockComponent.vue').default);

Vue.component('hr-component', require('./components/managers/report/HrComponent.vue').default);

Vue.component('chart-timesheet-performance', require('./components/managers/report/ChartComponent.vue').default);

Vue.component('table-timesheet-performance', require('./components/managers/report/PositionComponent.vue').default);


Vue.component('depending-on-role', require('./components/managers/report/TimeSheet/DependingOnRole.vue').default);

//--------------------- ------------- * * * project time sheet  * * * ------------------------------------
Vue.component('project-time-sheet', require('./components/managers/report/TimeSheet/ProjectTimeSheet.vue').default);



Vue.component('attendace-project-hours', require('./components/managers/report/TimeSheet/ChartsProject_hours.vue').default);



Vue.component('charts-percentage-attendance', require('./components/managers/Report/TimeSheet/ChartsPercentageAttendance.vue').default);



//-------------------------------------------------------------------------------------------------------


Vue.component('chart-percentage-performance', require('./components/managers/Report/performance/ChartsPercentage.vue').default);

Vue.component('chart-point-performance', require('./components/managers/Report/performance/ChartsPoint.vue').default);





Vue.component('chart-project-overall', require('./components/managers/Report/project/OverAll.vue').default);


Vue.component('chart-out-in', require('./components/managers/Report/project/CashOut_In.vue').default);



//----------------------------------ConstructionComponent -----------------------------------
Vue.component('rating-construction', require('./components/managers/Report/section/ConstructionComponent.vue').default);


Vue.component('rating-procurement', require('./components/managers/Report/section/procurementComponent.vue').default);

Vue.component('rating-marketing', require('./components/managers/Report/section/MarketingComponent.vue').default);


Vue.component('rating-tender', require('./components/managers/Report/section/TenderComponent.vue').default);




Vue.component('create-report-financial', require('./components/managers/Report/daily_report_financial/CreateComponent.vue').default);

Vue.component('daily-report-financial', require('./components/managers/Report/daily_report_financial/ReportComponent.vue').default);

Vue.component('print-daily-financial', require('./components/managers/Report/daily_report_financial/PrintComponent.vue').default);












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


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var VueEventBus = require('vue-event-bus')
Vue.use(VueEventBus,{name:'$eventbus'})

const app = new Vue({
    el: '#app',
    draggable
});
