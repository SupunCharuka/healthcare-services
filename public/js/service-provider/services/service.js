(() => {
    $(function () {
        let service_table = $("#service").DataTable();
        // console.log(user.name);
        Livewire.on(
            "serviceAdded",
            ({ service, categoryName, subcategoryName, districtName, cityName }) => {
                let action_edit = `<a class="btn btn-sm btn-primary"
                        href="${APP_URL}/service-provider/service/${service.id}/edit">
                        <i class="fa fa-pencil"></i>
                    </a>`;
                let action_delete = `<a class="btn btn-sm delete-service btn-danger"
                            data-service="${service.id}"
                            id="service-${service.id}" href="javascript:void(0)">
                            <i class="fa fa-trash"></i>
                        </a>`;
                let added_row = service_table.row
                    .add([
                        service.id,
                        service.title,
                        categoryName,
                        subcategoryName,
                        districtName,
                        cityName,
                        service.number,
                        service.description,
                        `<img class="" src="${APP_URL}/uploads/service-provider/service/${service.image}" width="35">`,
                        action_edit + " " + action_delete,
                    ])
                    .node();

                added_row.id = "service-record-" + service.id;
                added_row.cells[9].classList.add("text-center");
                service_table.draw();
                $("html, body").animate({ scrollTop: 0 }, 200);
            }
        );

        $(document).on("click", ".delete-service", function (e) {
            e.preventDefault();
            __this = $(this);
            let service_id = $(this).data("service");
            Swal.fire({
                title: "Are You Sure?",
                text: "Are you want to delete this service?",
                icon: "warning",
                showCancelButton: true,
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: APP_URL + "/service-provider/service/" + service_id,
                        data: {
                            service_id,
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
                                    service_table
                                        .rows("#service-record-" + service_id)
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
