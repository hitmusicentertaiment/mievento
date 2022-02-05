$(document).on('click', '.btn-create-update-location', function(){
    let url = $(this).data('url');
    console.log(url);
    $.ajax({
        url: url,
        type: 'get',
        success: function (response, error){
            $("#location-form-container").html(response);
            $("#modalCreateUpdateLocation").modal('show');
        }
    })
})

$(document).on('beforeSubmit', '#formLocation', function (event){
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
               toastr.success('Location has been added', 'Success');
               $("#modalCreateUpdateLocation").modal('hide');
               form[0].reset();
               $.pjax.reload({container: "#pjax-locations", timeout: 30 * 1000})
           }
       }
   });

   return false;
});