(() => {
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let orders_table = $("#orders").DataTable({
            order: [[0, "desc"]],
        });

        const statusFilter = $("#statusFilter");

        // Function to filter the table rows based on the selected value
        function filterTableByStatus() {
            const selectedValue = statusFilter.val().toLowerCase(); // Convert to lowercase for comparison
            if (selectedValue === "all") {
                orders_table.columns(4).search("").draw();
            } else {
                orders_table.columns(4).search(selectedValue).draw();
            }
        }

        // Call the filter function when the select value changes
        statusFilter.on("change", function () {
            filterTableByStatus();
        });

        $(document).on("click", ".btn-order", function (e) {
            e.preventDefault();
            __this = $(this);
            let order_id = $(this).data("order");
    
            Swal.fire({
                title: "Are You Sure?",
                text: "Are you want to sure?",
                icon: "warning",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: APP_URL + "/service-provider/mark-received/" + order_id,
                        data: {
                            order_id,
                        },
                        dataType: "JSON",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    title: response.message,
                                    icon: "success",
                                    showCancelButton: false,
                                });
                                orders_table.draw();
                                location.reload();
                            } else {
                                Swal.fire({
                                    text: "Something went wrong!",
                                    confirmButtonColor: "#4466f2",
                                    footer:
                                        '<small style="color:red">' +
                                        response.message +
                                        "</small>",
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                            Swal.fire({
                                text: "Something went wrong!",
                                confirmButtonColor: "#4466f2",
                                footer: '<small style="color:red">An error occurred while processing the request.</small>',
                            });
                        },
                    });
                }
            });
        });
    });
})();
