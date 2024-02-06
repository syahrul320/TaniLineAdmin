var table;
$(document).ready(function () {
    // $("#card-form").hide();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // $("#add").click(function () {
    //     document.getElementById("form").reset();
    //     $("#id").val("");
    //     $("#submit").attr("disabled", false);
    //     $("#card-form").show(1000);
    // });
    // $("#close-form").click(function () {
    //     $("#card-form").hide(1000);
    //     document.getElementById("form").reset();
    //     $("#id").val("");
    //     $("#submit").html("Simpan");
    // });

    $("#form").submit(function (e) {
        e.preventDefault();
        $("#submit").html("Tunggu...");
        $("#submit").attr("disabled", true);
        text = "Update";
        action = "Update";
        urlSubmit = url + "/useradmin-update-data";
        var formData = new FormData($("#form")[0]);
        $.ajax({
            method: "POST",
            url: urlSubmit,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#submit").attr("disabled", false);
                $("#nameError").html("");
                $("#emailError").html("");
                $("#number_telephoneError").html("");
                $("#passwordError").html("");
                $("#alamatError").html("");
                if (data.errors) {
                    $("#submit").html(action);
                    if (data.errors.name) {
                        $("#nameError").html(data.errors.name[0]);
                    }
                    if (data.errors.email) {
                        $("#emailError").html(data.errors.email[0]);
                    }
                    if (data.errors.number_telephone) {
                        $("#number_telephoneError").html(data.errors.number_telephone[0]);
                    }
                    if (data.errors.password) {
                        $("#passwordError").html(data.errors.password[0]);
                    }
                    if (data.errors.alamat) {
                        $("#alamatError").html(data.errors.alamat[0]);
                    }
                }

                if (data.success) {
                    table.draw();
                    document.getElementById("form").reset();
                    $("#id").val("");
                    swal("Success " + text + " Data", {
                        icon: "success",
                    });
                    $("#card-form").hide();
                    $("#submit").html("Simpan");
                }
            },
            error: function (data) {
                console.log(data);
            },
        });
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
                url: url + "/useradmin-delete-data",
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

function edit(id) {
    $("#submit").attr("disabled", false);
    $.ajax({
        url: url + "/useradmin-edit-data",
        data: { id: id },
        method: "POST",
        success: function (data) {
            $("#id").val(data.data.id);
            $("#name").val(data.data.name);
            $("#email").val(data.data.email);
            $("#number_telephone").val(data.data.number_telephone);
            $("#alamat").val(data.data.alamat);
            $("#submit").html("Update");
            $("#card-form").show(1000);
        },
        error: function (data) {
            console.log("Error:", data);
        },
    });
}
