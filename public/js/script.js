
let initSelect2 = async function () {
    let initSelect = $("#init-select2");
    if (initSelect.length != 0) {
        await $.ajax({
            type: "get",
            url: "/admin/installation/selectJquery?search=3",
            dataType: "json",
            success: function (response) {
                let option = "<option selected disabled hidden>Select one</option>";
                for (let i = 0; i < response.length; i++) {
                    option += `<option value="${response[i]['id']}">${response[i]['name']} 
                    <span >: ${response[i]['phone']} </span></option>`;
                }
                $(initSelect).html(option)
            }
        });
        $(initSelect).select2();
    }
}

$(document).ready(function () {
    initSelect2()
});