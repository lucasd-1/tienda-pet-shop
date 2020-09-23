// placeholder for future js code

$(document).on('change', "#provincia", function () {
    const prov_id = $('#provincia').val();
    $.ajax({
        type: "POST",
        url: "getLocalidades",
        data: "prov_id=" + prov_id,
        success: html => {
            $("#opciones_localidades").html($(html).find("#localidad"));
        }
    });
});

$(document).on('click', '.edit-image',  event => {
    const imgNumber = $(event.target).text().match(/\d+/)[0]
    const parent = $(event.target).parent();
    parent.find('a.delete-image').attr('style', 'display: none;')
    $(event.target).attr('style', 'display: none;');
    $(event.target).prev('img').attr('src', '');
    const input = $(event.target).next('input')
    input.attr('style', 'display: block');
    imgNumber === '1' && input.attr('required', true);
});
$(document).on('click', '.delete-image',  event => {
    const parent = $(event.target).parent();
    const name = `delete-${$(event.target).next('input').attr('name')}`
    parent.find('a.edit-image').attr('style', 'display: none;')
    $(event.target).attr('style', 'display: none;');
    parent.find('img').attr('src', '');
    parent.append(`<input type="hidden" name='${name}' value="true" />`);
    const input = $(event.target).next('input')
    input.attr('style', 'display: block');
    input.value = "";
});

$(document).on('click', '#enviar-email', event => {
    $(event.target).button('loading');
})

