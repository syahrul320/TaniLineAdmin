var table;
var id_kategori = "";
var id_user_merchant = "";
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    table = $("#dt_tbl").DataTable({
        processing: true,
        scrollY: "68vh",
        scrollX: true,
        serverSide: true,
        orderCellsTop: true,
        lengthMenu: [10, 50, 100, 1000],
        ajax: {
            url: url + "/produk/",
            data: function (d) {
                (d.id_kategori = $("#id_kategori option:selected").val()),
                    (d.id_user_merchant = $(
                        "#id_user_merchant option:selected"
                    ).val());
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
            { data: "nama_produk", name: "nama_produk" },
            { data: "nama_kategori", name: "nama_kategori" },
            { data: "nama_merchant", name: "nama_merchant" },
            { data: "harga", name: "harga" },
            { data: "image", name: "image" },
            {
                data: "actions",
                name: "actions",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
        ],
        columnDefs: [
            {
                targets: 4,
                render: $.fn.dataTable.render.number(",", ".", 0, ""),
            },
        ],
        initComplete: function () {
            this.api()
                .columns([1])
                .every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.className = "form-control";
                    $(input)
                        .appendTo($(column.footer()).empty())
                        .on("change", function () {
                            column
                                .search($(this).val(), false, false, true)
                                .draw();
                        });
                });
        },
    });

    //Kategori
    $("#id_kategori").select2({
        ajax: {
            url: url + "/produk-kategori-select",
            type: "post",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term, // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response,
                };
            },
            cache: true,
        },
    });

    $("#id_kategori").on("change", function () {
        id_kategori = $("#id_kategori").val();
        table.draw();
    });

    //Merchant
    $("#id_user_merchant").select2({
        ajax: {
            url: url + "/produk-merchant-select",
            type: "post",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term, // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response,
                };
            },
            cache: true,
        },
    });

    $("#id_user_merchant").on("change", function () {
        id_user_merchant = $("#id_user_merchant").val();
        table.draw();
    });
});

function destroy(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "DELETE",
                url: url + "/produk-delete-data",
                data: { id: id },
                method: "POST",
                success: function (data) {
                    table.draw();
                    swal("Success Delete Data", {
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        } else {
            swal("Your data is safe!");
        }
    });
}
