<div id="main">
    <?php
        include("sidebar/sidebar.php");
    ?>


    <div class="main_content">
        <?php
        if(isset($_GET['quanli'])){
            $tam=$_GET['quanli'];
        }else{
            $tam='';
        }
        //chuyen danh trang danh muc
        if($tam=='danhmucsanpham'){
            include('main/danhmuc.php');
        }
        //chuyen den trang gio hang
        elseif($tam== 'giohang'){
            include('main/giohang.php');
        }
        elseif($tam== 'tintuc'){
            include('main/tintuc.php');
        }
        elseif($tam== 'lienhe'){
            include('main/lienhe.php');
        }
        elseif($tam== 'sanpham'){
            include('main/sanpham.php');
        }
        elseif($tam== 'thanhtoan'){
            include('main/thanhtoan.php');
        }
        elseif($tam== 'dangnhap'){
            include('main/dangnhap.php');
        }
        elseif($tam== 'timkiem'){
            include('main/timkiem.php');
        }
        //chuyen den trang admin
        elseif($tam== 'admin'){
            include('admincp/login.php');
        }
        elseif($tam== 'dangky'){
            include('main/dangky.php');
        }
        else{
            include('main/index.php');
        }
        ?>
    </div>

    <div class="clear">

    </div>
</div>