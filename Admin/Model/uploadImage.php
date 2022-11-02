<?php
function uploadImage()
{
  // B1:có thư mục chứa hình:
  $target_dir = "../../Content/images/";

  // B2: lấy tên file lưu trên server để đưa vào thư mục uploadimage
  // uploadimage/juno.jpg
  $target_file = $target_dir.basename($_FILES["image"]["name"]);

  // B3: lấy phần mở rộng của hình ra và đổi về dạng chữ in hoa hoặc thường
  // JUNO.PNG
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // B4: kiểm tra khi người dùng nhấn nút submit thì hình có được upload lên server hay ko?
  // đặt cờ để đánh dấu có hình
  $uploadimage = 1;
  if (isset($_POST['submit'])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check != false) {
      $uploadimage = 1;
    } else {
      echo "Hình này ko có";
      $uploadimage = 0;
    }
  }
  // kiểm tra file này có tồn tại hay chưa
  if (file_exists($target_file)) {
    echo "File này đã tồn tài";
    $uploadimage = 0;
  }
  // kiểm tra kích thước hình vượt quá 500KB hay không?
  if ($_FILES["image"]["size"] > 500000) {
    echo "Hình vượt dung lượng";
    $uploadimage = 0;
  }
  // kiểm tra hình up lên có phìa là jpg, png, gif, jpeg
  if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
    echo " Hình ko đúng định dạng";
    $uploadimage = 0;
  }
  // B5: tiến hành upload
  if ($uploadimage == 0) {
    echo "Lỗi quá trình upload";
  } else { // $uploadimage=1 là ko có bất kỳ lỗi gì
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      echo $target_file;
      echo "TC";
    } else {
      echo "TB";
    }
  }
}
