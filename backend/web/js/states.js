$(document).on('click', '.btn-create-update-state', function(event){
    event.preventDefault();
    let url = $(this).data('url');
    console.log(url);
    $.ajax({
        url: url,
        type: 'get',
        success: function (response, error){
            $("#state-form-container").html(response);
            $("#modalCreateUpdateState").modal('show');
        }
    });

    return false;
})

$(document).on('beforeSubmit', '#formState', function (event){
    event.preventDefault();
    let form = $(this);
   let url = form.attr('action');
   let data = form.serializeArray();
   let method = form.attr('method');
   $.ajax({
       type: method,
       url: url,
       data: data,
       success: function (response, error){
           if(response.success){
               toastr.success('State has been added', 'Success');
               $("#modalCreateUpdateState").modal('hide');
               form[0].reset();
               $.pjax.reload({container: "#pjax-states", timeout: 30 * 1000})
           }
       }
   });

   return false;
});