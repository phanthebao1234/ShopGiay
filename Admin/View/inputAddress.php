<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card w-75 m-auto">
                    <div class="card-header text-center bg-primary text-white">
                        <h3>Country State City Dropdown List in PHP MySQL Ajax - Mywebtuts.com</h2>
                    </div>
                    <div class="card-body">
                        <form action="index.php?action=input&act=input_action" method="POST">
                            <div class="mb-2">
                                <label for="country"><strong>Tỉnh : </strong><span class="text-danger">*</span></label>
                                <select class="form-select" id="country-dropdown" name="tinh">
                                    <option value="">Chọn Tỉnh</option>
                                    <?php
                                        $provinces = new Address();
                                        $result = $provinces -> getListProvince();
                                        while($set = $result->fetch()):
                                        
                                    ?>
                                    <option value="<?php echo $set['code'];?>"><?php echo $set["name"];?></option>
                                    <?php
                                        endwhile;
                                    ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="state"><strong>Thành phố : </strong><span class="text-danger">*</span></label>
                                <select class="form-select" id="state-dropdown" name="thanhpho"></select>
                            </div>                        
                            <div class="mb-2">
                                <label for="city"><strong>Quận, Huyện, Xã : </strong><span class="text-danger">*</span></label>
                                <select class="form-select" id="city-dropdown" name="xa"></select>
                            </div>
                            <div class="mb-2">
                                <label for=""><strong>Địa chỉ nhà: </strong><span class="text-danger">*</span></label>
                                <input type="text" name="diachi" id="diachi">
                            </div>
                            <button type="submit" class="btn btn-primary">Nhập</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <script>
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
                var province_id = this.value;
                $.ajax({
                    url: "View/districts.php",
                    type: "POST",
                    data: {
                        province_id: province_id
                    },
                    cache: false,
                    success: function(result){
                        $("#state-dropdown").html(result);
                        $('#city-dropdown').html('<option value="">Select State First</option>'); 
                    }
                });
            });

            $('#state-dropdown').on('change', function() {
                var state_id = this.value;
                $.ajax({
                    url: "View/wards.php",
                    type: "POST",
                    data: {
                        state_id: state_id
                    },
                    cache: false,
                    success: function(result){
                        $("#city-dropdown").html(result);
                    }
                });
            });
        });
    </script>