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

$(document).on('click', '#activar-pago-online', event => {
    const parent = $(event.target).closest($('#abonar-pedido'))
    // const selectorPago = parent.find(it => it.id === 'selector-pago');
    // const pagoOnline = parent.find(it => it.id === 'pago-online');

    const selectorPago = $(event.target).closest('div#selector-pago');
    const pagoOnline = parent.find('div#pago-online');

    console.log(parent);
    selectorPago.attr('style', 'display: none;');
    pagoOnline.attr('style', 'display: block;');

})

$(function () {
    $('#datetimepicker1').datetimepicker({
        format: 'DD/MM/YYYY',
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'bottom'
        }
    });
    $('#datetimepicker2').datetimepicker({
        format: 'DD/MM/YYYY',
        useCurrent: false,
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'bottom'
        }
    });
    $("#datetimepicker1").on("dp.change", function (e) {
        $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker2").on("dp.change", function (e) {
        $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
    });
});