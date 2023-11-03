-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 02, 2023 lúc 02:37 AM
-- Phiên bản máy phục vụ: 5.6.41-84.1
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nhathhmd_laravel_origin`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `provinces`
--

CREATE TABLE IF NOT EXISTS `provinces` (
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `administrative_unit_id` int(11) DEFAULT NULL,
  `administrative_region_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `provinces`
--

INSERT INTO `provinces` (`code`, `name`, `name_en`, `full_name`, `full_name_en`, `code_name`, `administrative_unit_id`, `administrative_region_id`) VALUES
('01', 'Hà Nội', 'Ha Noi', 'Thành phố Hà Nội', 'Ha Noi City', 'ha_noi', 1, 3),
('02', 'Hà Giang', 'Ha Giang', 'Tỉnh Hà Giang', 'Ha Giang Province', 'ha_giang', 2, 1),
('04', 'Cao Bằng', 'Cao Bang', 'Tỉnh Cao Bằng', 'Cao Bang Province', 'cao_bang', 2, 1),
('06', 'Bắc Kạn', 'Bac Kan', 'Tỉnh Bắc Kạn', 'Bac Kan Province', 'bac_kan', 2, 1),
('08', 'Tuyên Quang', 'Tuyen Quang', 'Tỉnh Tuyên Quang', 'Tuyen Quang Province', 'tuyen_quang', 2, 1),
('10', 'Lào Cai', 'Lao Cai', 'Tỉnh Lào Cai', 'Lao Cai Province', 'lao_cai', 2, 2),
('11', 'Điện Biên', 'Dien Bien', 'Tỉnh Điện Biên', 'Dien Bien Province', 'dien_bien', 2, 2),
('12', 'Lai Châu', 'Lai Chau', 'Tỉnh Lai Châu', 'Lai Chau Province', 'lai_chau', 2, 2),
('14', 'Sơn La', 'Son La', 'Tỉnh Sơn La', 'Son La Province', 'son_la', 2, 2),
('15', 'Yên Bái', 'Yen Bai', 'Tỉnh Yên Bái', 'Yen Bai Province', 'yen_bai', 2, 2),
('17', 'Hoà Bình', 'Hoa Binh', 'Tỉnh Hoà Bình', 'Hoa Binh Province', 'hoa_binh', 2, 2),
('19', 'Thái Nguyên', 'Thai Nguyen', 'Tỉnh Thái Nguyên', 'Thai Nguyen Province', 'thai_nguyen', 2, 1),
('20', 'Lạng Sơn', 'Lang Son', 'Tỉnh Lạng Sơn', 'Lang Son Province', 'lang_son', 2, 1),
('22', 'Quảng Ninh', 'Quang Ninh', 'Tỉnh Quảng Ninh', 'Quang Ninh Province', 'quang_ninh', 2, 1),
('24', 'Bắc Giang', 'Bac Giang', 'Tỉnh Bắc Giang', 'Bac Giang Province', 'bac_giang', 2, 1),
('25', 'Phú Thọ', 'Phu Tho', 'Tỉnh Phú Thọ', 'Phu Tho Province', 'phu_tho', 2, 1),
('26', 'Vĩnh Phúc', 'Vinh Phuc', 'Tỉnh Vĩnh Phúc', 'Vinh Phuc Province', 'vinh_phuc', 2, 3),
('27', 'Bắc Ninh', 'Bac Ninh', 'Tỉnh Bắc Ninh', 'Bac Ninh Province', 'bac_ninh', 2, 3),
('30', 'Hải Dương', 'Hai Duong', 'Tỉnh Hải Dương', 'Hai Duong Province', 'hai_duong', 2, 3),
('31', 'Hải Phòng', 'Hai Phong', 'Thành phố Hải Phòng', 'Hai Phong City', 'hai_phong', 1, 3),
('33', 'Hưng Yên', 'Hung Yen', 'Tỉnh Hưng Yên', 'Hung Yen Province', 'hung_yen', 2, 3),
('34', 'Thái Bình', 'Thai Binh', 'Tỉnh Thái Bình', 'Thai Binh Province', 'thai_binh', 2, 3),
('35', 'Hà Nam', 'Ha Nam', 'Tỉnh Hà Nam', 'Ha Nam Province', 'ha_nam', 2, 3),
('36', 'Nam Định', 'Nam Dinh', 'Tỉnh Nam Định', 'Nam Dinh Province', 'nam_dinh', 2, 3),
('37', 'Ninh Bình', 'Ninh Binh', 'Tỉnh Ninh Bình', 'Ninh Binh Province', 'ninh_binh', 2, 3),
('38', 'Thanh Hóa', 'Thanh Hoa', 'Tỉnh Thanh Hóa', 'Thanh Hoa Province', 'thanh_hoa', 2, 4),
('40', 'Nghệ An', 'Nghe An', 'Tỉnh Nghệ An', 'Nghe An Province', 'nghe_an', 2, 4),
('42', 'Hà Tĩnh', 'Ha Tinh', 'Tỉnh Hà Tĩnh', 'Ha Tinh Province', 'ha_tinh', 2, 4),
('44', 'Quảng Bình', 'Quang Binh', 'Tỉnh Quảng Bình', 'Quang Binh Province', 'quang_binh', 2, 4),
('45', 'Quảng Trị', 'Quang Tri', 'Tỉnh Quảng Trị', 'Quang Tri Province', 'quang_tri', 2, 4),
('46', 'Thừa Thiên Huế', 'Thua Thien Hue', 'Tỉnh Thừa Thiên Huế', 'Thua Thien Hue Province', 'thua_thien_hue', 2, 4),
('48', 'Đà Nẵng', 'Da Nang', 'Thành phố Đà Nẵng', 'Da Nang City', 'da_nang', 1, 5),
('49', 'Quảng Nam', 'Quang Nam', 'Tỉnh Quảng Nam', 'Quang Nam Province', 'quang_nam', 2, 5),
('51', 'Quảng Ngãi', 'Quang Ngai', 'Tỉnh Quảng Ngãi', 'Quang Ngai Province', 'quang_ngai', 2, 5),
('52', 'Bình Định', 'Binh Dinh', 'Tỉnh Bình Định', 'Binh Dinh Province', 'binh_dinh', 2, 5),
('54', 'Phú Yên', 'Phu Yen', 'Tỉnh Phú Yên', 'Phu Yen Province', 'phu_yen', 2, 5),
('56', 'Khánh Hòa', 'Khanh Hoa', 'Tỉnh Khánh Hòa', 'Khanh Hoa Province', 'khanh_hoa', 2, 5),
('58', 'Ninh Thuận', 'Ninh Thuan', 'Tỉnh Ninh Thuận', 'Ninh Thuan Province', 'ninh_thuan', 2, 5),
('60', 'Bình Thuận', 'Binh Thuan', 'Tỉnh Bình Thuận', 'Binh Thuan Province', 'binh_thuan', 2, 5),
('62', 'Kon Tum', 'Kon Tum', 'Tỉnh Kon Tum', 'Kon Tum Province', 'kon_tum', 2, 6),
('64', 'Gia Lai', 'Gia Lai', 'Tỉnh Gia Lai', 'Gia Lai Province', 'gia_lai', 2, 6),
('66', 'Đắk Lắk', 'Dak Lak', 'Tỉnh Đắk Lắk', 'Dak Lak Province', 'dak_lak', 2, 6),
('67', 'Đắk Nông', 'Dak Nong', 'Tỉnh Đắk Nông', 'Dak Nong Province', 'dak_nong', 2, 6),
('68', 'Lâm Đồng', 'Lam Dong', 'Tỉnh Lâm Đồng', 'Lam Dong Province', 'lam_dong', 2, 6),
('70', 'Bình Phước', 'Binh Phuoc', 'Tỉnh Bình Phước', 'Binh Phuoc Province', 'binh_phuoc', 2, 7),
('72', 'Tây Ninh', 'Tay Ninh', 'Tỉnh Tây Ninh', 'Tay Ninh Province', 'tay_ninh', 2, 7),
('74', 'Bình Dương', 'Binh Duong', 'Tỉnh Bình Dương', 'Binh Duong Province', 'binh_duong', 2, 7),
('75', 'Đồng Nai', 'Dong Nai', 'Tỉnh Đồng Nai', 'Dong Nai Province', 'dong_nai', 2, 7),
('77', 'Bà Rịa - Vũng Tàu', 'Ba Ria - Vung Tau', 'Tỉnh Bà Rịa - Vũng Tàu', 'Ba Ria - Vung Tau Province', 'ba_ria_vung_tau', 2, 7),
('79', 'Hồ Chí Minh', 'Ho Chi Minh', 'Thành phố Hồ Chí Minh', 'Ho Chi Minh City', 'ho_chi_minh', 1, 7),
('80', 'Long An', 'Long An', 'Tỉnh Long An', 'Long An Province', 'long_an', 2, 8),
('82', 'Tiền Giang', 'Tien Giang', 'Tỉnh Tiền Giang', 'Tien Giang Province', 'tien_giang', 2, 8),
('83', 'Bến Tre', 'Ben Tre', 'Tỉnh Bến Tre', 'Ben Tre Province', 'ben_tre', 2, 8),
('84', 'Trà Vinh', 'Tra Vinh', 'Tỉnh Trà Vinh', 'Tra Vinh Province', 'tra_vinh', 2, 8),
('86', 'Vĩnh Long', 'Vinh Long', 'Tỉnh Vĩnh Long', 'Vinh Long Province', 'vinh_long', 2, 8),
('87', 'Đồng Tháp', 'Dong Thap', 'Tỉnh Đồng Tháp', 'Dong Thap Province', 'dong_thap', 2, 8),
('89', 'An Giang', 'An Giang', 'Tỉnh An Giang', 'An Giang Province', 'an_giang', 2, 8),
('91', 'Kiên Giang', 'Kien Giang', 'Tỉnh Kiên Giang', 'Kien Giang Province', 'kien_giang', 2, 8),
('92', 'Cần Thơ', 'Can Tho', 'Thành phố Cần Thơ', 'Can Tho City', 'can_tho', 1, 8),
('93', 'Hậu Giang', 'Hau Giang', 'Tỉnh Hậu Giang', 'Hau Giang Province', 'hau_giang', 2, 8),
('94', 'Sóc Trăng', 'Soc Trang', 'Tỉnh Sóc Trăng', 'Soc Trang Province', 'soc_trang', 2, 8),
('95', 'Bạc Liêu', 'Bac Lieu', 'Tỉnh Bạc Liêu', 'Bac Lieu Province', 'bac_lieu', 2, 8),
('96', 'Cà Mau', 'Ca Mau', 'Tỉnh Cà Mau', 'Ca Mau Province', 'ca_mau', 2, 8);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`code`),
  ADD KEY `idx_provinces_region` (`administrative_region_id`),
  ADD KEY `idx_provinces_unit` (`administrative_unit_id`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `provinces`
--
ALTER TABLE `provinces`
  ADD CONSTRAINT `provinces_administrative_region_id_fkey` FOREIGN KEY (`administrative_region_id`) REFERENCES `administrative_regions` (`id`),
  ADD CONSTRAINT `provinces_administrative_unit_id_fkey` FOREIGN KEY (`administrative_unit_id`) REFERENCES `administrative_units` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
