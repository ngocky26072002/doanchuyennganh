<?php
session_start();
include('../../admincp/config/config.php');

//them so luong
if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array('tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'],
                'soluong' => $cart_item['soluong'], 'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']);
            $_SESSION['cart'] = $product;
        } else {
            $tangsoluong = $cart_item['soluong'] + 1;

            $product[] = array('tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'],
                'soluong' => $tangsoluong, 'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']);
            $_SESSION['cart'] = $product;
            header('Location:../../index.php?quanli=giohang');
        }

    }

}

//giam so luong
// if (isset($_GET['tru'])) {
//     $id = $_GET['tru'];
//     //duyet gio hang
//     foreach ($_SESSION['cart'] as $cart_item) {
//         //nhung san pham khong trung id thi giu lai
//         if ($cart_item['id'] != $id) {
//             $product[] = array('tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'],
//                 'soluong' => $cart_item['soluong'], 'giasp' => $cart_item['giasp'],
//                 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']);
//             $_SESSION['cart'] = $product;
//         } else {
//             $giamsoluong = $cart_item['soluong'] - 1;

//             if($cart_item['soluong']>1){//neu so luong san pham > 1 thi giam
//                 $product[] = array('tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'],
//                 'soluong' => $giamsoluong, 'giasp' => $cart_item['giasp'],
//                 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']);
//             $_SESSION['cart'] = $product;
//             header('Location:../../index.php?quanli=giohang');
//             }
//             else{
//                 $product[] = array('tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'],
//                 'soluong' => $giamsoluong, 'giasp' => $cart_item['giasp'],
//                 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']);
//             $_SESSION['cart'] = $product;
//             header('Location:../../index.php?quanli=giohang');
//             }
            
//         }

//     }

// }
// Giảm số lượng
if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    // Duyệt giỏ hàng
    foreach ($_SESSION['cart'] as $key => $cart_item) {
        // Những sản phẩm không trùng id thì giữ lại
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $cart_item['soluong'],
                'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'],
                'masp' => $cart_item['masp']
            );
        } else {
            $giamsoluong = $cart_item['soluong'] - 1;

            if ($giamsoluong > 0) { // Nếu số lượng sản phẩm > 1 thì giảm
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'],
                    'id' => $cart_item['id'],
                    'soluong' => $giamsoluong,
                    'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'],
                    'masp' => $cart_item['masp']
                );
            }
        }
    }

    // Cập nhật giỏ hàng trong session
    $_SESSION['cart'] = $product;

    // Chuyển hướng đến trang giỏ hàng
    header('Location:../../index.php?quanli=giohang');
}


//xoa san pham
if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array('tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'],
                'soluong' => $cart_item['soluong'], 'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']);
        }
        $_SESSION['cart'] = $product;

        header('Location:../../index.php?quanli=giohang');
    }
}
//xoa tat ca
if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
    unset($_SESSION['cart']);
    header('Location:../../index.php?quanli=giohang');
}

//them san pham vao gio hang
if (isset($_POST['themgiohang'])) {
    //phas session cu
    //session_destroy();

    $id = $_GET['idsanpham'];
    $soluong = 1;
    $sql = "SELECT * FROM sanpham WHERE id_sanpham='" . $id . "' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);

    $row = mysqli_fetch_array($query);

    if ($row) {
        $new_product = array(array('tensanpham' => $row['tensanpham'], 'id' => $id, 'soluong' => $soluong,
            'giasp' => $row['giasp'], 'hinhanh' => $row['hinhanh'], 'masp' => $row['masp']));
        //kiem tra session  gio hang ton tai
        if (isset($_SESSION['cart'])) {
            $found = false;
            foreach ($_SESSION['cart'] as $cart_item) {
                if ($cart_item['id'] == $id) {
                    //neu du lieu trung 
                    $product[] = array('tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'],
                        'soluong' => $soluong + 1, 'giasp' => $cart_item['giasp'],
                        'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']);
                    $found = true;
                } else {
                    //neu du lieu khong trung
                    $product[] = array('tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'],
                        'soluong' => $soluong, 'giasp' => $cart_item['giasp'],
                        'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']);
                }
            }
            if ($found == false) {
                //lien ket du lieu new_product voi product
                $_SESSION['cart'] = array_merge($product, $new_product);
            } else {
                $_SESSION['cart'] = $product;
            }

        } else {
            $_SESSION['cart'] = $new_product;
        }
    }
    header('Location:../../index.php?quanli=giohang');

}
?>