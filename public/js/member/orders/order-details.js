(() => {
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let orderDetails_table = $("#order-details").DataTable();
    });

    
})();
