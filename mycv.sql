-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 17, 2021 lúc 08:59 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mycv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `cont_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(10) UNSIGNED NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`cont_id`, `email`, `phone`, `city`, `district`, `address1`, `address2`, `cv_id`) VALUES
(1, 'thankkien@hotmail.com', 523022235, 'Hà Nội', 'Thanh Xuân', 'Số 9/420 Khương Đình', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `educations`
--

CREATE TABLE `educations` (
  `edu_id` int(10) UNSIGNED NOT NULL,
  `type_edu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spec` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `y_from` int(4) UNSIGNED NOT NULL,
  `y_to` int(4) UNSIGNED NOT NULL,
  `cv_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `educations`
--

INSERT INTO `educations` (`edu_id`, `type_edu`, `name`, `spec`, `y_from`, `y_to`, `cv_id`) VALUES
(1, 'university', 'Thuy Loi University - Đại học Thủy Lợi', 'Information technology', 2018, 2021, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `experiences`
--

CREATE TABLE `experiences` (
  `exp_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pos` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `y_from` int(4) UNSIGNED NOT NULL,
  `y_to` int(4) UNSIGNED NOT NULL,
  `cv_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `experiences`
--

INSERT INTO `experiences` (`exp_id`, `name`, `pos`, `y_from`, `y_to`, `cv_id`) VALUES
(1, 'Công ty A', 'Lập trình viên Web Front-end', 2019, 2019, 1),
(2, 'Công ty B', 'Lập trình viên Web Back-end', 2019, 2020, 1),
(3, 'Công ty C', 'Lập trình viên Web Full-stack', 2020, 2021, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `informations`
--

CREATE TABLE `informations` (
  `info_id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `informations`
--

INSERT INTO `informations` (`info_id`, `fullname`, `birthday`, `gender`, `about`, `cv_id`) VALUES
(1, 'Trần Thành Kiên', '2021-01-04', 'male', 'Tôi mong muốn tìm được một công việc với môi trường làm việc năng động, có cơ hội được phát triển kỹ năng của bản thân. Trở thành một lập trình viên xuất sắc', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `skills`
--

CREATE TABLE `skills` (
  `skill_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(3) UNSIGNED NOT NULL,
  `cv_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `skills`
--

INSERT INTO `skills` (`skill_id`, `name`, `score`, `cv_id`) VALUES
(1, 'Lập trình C#', 50, 1),
(2, 'Lập trình front-end HTML/CSS', 55, 1),
(3, 'Lập trình web front-end Bootstrap', 85, 1),
(4, 'Lập trình web back-end PHP', 75, 1),
(5, 'Lập trình web back-end JavaScript', 55, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_cv`
--

CREATE TABLE `table_cv` (
  `cv_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_cv`
--

INSERT INTO `table_cv` (`cv_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `sec_code` int(8) UNSIGNED NOT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-ava.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `status`, `created_at`, `sec_code`, `avatar`) VALUES
(1, 'thankkien', 'thankkien@hotmail.com', '$2y$10$BQfvNsz1PyqlyEjJIW2.7.NV0Wv7NgnwQk7N5N/v..hYHQYIkNyiq', 1, '2021-01-17', 18979045, '53506003e595682df.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`cont_id`),
  ADD UNIQUE KEY `cv_id` (`cv_id`);

--
-- Chỉ mục cho bảng `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`edu_id`),
  ADD KEY `cv_id` (`cv_id`);

--
-- Chỉ mục cho bảng `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`exp_id`),
  ADD KEY `cv_id` (`cv_id`);

--
-- Chỉ mục cho bảng `informations`
--
ALTER TABLE `informations`
  ADD PRIMARY KEY (`info_id`),
  ADD UNIQUE KEY `cv_id` (`cv_id`);

--
-- Chỉ mục cho bảng `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skill_id`),
  ADD KEY `cv_id` (`cv_id`);

--
-- Chỉ mục cho bảng `table_cv`
--
ALTER TABLE `table_cv`
  ADD PRIMARY KEY (`cv_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`,`username`,`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `cont_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `educations`
--
ALTER TABLE `educations`
  MODIFY `edu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `experiences`
--
ALTER TABLE `experiences`
  MODIFY `exp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `informations`
--
ALTER TABLE `informations`
  MODIFY `info_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `skills`
--
ALTER TABLE `skills`
  MODIFY `skill_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `table_cv`
--
ALTER TABLE `table_cv`
  MODIFY `cv_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `table_cv` (`cv_id`);

--
-- Các ràng buộc cho bảng `educations`
--
ALTER TABLE `educations`
  ADD CONSTRAINT `educations_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `table_cv` (`cv_id`);

--
-- Các ràng buộc cho bảng `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `table_cv` (`cv_id`);

--
-- Các ràng buộc cho bảng `informations`
--
ALTER TABLE `informations`
  ADD CONSTRAINT `informations_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `table_cv` (`cv_id`);

--
-- Các ràng buộc cho bảng `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `table_cv` (`cv_id`);

--
-- Các ràng buộc cho bảng `table_cv`
--
ALTER TABLE `table_cv`
  ADD CONSTRAINT `table_cv_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
