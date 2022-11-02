<?php
    function addCart($product_id, $product_quantity, $product_size, $product_status) {
        $db = new Products();
        $product = $db->getDetailProducts($product_id);
        $product_name = $product['TenSanPham'];
        $product_tylesale = $product['LoaiGiamGia'];
        $product_salevalue = $product['GiaGiam'];
        if ($product_salevalue > 0) {
            switch ($product_tylesale) {
                case 0:
                    $product_finalprice = $product['GiaSanPham'] - $product['GiaSanPham']*($product_salevalue/100);
                    break;
                case 1:
                    $product_finalprice = $product['GiaSanPham'] - $product['GiaGiam'];
                    break;
                default:
                    $product_finalprice = $product['GiaSanPham'];
                    break;
                    
            }
        } else {
            $product_finalprice = $product['GiaSanPham'];
        }
        $product_price = $product['GiaSanPham'];
        $product_image = $product['Thumbnail'];
        $total = $product_finalprice * $product_quantity;
        $product_status = $product_status;
        if(isset($_SESSION['cart'][$product_id])) {
            $product_quantity += $_SESSION['cart'][$product_id]['product_quantity'];
            updateItem($product_id, $product_quantity);
            return; 
        } 
        $item = array(
            'product_id' => $product_id, 
            'product_name' => $product_name,
            'product_image' => $product_image, 
            'product_price' => $product_finalprice,
            'product_quantity' => $product_quantity,
            'product_size' => $product_size,
            'product_status' => $product_status,
            'total' => $total,
        );

        $_SESSION['cart'][$product_id] = $item;   
    }

    function getTotal($sale = 0, $pttt = 0, $voucher_type = null) {
        $subtotal=0;
        foreach($_SESSION['cart'] as $item)
        {
            $subtotal+=$item['total'];
        }
        if($voucher_type == 'phantram') {
            $subtotal= $subtotal - ($sale/100)*$subtotal - $pttt*$subtotal;
        } else {
            $subtotal= $subtotal - $sale - $pttt*$subtotal;
        }
        return $subtotal;
    }

    function getFinalPrice($sale, $pttt) {
        $subtotal=0;
        foreach($_SESSION['cart'] as $item)
        {
            $subtotal+=$item['total'];
        }
        $subtotal= $sale*$subtotal + $pttt*$subtotal;
        return $subtotal;
    }

    function updateItem($product_id,$quantity) {
        if($quantity<=0) {
            unset($_SESSION['cart'][$product_id]);
        }
        else{
            // cập nhật lại là chỉ thực hiện phép gán lại
            $_SESSION['cart'][$product_id]['product_quantity']=$quantity;//$_SESSION['cart'][21]['qty']=4
            // phải tính lại tổng tiền
            $totalnew=$_SESSION['cart'][$product_id]['product_quantity']*$_SESSION['cart'][$product_id]['product_price'];
            $_SESSION['cart'][$product_id]['total']= $totalnew;
        }
        
    }
