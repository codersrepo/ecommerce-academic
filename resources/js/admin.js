global.$ = global.jQuery = require("jquery");
require("bootstrap");
require("metismenu");
require("jquery-slimscroll");
require("../template/admin/assets/js/app");
import Swal from 'sweetalert2';

global.admin = {

    showSuccessMessage: function(title, message) {
        Swal.fire(title, message, "success");
    },
    showErrorMessage: function(title, message) {
        Swal.fire({
            icon: "error",
            title: title,
            text: message
        });
    }



}
