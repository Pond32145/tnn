<?php
$chekeStartPage = true;
include 'header.php';
include 'connectdb.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @import url('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');

        /* ลดระยะห่างด้านบนทั้งหมด */
        :root {
            --bs-gutter-x: 0;
            --bs-gutter-y: 0;
        }

        .box_border {
            overflow: hidden;
            /* ป้องกันการล้นของเนื้อหาภายในกล่อง */
            height: 100%;
            /* หรือจะใช้ max-height: 100%; ก็ได้ */
        }

        .card {
            overflow: hidden;
            /* ป้องกันการล้นของเนื้อหาภายในการ์ด */
            height: 100%;
            /* หรือจะใช้ max-height: 100%; ก็ได้ */
        }
    </style>
</head>

<body>

    <section class="experimental-results_main ">
        <div class="header-bg main"><img src="./assets/image/658a747e85fea47ec19cd381_Group%20970.png" loading="lazy" sizes="100vw" srcset="./assets/image/658a747e85fea47ec19cd381_Group%20970-p-500.png 500w,
    ./assets/image/658a747e85fea47ec19cd381_Group%20970-p-800.png 800w,
    ./assets/image/658a747e85fea47ec19cd381_Group%20970-p-1080.png 1080w,
    ./assets/image/658a747e85fea47ec19cd381_Group%20970.png 1920w" alt="" class="image_bg">
            <div class="box_ab_ex-re">
                <h2 class="h2_header_tn">ผลการทดลอง</h2>
            </div>
        </div>
        <div class="container bg">
            <div class="tabs_main">
                <div data-w-id="69c0aacf-e76a-8be2-4f07-6aa82b150c40" class="tabs_link">
                    <img src="./assets/image/658a747d9c1ad56db21137a4_Group%201089.png" loading="lazy" data-w-id="fc721ba3-0839-162f-5c97-89e34cae02a0" alt="" class="link_image_btn">
                    <p class="name_btn">Laboratory Testing</p>
                </div>
                <div data-w-id="1134097d-c108-cc78-261b-e138faf1b203" class="tabs_link">
                    <img src="./assets/image/658a771945b75ab5c8a0b1e2_Group%201090.png" loading="lazy" data-w-id="2ffb4478-5271-069f-39a1-4579cb9f6300" sizes="(max-width: 479px) 82vw, (max-width: 767px) 40vw, 41vw" alt="" srcset="./assets/image/658a771945b75ab5c8a0b1e2_Group%201090-p-500.png 500w,
                ./assets/image/658a771945b75ab5c8a0b1e2_Group%201090.png 685w" class="link_image_btn">
                    <p class="name_btn">Field Trail</p>
                </div>
            </div>
        </div>

        <div class="tabs_content tab_01">
            <div class="header-bg header_intabs"><img src="./assets/image/658a747e85fea47ec19cd381_Group%20970.png" loading="lazy" sizes="100vw" srcset="./assets/image/658a747e85fea47ec19cd381_Group%20970-p-500.png 500w,
        ./assets/image/658a747e85fea47ec19cd381_Group%20970-p-800.png 800w,
        ./assets/image/658a747e85fea47ec19cd381_Group%20970-p-1080.png 1080w,
        ./assets/image/658a747e85fea47ec19cd381_Group%20970.png 1920w" alt="" class="image_bg">
                <div class="box_ab_ex-re">
                    <div class="box_for_back">
                        <div class="back_box">
                            <div data-w-id="4f8c0a10-b052-6b71-d32a-dd11fa02b7d7" class="text-block"><strong class="symb">﹤</strong><span class="tb01 text-span-4">Back</span></div>
                        </div>
                        <h2 class="h2_header_tn for_tabs">Laboratory Testing</h2>
                    </div>
                </div>
            </div>

            <!-- //condb -->

            <div class="container contaoner_tab01">
                <div class="row">
                    <?php
                    include 'connectdb.php';

                    $sql = "SELECT product_name, description, usage_rate, pdf_name, pdf_path, image_path FROM lab";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="col-12 col-sm-6 mb-4">
                                <div class="box_border h-100">
                                    <div class="_50per image_tab01">
                                        <?php if ($row['image_path']) { ?>
                                            <img src="<?php echo $row['image_path']; ?>" loading="lazy" sizes="100vw" srcset="<?php echo $row['image_path']; ?> 500w,
                                             <?php echo $row['image_path']; ?> 800w,
                                             <?php echo $row['image_path']; ?> 1128w" alt="" class="image_product">
                                        <?php } ?>
                                    </div>
                                    <div class="_50per">
                                        <div class="box_text_lab">
                                            <h3 class="heading-2"><?php echo htmlspecialchars($row['product_name']); ?></h3>
                                            <p class="p_text">
                                                <?php echo "<b>คุณสมบัติ :</b> " . htmlspecialchars($row['description']) . "<br>"; ?>
                                                <?php echo "<b>อัตราการใช้ :</b> " . htmlspecialchars($row['usage_rate']) . "<br>"; ?>
                                                <?php if ($row['pdf_name']) { ?>
                                                    <a href="<?php echo $row['pdf_path']; ?>" target="_blank">ข้อมูลผลการทดลอง</a>
                                                <?php } ?>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>


                    <?php
                        }
                    } else {
                        echo "<p class='text-center'>ไม่พบสินค้า</p>";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>







        </div>
        <div class="tabs_content tab_02">
            <div class="header-bg header_intabs"><img src="./assets/image/658a747e85fea47ec19cd381_Group%20970.png" loading="lazy" sizes="100vw" srcset="./assets/image/658a747e85fea47ec19cd381_Group%20970-p-500.png 500w,
        ./assets/image/658a747e85fea47ec19cd381_Group%20970-p-800.png 800w,
        ./assets/image/658a747e85fea47ec19cd381_Group%20970-p-1080.png 1080w,
        ./assets/image/658a747e85fea47ec19cd381_Group%20970.png 1920w" alt="" class="image_bg">
                <div class="box_ab_ex-re">
                    <div class="box_for_back">
                        <div class="back_box">
                            <div data-w-id="7b99e933-6c0e-5680-0954-899b05375560" class="text-block"><strong class="symb">﹤</strong><span class="tb01 text-span-4">Back</span></div>
                        </div>
                        <h2 class="h2_header_tn for_tabs">Field Trail</h2>
                    </div>
                </div>
            </div>
            <div class="container contaoner_tab01">
                <div data-w-id="7b99e933-6c0e-5680-0954-899b05375568" class="box_border">
                    <div class="_50per image_tab01"><img src="./assets/image/658a747e3c540b89cb752167_Group%2012622x.png" loading="lazy" sizes="100vw" srcset="./assets/image/658a747e3c540b89cb752167_Group%2012622x-p-500.png 500w,
                ./assets/image/658a747e3c540b89cb752167_Group%2012622x-p-800.png 800w,
                ./assets/image/658a747e3c540b89cb752167_Group%2012622x.png 1128w" alt="" class="image_product"></div>
                    <div class="_50per">
                        <div class="box_text_lab">
                            <h3 class="heading-2">กลูโฟซิเนต-ตายเรียบ</h3>
                            <p class="p_text">คุณสมบัติ : ฆ่าหญ้าตายยาก ฟื้นฟูดิน<br>อัตราการใช้ : ใช้กลูโฟซิเนต 250 มิลลิลิตร ต่อน้ำ 20 ลิตร<br>ใช้ซูปเปอร์ ตายเรียบ 5 กรัม</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</body>

</html>

<?php include 'footer.php'; ?>
