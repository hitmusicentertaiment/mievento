$(document).on('click', '.btn-create-update-country', function(){
    let url = $(this).data('url');
    $.ajax({
        url: url,
        type: 'get',
        success: function (response, error){
            $("#country-form-container").html(response);
            $("#modalCreateUpdateCountry").modal('show');
        }
    })
})

$(document).on('beforeSubmit', '#formCountry', function (event){
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
               toastr.success('Country has been added', 'Success');
               $("#modalCreateUpdateCountry").modal('hide');
               form[0].reset();
               $.pjax.reload({container: "#pjax-countries", timeout: 30 * 1000})
           }
       }
   });

   return false;
});