$(document).on('click', '.btn-create-update-spcategory', function(){
    let url = $(this).data('url');

    $.ajax({
        url: url,
        type: 'get',
        success: function (response, error){
            $("#spcategory-form-container").html(response);
            $("#modalCreateUpdateSpCategory").modal('show');
        }
    })
})

$(document).on('beforeSubmit', '#formSpCategory', function (event){
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
               toastr.success('Speciality Category has been added', 'Success');
               $("#modalCreateUpdateSpCategory").modal('hide');
               form[0].reset();
               $.pjax.reload({container: "#pjax-spcategories", timeout: 30 * 1000})
           }
       }
   });

   return false;
});