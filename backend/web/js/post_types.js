$(document).on('click', '.btn-create-update-post-type', function(){
    let url = $(this).data('url');
    console.log(url);
    $.ajax({
        url: url,
        type: 'get',
        success: function (response, error){
            $("#post-type-form-container").html(response);
            $("#modalCreateUpdatePostType").modal('show');
        }
    })
})

$(document).on('beforeSubmit', '#formPostType', function (event){
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
               toastr.success('Post type has been added', 'Success');
               $("#modalCreateUpdatePostType").modal('hide');
               form[0].reset();
               $.pjax.reload({container: "#pjax-post-type", timeout: 30 * 1000})
           }
       }
   });

   return false;
});