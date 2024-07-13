<?php 
$chekeStartPage = false; 
include 'header.php'; 

include "connectdb.php";
?>

<?php include 'product-data.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['product_name'];
        $group = $row['group_id'];
        $group_name = $row['group_name'];
        $common_name = $row['common_name'];
        $substance_characteristics = $row['substance_characteristics'];
        $packing_size = $row['packing_size'];
        $usage_rate = $row['usage_rate'];
        $feature = $row['feature'];
        $benefit = $row['benefit'];
        $image = $row['image'];
    } else {
        echo 'ไม่พบข้อมูลในฐานข้อมูล';
        header("location: ./index.html");
        exit;
    }
} else {
    echo 'ไม่พบการร้องขอข้อมูล';
    header("location: ./index.html");
    exit;
}
?>

<section data-w-id="a8865e07-afdf-e6a3-a9ce-1eb9c01c52fd" style="opacity: 0;" class="product-detail">
    <div class="container container_product_details">
        <div class="show_image_product">
            <div class="box_border_p">
                <div class="_w-100"><img src="<?= $image ?>" loading="lazy" alt="<?= $product_name ?>"></div>
                <div class="_w-100 bg-blu">
                    <div data-w-id="a3577948-9d2a-5907-bdd1-2751c3129dc5" style="opacity: 0;" class="box_txt_name">
                        <h3 class="h3_name_product"><?= $product_name ?></h3>
                        <div class="detail_more">
                            <p class="btn_more_details">รายละเอียดเพิ่มเติม <strong>＞</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="show_detail">
            <p class="p-h">Product</p>
            <div class="highlights">
                <p class="h-hightlight">จุดเด่น</p>
                <div class="hightlights_txt">
                    <div class="hl_row">
                        <div class="hl_left">
                            <p class="text_left">กลุ่ม <?php echo $group ?></p>
                            <p class="text_left">:</p>
                        </div>
                        <div class="hl_right">
                            <p class="text_left"><?php echo $group_name ?></p>
                        </div>
                    </div>
                    <div class="hl_row">
                        <div class="hl_left">
                            <p class="text_left">ชื่อสามัญ</p>
                            <p class="text_left">:</p>
                        </div>
                        <div class="hl_right">
                            <p class="text_left"><?php echo $common_name ?></p>
                        </div>
                    </div>
                    <div class="hl_row">
                        <div class="hl_left">
                            <p class="text_left">ลักษณะสาร</p>
                            <p class="text_left">:</p>
                        </div>
                        <div class="hl_right">
                            <p class="text_left"><?php echo $substance_characteristics ?></p>
                        </div>
                    </div>
                    <div class="hl_row">
                        <div class="hl_left">
                            <p class="text_left">ขนาดบรรจุ</p>
                            <p class="text_left">:</p>
                        </div>
                        <div class="hl_right">
                            <p class="text_left"><?php echo $packing_size ?></p>
                        </div>
                    </div>
                    <div class="hl_row">
                        <div class="hl_left">
                            <p class="text_left">อัตราการใช้</p>
                            <p class="text_left">:</p>
                        </div>
                        <div class="hl_right">
                            <p class="text_left"><?php echo $usage_rate ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="highlights">
                <p class="h-hightlight">คุณสมบัติ</p>
                <div class="box_bg_text">
                    <p class="p_text_hl"><?php echo $feature ?></p>
                </div>
            </div>
            <div class="highlights">
                <p class="h-hightlight">ประโยชน์</p>
                <div class="box_bg_text">
                    <p class="p_text_hl"><?php echo $benefit ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
