document.addEventListener("DOMContentLoaded", function () {
    // sidebar toggle js
    const toggleBar = document.querySelector("#toggle-bar");
    const toggleSidebar = document.querySelector(".sidebar-wrapper");
    const toggleMainPage = document.querySelector(".main-body-wrapper");

    function sidebarExpand() {
        toggleSidebar.classList.toggle("sidebar-custom-width");
        toggleMainPage.classList.toggle("main-page-width");
    }

    // toggleBar.addEventListener("click", sidebarExpand);

    // toastr.options = {
    //     "closeButton": false,
    //     "debug": false,
    //     "newestOnTop": false,
    //     "progressBar": true,
    //     "positionClass": "toast-top-right",
    //     "preventDuplicates": false,
    //     "showDuration": "300",
    //     "hideDuration": "1000",
    //     "timeOut": "5000",
    //     "extendedTimeOut": "1000",
    //     "showEasing": "swing",
    //     "hideEasing": "linear",
    //     "showMethod": "fadeIn",
    //     "hideMethod": "fadeOut"
    // }
});