<div class="container">
    <div class="row">

        <div class="col-md-8">

            <h1><a href="#" target="_blank"><img src="logo.png" width="80px" />Ajax File Uploading with Database MySql</a></h1>
            <hr>
            <input id="uploadImage" type="file" accept="image/*" name="image" class="uploadimg" />
            <input id="uploadImage1" type="file" accept="image/*" name="image1" class="uploadimg" />

            <div id="err"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.uploadimg').on('change', function() {
            console.log("test");
            var file_data = $(this).prop('files')[0];
            var form_data = new FormData();
            var ext = $(this).val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                alert("file không đúng định dạng");
                return;
            }
            var picsize = (file_data.size);
            console.log(picsize); /*in byte*/
            if (picsize > 2097152) /* 2mb*/ {
                alert("kích thước ảnh quá lớn")
                return;
            }
            form_data.append('file', file_data);
            $.ajax({
                url: '../View/ajax/upload.php',
                /*point to server-side PHP script */
                dataType: 'text',
                /* what to expect back from the PHP script, if anything*/
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(res) {
                    console.log(res);
                }
            });
        });
    })
</script>