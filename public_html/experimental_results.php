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
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            margin-right: auto;
            margin-left: auto;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 768px) {
            .container {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-sm-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .box_border {
            border: 1px solid #ddd;
            padding: 15px;
            background: #fff;
            height: 100%;
        }

        .image_tab01 {
            width: 50%;
            float: left;
        }

        .image_product {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .heading-2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .p_text {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .header-bg {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .image_bg {
            width: 100%;
            height: auto;
            display: block;
        }

        .box_ab_ex-re {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
        }

        .tabs_main {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .tabs_link {
            text-align: center;
            padding: 10px;
            cursor: pointer;
        }

        .link_image_btn {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .name_btn {
            font-size: 1rem;
            margin-top: 0.5rem;
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
                <div class="row "  style="margin-top: 70px; margin-bottom: 70px;">
                    <?php
                    include 'connectdb.php';

                    // Adjust the SQL query to include a WHERE clause for type_id
                    $sql = "SELECT product_name, description, usage_rate, pdf_name, pdf_path, image_path FROM lab WHERE type_id = 1";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="col-12 col-sm-6 mb-4" >
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
                <div class="row"  style="margin-top: 70px;margin-bottom: 70px;">
                    <?php
                    include 'connectdb.php';

                    // Adjust the SQL query to include a WHERE clause for type_id
                    $sql = "SELECT product_name, description, usage_rate, pdf_name, pdf_path, image_path FROM lab WHERE type_id = 2";
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

    </section>
</body>

</html>


<?php include 'footer.php'; ?>