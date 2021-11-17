let _token = $('meta[name="csrf-token"]').attr('content');
function modal_toggler(id) {
    let modalID = $(`#${id}`)
    if ($(modalID).hasClass("modal-open")) {
        $(modalID).removeClass("modal-open");
    } else {
        $(modalID).addClass("modal-open");
    }
}
let initValidate = function () {
    if ($(".init-validatation").length > 0) {
        $(".init-validatation").validate()
    }
}
let installerManagement = function () {
    // SHOW DETAL MEMBER
    $(document).on("click", "#btn-show", function () {
        let member = $(this).data("user");
        $(".table-show-member td#name").text(member.name)
        $(".table-show-member td#phone").text(member.phone)
        $(".table-show-member td#email").text(member.email)
        $(".table-show-member td#address").text(member.alamat)
        $(".table-show-member td#maps").text(member.location)
    })
    // TAMBAH INVENTORY
    if ($("#form-add-inventory").length > 0) {
        $(".form-select").select2();
        $("#form-add-inventory").validate()
        let stock = $("#form-add-inventory input[name=stock]")
        let curentvalue = ''
        $(document).on("change", ".form-select", function () {
            curentvalue = $(this).val()
            if (curentvalue != null) {
                curentvalue = curentvalue.split("|");
                $("#form-add-inventory input[name=stock]").attr("max", curentvalue[1].trim())
            }
        })
        $("#form-add-inventory").submit(function (e) {
            e.preventDefault();
            if ($("#form-add-inventory").valid()) {
                let tbody = $(".table-inventory tbody");
                let tr = `<tr>
                <th>
                ${tbody.find('tr').length + 1}
                <input type="text" hidden  readonly value="${curentvalue[0].trim()}" 
                name="inventory[${tbody.find('tr').length}][]">
                <input type="text" hidden  readonly value="${stock.val()}" 
                name="inventory[${tbody.find('tr').length}][]">
                <input hidden disabled value="${curentvalue[1]}"/>
                </th>
                <td> ${curentvalue[2].trim()}  </td>
                <td>  ${stock.val()}  </td>
                <td>
                <button id="btn-delete" type="button"
                class="my-btn-sm bg-red-500 hover:bg-red-600">
                <i class="fas fa-trash"></i>
                </button>
                </td>
                </tr>`
                tbody.append(tr);
                modal_toggler('add-modal')
                $('#form-add-inventory').trigger("reset");
                $(".form-select option").each(function (index) {
                    if ($(this).text().trim() == curentvalue[2].trim()) {
                        $(this).remove();
                    }
                });
                $('#form-add-inventory .form-select option').first().attr('selected', true).trigger('change');
            }
        });
    }
    // DELETE INVENTORY
    $(document).on("click", "#btn-delete", function () {
        $stock = $(this).parents("tr").find("input").last().val()
        $id = $(this).parents("tr").find("input").first().val()
        $text = $(this).parents("tr").find("td:nth-child(2)").text()
        $option = new Option($text.trim(), `${$id}|${$stock}|${$text}`, false, false);
        $(".form-select").append($option).change()
        $(this).parents("tr").remove()
    })
    // SUBMIT
    let installationForm = $(".form-installation")
    if (installationForm.length > 0) {
        installationForm.submit(function (e) {
            e.preventDefault();
            if (installationForm.valid()) {
                $("#loading-loader").removeClass("hidden");
                $.ajax({
                    type: "POST",
                    url: installationForm.attr("action"),
                    processData: false,
                    cache: false,
                    contentType: false,
                    data: new FormData(installationForm[0]),
                    success: function (response) {
                        if (response != "") {
                            $("#loading-loader").addClass("hidden");
                            $(".alert-error").removeClass("hidden");
                            $(".alert-error #error-message").text(response);
                        } else {
                            document.location = "/teknisi/installation";
                        }
                    }
                });
            }


        })
    }
}
let penagihanManagement = function () {
    let form_tagihan = $("#form-tagihan")
    let btn_tagihan = $("#btn-tagihan")
    btn_tagihan.click(function (e) {
        let pelanggan = $(this).data("user")
        let installation = $(this).data("installation")
        let paket = $(this).data("paket")
        form_tagihan.find("input[name=installation_id]").val(installation)
        form_tagihan.find("input[name=member_id]").val(pelanggan['id'])
        form_tagihan.find("input[name=member_id]").val(pelanggan['id'])
        form_tagihan.find("input#member-name").val(pelanggan['name'])
        form_tagihan.find("input#paket-name").val(paket['name'])
        form_tagihan.find("input#paket-price").val(paket['price'])
        form_tagihan.find("input#tagihan").val(paket['price'])
    });
}
$(document).ready(function () {
    penagihanManagement()
    initValidate()
    installerManagement()
    $('.table-datatable').DataTable({
        "order": [],
        "scrollX": true,
        "scrollCollapse": true,
    });
});
