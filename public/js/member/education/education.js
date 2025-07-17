(() => {
    $(function () {
        let education_table = $("#education").DataTable();

        Livewire.on("educationAdded", ({ education }) => {
            // console.log(education.name);
            let action_edit = `<a class="btn btn-sm btn-primary"
                        href="${APP_URL}/service-provider/education-details/${education.id}/edit">
                        <i class="fa fa-pencil"></i>
                    </a>`;
            let action_delete = `<a class="btn btn-sm delete-education btn-danger"
                            data-education="${education.id}"
                            id="education-${education.id}" href="javascript:void(0)">
                            <i class="fa fa-trash"></i>
                        </a>`;

            let file_extension = education.file.split(".").pop().toLowerCase();
            let file_html = "";
            if (file_extension === "jpg" || file_extension === "jpeg" || file_extension === "png" || file_extension === "gif") {
                file_html = `<img class="" src="${APP_URL}/uploads/service-provider/education/${education.file}" width="80">`;
            } else if (file_extension === "pdf") {
                file_html = `<a href="${APP_URL}/uploads/service-provider/education/${education.file}" target="blank"><img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png" alt="" /></a>`;
            }
            let added_row = education_table.row
                .add([
                    education.title,
                    education.start_date,
                    education.end_date,
                    file_html,
                    action_edit + " " + action_delete,
                ])
                .node();

            added_row.id = "education-record-" + education.id;
            added_row.cells[4].classList.add("text-center");
            education_table.draw();
            $("html, body").animate({ scrollTop: 0 }, 200);
        });

        $(document).on("click", ".delete-education", function (e) {
            e.preventDefault();
            __this = $(this);
            let education_id = $(this).data("education");
            Swal.fire({
                title: "Are You Sure?",
                text: "Are you want to delete this education details?",
                icon: "warning",
                showCancelButton: true,
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url:
                            APP_URL +
                            "/service-provider/my-education-details/" +
                            education_id,
                        data: {
                            education_id,
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
                                    education_table
                                        .rows(
                                            "#education-record-" + education_id
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
