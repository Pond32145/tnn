-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 01:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tnn`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `common_name` varchar(255) NOT NULL,
  `substance_characteristics` text NOT NULL,
  `packing_size` varchar(255) NOT NULL,
  `usage_rate` varchar(255) NOT NULL,
  `feature` text NOT NULL,
  `benefit` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `group_id` varchar(255) NOT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `group_name`, `common_name`, `substance_characteristics`, `packing_size`, `usage_rate`, `feature`, `benefit`, `image`, `group_id`, `type_id`) VALUES
(26, 'อีทีฟอน 52', 'สารควบคุมการเจริญเติบโตของพืช', 'อีทีฟอน 52% W/V SL', 'ของเหลวน้ำใส', ' 1000 มิลลิลิตร', '- บูมดอกสับปะรด หยอดยอดสับปะรด ใช้ในอัตรา 4-6 มิลลิลิตร ต่อน้า 20 ลิตร ครั้งที่ 1 สับปะรด อายุ 9-12 เดือน ครั้งที่ 2 หลังจากครั้งแรก 7 วัน ใช้น้าอัตรา 600 ลิตร ต่อไร่', 'สารควบคุมการเจริญเติบโตของพืช มีคุณสมบัติควบคุมการสุกแก่ของพืช มีฤทธิ์แทรกซึมและเคลื่อนย้ายผ่านท่ออาหารไปยังส่วนเจริญของพืชได้ มีสมบัติเป็นกรดอ่อน ดังนั้นไม่ควรผสมน้าทิ้งไว้นานเกิน 24 ชั่วโมง และห้ามผสมกับน้ำที่มีความเป็นด่างจัด', '- ช่วยกระตุ้นการออกดอกในสับปะรด ให้ออกดอกพร้อมกันเพื่อสะดวกต่อการเก็บเกี่ยว - เร่งการสุกของผลไม้ เช่น ทุเรียน มะม่วง กล้วย\r\n- ใช้เร่งการสุกในการเก็บเกี่ยวผลมะเขือเทศรอบสุดท้าย', './uploads/hormone1.png', '33', 1),
(27, 'บีทีเท็กซ์', ' สารควบคุมการเจริญเติบโตของพืช', ' อีทีฟอน 52% W/V SL', ' ของเหลวน้ำใส', ' 1000 มิลลิลิตร', ' - บูมดอกสับปะรด หยอดยอดสับปะรด ใช้ในอัตรา 4-6 มิลลิลิตร ต่อน้า 20 ลิตร ครั้งที่ 1 สับปะรด อายุ 9-12 เดือน ครั้งที่ 2 หลังจากครั้งแรก 7 วัน ใช้น้าอัตรา 600 ลิตร ต่อไร่', 'สารควบคุมการเจริญเติบโตของพืช มีคุณสมบัติควบคุมการสุกแก่ของพืช มีฤทธิ์แทรกซึมและเคลื่อนย้ายผ่านท่ออาหารไปยังส่วนเจริญของพืชได้ มีสมบัติเป็นกรดอ่อน ดังนั้นไม่ควรผสมน้าทิ้งไว้นานเกิน 24 ชั่วโมง และห้ามผสมกับน้ำที่มีความเป็นด่างจัด', '- ช่วยกระตุ้นการออกดอกในสับปะรด ให้ออกดอกพร้อมกันเพื่อสะดวกต่อการเก็บเกี่ยว - เร่งการสุกของผลไม้ เช่น ทุเรียน มะม่วง กล้วย\r\n- ใช้เร่งการสุกในการเก็บเกี่ยวผลมะเขือเทศรอบสุดท้าย', './uploads/hormone2.png', '33', 1),
(28, 'แพคโคลบิวทราซอล', 'สารควบคุมการเจริญเติบโตของพืช', 'แพกโคลบิวทราซอล 15% WP', ' ผงละเอียดสีขาว', ' 1000 กรัม', 'ใช้อัตรา 6.5 กรัมต่อเส้นผ่านศูนย์กลางทรงพุ่ม 1 เมตรผสมน้ำ 5 ลิตร ราดบริเวณโคนต้นโดยห่างจาก โคนต้น 30 เซนติเมตรในระยะใบพวงหรือใบเพสลาด', 'สารชะลอการเจริญเติบโตของพืชที่นิยมใช้กับมะม่วงและพืชไร่ และเป็นสารกาจัดเชื้อรากลุ่ม triazole ออกฤทธิ์ในทางตรงข้ามกับจิบเบอเรลลิน โดยยับยั้งการสังเคราะห์จิบเบอเรลลิน ลดการยืดตัวของปล้อง เพิ่มการเจริญเติบโตของราก เร่งให้เกิดดอก ทำให้ออกลูกเร็วและเพิ่มการผลิตเมล็ดในพืช', 'ใช้ในการจัดสวนเพื่อลดการเจริญเติบโตของยอด ใช้ได้ผลดีกับไม้พุ่มและไม้ต้น ช่วยเพิ่มความทนทานต่อความเครียดจากความแล้ง เกิดใบไม้สีเขียวเข้ม มีความต้านทานต่อเชื้อราและแบคทีเรียเพิ่มขึ้นและเพิ่มการพัฒนาของราก การเจริญของแคมเบียมเช่นเดียวกับการยับยั้งการเจริญของยอดในไม้ต้นบางชนิด', './uploads/hormone3.png', '3', 1),
(32, 'คาร์เบนดาซิม 50 เอสซี', 'สารป้องกันกำจัดโรคพืช', 'คาร์เบนดาซิม 50% W/V EC', 'เนื้อครีมสีขาว', '1000 มิลลิลิตร', ' 20-30 มิลลิลิตร ต่อน้ำ 20 ลิตร', 'เป็นสารกลุ่ม benzimidazoles มีคุณสมบัติเป็นสารดูดซึมและเคลื่อนย้าย ในต้นพืชมีฤทธิ์ครอบคลุมเชื้อโรคกว้างขวาง ยับยั้งการสร้างและพัฒนาเส้นใยของเชื้อรา กลไกออกฤทธิ์ย ับยั้งการแบ่งเซลล์แบบไม่อาศัยเพศ โดยขัดขวางเอนไซม์แอพเพรสซอเรียมที่ช่วยพัฒนาเส้นใยของเชื้อรา ทาให้สายโครโมโซม ที่แยกออกจากกันในขั้นตอนการแบ่งเซลล์แบบไม่อาศัยเพศไม่สามารถกลับมารวมกลุ่มที่บริเวณเบตา-ทูบูลินได้ และอาจยับยั้งการสังเคราะห์ วิตามิน บี12 ของเชื้อราบางชนิด', 'ใช้ป้องกันกาจัดโรคพืช เช่น โรคแอนแทรคโนส, โรคใบจุดตากบ, โรคใบจุดสีม่วง, โรคต้นไหม้แห้งหน่อไม้ฝรั่ง, โรคใบจุดหน่อไม้ฝรั่ง, โรคราแป้ง, โรคราสนิม, โรคราสนิมขาว, โรคราเขม่า, โรคใบไหม้, โรคสแคป, โรคเมลาโนส, โรคใบจุดตานกในสตรอว์เบอร์รี่ เป็นต้น', './uploads/plantDisease1.png', '1', 2),
(34, 'คาร์วีติน เอสซี', 'สารป้องกันกำจัดโรคพืช', ' คาร์เบนดาซิม 50% W/V EC', ' เนื้อครีมสีขาว', ' 1000 มิลลิลิตร', '20-30 มิลลิลิตร ต่อน้ำ 20 ลิตร', 'เป็นสารกลุ่ม benzimidazoles มีคุณสมบัติเป็นสารดูดซึมและเคลื่อนย้าย ในต้นพืชมีฤทธิ์ครอบคลุมเชื้อโรคกว้างขวาง ยับยั้งการสร้างและพัฒนาเส้นใยของเชื้อรา กลไกออกฤทธิ์ย ับยั้งการแบ่งเซลล์แบบไม่อาศัยเพศ โดยขัดขวางเอนไซม์แอพเพรสซอเรียมที่ช่วยพัฒนาเส้นใยของเชื้อรา ทาให้สายโครโมโซม ที่แยกออกจากกันในขั้นตอนการแบ่งเซลล์แบบไม่อาศัยเพศไม่สามารถกลับมารวมกลุ่มที่บริเวณเบตา-ทูบูลินได้ และอาจยับยั้งการสังเคราะห์ วิตามิน บี12 ของเชื้อราบางชนิด', 'ใช้ป้องกันกาจัดโรคพืช เช่น โรคแอนแทรคโนส, โรคใบจุดตากบ, โรคใบจุดสีม่วง, โรคต้นไหม้แห้งหน่อไม้ฝรั่ง, โรคใบจุดหน่อไม้ฝรั่ง, โรคราแป้ง, โรคราสนิม, โรคราสนิมขาว, โรคราเขม่า, โรคใบไหม้, โรคสแคป, โรคเมลาโนส, โรคใบจุดตานกในสตรอว์เบอร์รี่ เป็นต้น', './uploads/plantDisease2.png', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`) VALUES
(1, 'ฮอร์โมน'),
(2, 'โรคพืช'),
(3, 'แมลง'),
(4, 'วัชพืช'),
(5, 'สารเสริม');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `created_at`, `first_name`, `last_name`, `birthdate`, `position`) VALUES
(2, 'admin', '$2y$10$CPATqlEe2JzysL60kCRCieeOjez2QPDBlc7qBJzg2IFfW2e7bzVse', '2024-07-14 17:28:58', 'admin', 'admin', '2024-07-09', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_type` (`type_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_type` FOREIGN KEY (`type_id`) REFERENCES `product_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
