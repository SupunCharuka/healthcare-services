(() => {
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $("body").on("click", ".complete", function () {
            let formData = new FormData();
            formData.append("iquiryId", $(this).data("iquiryid"));
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#4466f2",
                cancelButtonColor: "#b5b5b5",
                confirmButtonText: "Yes, approve it!",
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: APP_URL + "/service-provider/my-inquiry/complete",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response.success) {
                                Swal.fire("Done!", response.message, "success");
                                // $("#message").html("<span class='status'>Completed</span>");
                                // $(".complete").hide();
                                // $(".reject").hide();
                                window.location.reload();

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
                        error: function (response) {
                            Swal.fire({
                                text: "Something went wrong!",
                                confirmButtonColor: "#4466f2",
                                footer:
                                    '<small style="color:red">' +
                                    response.message +
                                    "</small>",
                            });
                        },
                    });
                }
            });
        });

        $("body").on("click", ".reject", function () {
            let formData = new FormData();
            formData.append("iquiryId", $(this).data("iquiryid"));
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to reject this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#FF5370CC",
                cancelButtonColor: "#b5b5b5",
                confirmButtonText: "Yes, reject it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        data: formData,
                        url: APP_URL + "/service-provider/my-inquiry/reject",
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            Swal.fire("Done!", response.message, "success");
                            // $("#message").html("<span class='cancel'>Rejected</span>");
                            // $(".complete").hide();
                            // $(".reject").hide();
                            window.location.reload();
                        },
                        error: function (response) {
                            Swal.fire({
                                text: "Something went wrong!",
                                confirmButtonColor: "#4466f2",
                                footer:
                                    '<small style="color:red">' +
                                    response.message +
                                    "</small>",
                            });
                        }
                    });
                }
            });
        });

    });
})();
