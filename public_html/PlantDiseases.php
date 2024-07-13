<?php 
$chekeStartPage = true; 
include 'header.php';  
include 'connectdb.php';

// ดึงข้อมูลจากฐานข้อมูลเฉพาะ type_id = 1
$sql = "SELECT * FROM product WHERE type_id = 2";
$result = $conn->query($sql);

// รวมไฟล์ข้อมูลสินค้า
include 'product-data.php'; 
$name_product = $product_plantDiseases['name_product'];
$part_product_items = $product_plantDiseases['part_file'];
$image_product = $product_plantDiseases['image_product'];
?>
<section class="sec_insects_header">
    <img src="<?php echo $part_product_items . $image_product ?>" loading="lazy" sizes="100vw" alt="" class="insects_bg">
    <div class="box_h1">
        <h1 class="heading-3"><?php echo $name_product ?></h1>
    </div>
    <div class="header_bottom">
        <p class="txt_prop">ผลิตภัณฑ์</p>
        <div class="prop"></div>
    </div>
</section>
<section class="show_product">
    <div class="container container_show_product">
        <div class="box_grid_product" style="text-align: center;">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <a href="./productDetail.php?id=<?= $row["id"] ?>" class="grid_item_product">
                    <img src="<?= $row['image'] ?>" loading="lazy" alt="<?= $row['product_name'] ?>" class="image_item">
                </a>
            <?php endwhile; ?>
        </div>
        <div class="box_more">
            <div class="txt_more">ดูเพิ่มเติม ＞</div>
        </div>
    </div>
</section>
<?php include 'footer.php'; ?>
