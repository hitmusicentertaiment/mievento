$(document).on('click', '.btn-create-update-city', function(){
    let url = $(this).data('url');
    console.log(url);
    $.ajax({
        url: url,
        type: 'get',
        success: function (response, error){
            $("#city-form-container").html(response);
            $("#modalCreateUpdateCity").modal('show');
        }
    })
})

$(document).on('beforeSubmit', '#formCity', function (event){
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
               toastr.success('City has been added', 'Success');
               $("#modalCreateUpdateCity").modal('hide');
               form[0].reset();
               $.pjax.reload({container: "#pjax-cities", timeout: 30 * 1000})
           }
       }
   });

   return false;
});