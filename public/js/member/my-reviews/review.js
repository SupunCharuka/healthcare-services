(() => {
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let getReviews_table = $("#reviews").DataTable({
            order: [
                [0, "desc"]
            ],
        });
    });
})();
