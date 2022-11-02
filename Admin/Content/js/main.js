const { default: Swal } = require("sweetalert2");

function readURL(input) {
    if (input.files && input.files[0]) {
        console.log(input.files[0]);
        var reader = new FileReader();
            
        reader.onload = function (e) {
            // $('#showImage').attr('src', e.target.result).width(150).height(200);
            document.getElementById('showImage').setAttribute('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
