$(document).ready(function () {
    $('.datepicker').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD'
        },
        "autoApply": true
    });
});