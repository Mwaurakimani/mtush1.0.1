//main module js file
const main_page = '/libs/js/System.js';

//jquery
const JQuery = 'https://code.jquery.com/jquery-3.5.1.min.js'

//reload the site on save
// const live_page = '/libs/js/live.js';

//hooks
const postHook = '/libs/js/hooks/post.js';
const printHook = '/libs/js/hooks/printAction.js';

//views
const loginView = '/libs/js/views/login_view.js';
const homeView = '/libs/js/views/home_view.js';
const userAccount = '/libs/js/views/userAccount_view.js';
const vendorView = '/libs/js/views/vendor_view.js';
const catalogueView = '/libs/js/views/catalogueView.js';
const pointOfSale = '/libs/js/views/pointOfSale.js';
const viewSales = '/libs/js/views/sales_view.js';
const moderator = '/libs/js/views/moderator_view.js';


require([
    main_page,
    live_page,
    //hooks
    postHook,
    printHook,
    // views
    loginView,
    homeView,
    userAccount,
    vendorView,
    catalogueView,
    pointOfSale,
    viewSales

], function() {
    $(document).ready(function() {
        if (entered != null) {
            renderContent('pointOfSale');
        }


        function callBack() {
            openCatalogue();
        }
    });
});