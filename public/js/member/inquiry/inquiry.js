 (() => {
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let getInquiries_table = $("#memberInquiry").DataTable({
            order: [[0, "desc"]],
        });

        const statusFilter = $("#statusFilter");

        // Function to filter the table rows based on the selected value
        function filterTableByStatus() {
            const selectedValue = statusFilter.val().toLowerCase(); // Convert to lowercase for comparison
            if (selectedValue === "all") {
                getInquiries_table.columns(3).search("").draw();
            } else {
                getInquiries_table.columns(3).search(selectedValue).draw();
            }
        }

        // Call the filter function when the select value changes
        statusFilter.on("change", function () {
            filterTableByStatus();
        });
    });
})();
