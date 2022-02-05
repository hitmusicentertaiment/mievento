$(document).on('fileselect', "#businessprofile-images", function (event, numFiles, label) {
    if (numFiles > 0) {
        selectedPictures = true;
    }
});
$(document).on('fileselectnone', "#businessprofile-images", function (event) {
    let val = $(this).val();
    selectedPictures = (val !== undefined && val !== "");

});
$(document).on('filecleared', "#businessprofile-images", function (event) {
    selectedPictures = false;
});

$(document).on('beforeSubmit', "#business-profile-form", function(event){
    event.preventDefault();
    if(!selectedPictures){
        alert("You have to select one picture at least");
    }
    return selectedPictures;
});

$(document).on('change', 'input', function(event){
    $("#businessprofile-attributeschanged").val(1);
})

