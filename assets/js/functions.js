// placeholder for future js code

$(document).on('change', "#provincia", function () {
    const prov_id = $('#provincia').val();
    console.log(prov_id);
    $.ajax({
        type: "POST",
        url: "getLocalidades",
        data: "prov_id=" + prov_id,
        success: html => {
            $("#opciones_localidades").html($(html).find("#localidad"));
        }
    });
});
