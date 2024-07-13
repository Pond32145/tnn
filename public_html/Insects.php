
<?php 
$chekeStartPage = true; 
include 'header.php'; 
?>
<?php include 'product-data.php'; ?>
<?php 
    $name_product = $product_insects['name_product'];
    $part_product_items = $product_insects['part_file'];
    $product_items = $product_insects['product_item'];
    $image_product = $product_insects['image_product'];
    $count = $product_insects['count_item'];
?>
    <section class="sec_insects_header"><img src="<?php echo $part_product_items . $image_product ?>" loading="lazy" sizes="100vw" alt="" class="insects_bg">
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
            <div class="box_grid_product">
               <?php for ($y=1;$y <= $count;$y++) { ?>
                <a href="./productDetail.php?item=<?php echo $product_items . $y ?>&category=insects" id="w-node-fa7b6bf6-1bff-0acd-a31e-5e455d4fb77d-79303951" class="grid_item_product">
                    <img src="<?php echo $part_product_items . $product_items . $y .".png" ?>" loading="lazy" alt="" class="image_item">
                </a>
                <?php } ?>
            </div>
            <div class="box_more">
                <div data-w-id="063b9fe2-8290-1da1-530a-82f0ab3eb3ad" class="txt_more">ดูเพิ่มเติม ＞</div>
            </div>
        </div>
    </section>
<?php include 'footer.php'; ?>