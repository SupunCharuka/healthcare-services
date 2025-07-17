$(function () {
    let tickets_table = $("#tickets").DataTable({
        processing: true,
        serverSide: true,
        ajax: location.href,
        columns: [
            { data: "id", name: "id" },
            { data: "title", name: "title" },
            { data: "file", name: "file" },
            {
                data: "created_at",
                name: "created_at",
                render: function (data) {
                    var date = new Date(data);
                    var formattedDate = date.toLocaleString("en-US", {
                        year: "numeric",
                        month: "short",
                        day: "numeric",
                        hour: "numeric",
                        minute: "numeric",
                        hour12: true,
                    });
                    return formattedDate;
                },
            },
            {
                data: "status",
                name: "status",
                render: function (data) {
                    if (data === "open") {
                        return '<span class="badge badge-success">Open</span>';
                    } else if (data === "close") {
                        return '<span class="badge badge-warning">Close</span>';
                    } else {
                        return '<span class="badge badge-info">Hold</span>';
                    }
                },
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        columnDefs: [
            { targets: 4, className: "text-center" },
            { targets: 5, className: "text-center" },
        ],
    });

    $(document).on("click", ".btn-delete", function (e) {
        e.preventDefault();
        let ticket = $(this).data("id");
        Swal.fire({
            title: "Are You Sure?",
            text: "Are you want to delete this ticket?",
            icon: "warning",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: APP_URL + "/service-provider/support-ticket/" + ticket + "/delete",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                            showCancelButton: false,
                        });
                        tickets_table.draw();
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

    $(document).on("click", ".btn-open", function (e) {
        e.preventDefault();
        let ticket = $(this).data("id");
        Swal.fire({
            title: "Are You Sure?",
            text: "Are you want to open this ticket?",
            icon: "warning",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: APP_URL + "/service-provider/support-ticket/" + ticket + "/open",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                            showCancelButton: false,
                        });
                        tickets_table.draw();
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

    $(document).on("click", ".btn-closed", function (e) {
        e.preventDefault();
        let ticket = $(this).data("id");
        Swal.fire({
            title: "Are You Sure?",
            text: "Are you want to close this ticket?",
            icon: "warning",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: APP_URL + "/service-provider/support-ticket/" + ticket + "/close",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                            showCancelButton: false,
                        });
                        tickets_table.draw();
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
