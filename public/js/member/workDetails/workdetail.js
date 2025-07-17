(() => {
    $(function () {
        let workdetail_table = $("#workdetails").DataTable();

        Livewire.on("workdetailAdded", ({ workdetail }) => {
            // console.log(workdetail.name);
            let action_edit = `<a class="btn btn-sm btn-primary"
                        href="${APP_URL}/service-provider/work-details/${workdetail.id}/edit">
                        <i class="fa fa-pencil"></i>
                    </a>`;
            let action_delete = `<a class="btn btn-sm delete-workdetail btn-danger"
                            data-workdetail="${workdetail.id}"
                            id="workdetail-${workdetail.id}" href="javascript:void(0)">
                            <i class="fa fa-trash"></i>
                        </a>`;
            let file_extension = workdetail.file.split(".").pop().toLowerCase();
            let file_html = "";
            if (file_extension === "jpg" || file_extension === "jpeg" || file_extension === "png" || file_extension === "gif") {
                file_html = `<img class="" src="${APP_URL}/uploads/service-provider/workDetails/${workdetail.file}" width="80">`;
            } else if (file_extension === "pdf") {
                file_html = `<a href="${APP_URL}/uploads/service-provider/workDetails/${workdetail.file}" target="blank"><img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png" alt="" /></a>`;
            }
            let added_row = workdetail_table.row
                .add([
                    workdetail.title,
                    workdetail.start_date,
                    workdetail.end_date,
                    file_html,
                    action_edit + " " + action_delete,
                ])
                .node();

            added_row.id = "workdetail-record-" + workdetail.id;
            added_row.cells[4].classList.add("text-center");
            workdetail_table.draw();
            $("html, body").animate({ scrollTop: 0 }, 200);
        });

        $(document).on("click", ".delete-workdetail", function (e) {
            e.preventDefault();
            __this = $(this);
            let workdetail_id = $(this).data("workdetail");
            Swal.fire({
                title: "Are You Sure?",
                text: "Are you want to delete this details?",
                icon: "warning",
                showCancelButton: true,
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url:
                            APP_URL +
                            "/service-provider/my-work-details/" +
                            workdetail_id,
                        data: {
                            workdetail_id,
                        },
                        dataType: "JSON",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function (response) {
                            console.log(response);
                            if (response.status == "deleted")
                                Swal.fire("Done!", response.message, "success"),
                                    workdetail_table
                                        .rows(
                                            "#workdetail-record-" +
                                                workdetail_id
                                        )
                                        .remove()
                                        .draw();
                            else console.error(response.message);
                        },
                        error: function (response) {
                            Swal.fire(
                                "Error!",
                                "Something went wrong.",
                                "error"
                            );
                        },
                    });
                }
            });
        });
    });
})();
