$(document).on('click', '.btn-create-update-service', function () {
    let url = $(this).data('url');
    console.log(url);
    $.ajax({
        url: url,
        type: 'get',
        success: function (response, error) {
            $("#service-form-container").html(response);
            $("#modalCreateUpdateService").modal('show');
        }
    })
})

$(document).on('beforeSubmit', '#formService', function (event) {
    event.preventDefault();
    let form = $(this);
    let url = form.attr('action');
    let data = form.serializeArray();
    let method = form.attr('method');
    $.ajax({
        type: method,
        url: url,
        data: data,
        success: function (response, error) {
            if (response.success) {
                toastr.success('Service has been added', 'Success');
                $("#modalCreateUpdateService").modal('hide');
                form[0].reset();
                $.pjax.reload({container: "#pjax-service", timeout: 30 * 1000})
            }
        }
    });

    return false;
});