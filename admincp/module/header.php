<?php
if (isset($_GET['quaylai'])) {
    //unset($_SESSION['dangnhap']);

    header('Location:../index.php');
}
?>
<p><a href="index.php?quaylai">Quay lại trang chủ
            <!-- <?php if (isset($_SESSION['dangnhap'])) {
                echo $_SESSION['dangnhap'];
            } ?> -->
        </a></p>