(() => {
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let commissionPayout_table = $("#commissionPayout").DataTable({
            order: [[0, "desc"]],
        });
    });
})();
