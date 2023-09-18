-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 16, 2023 at 08:32 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learncosy`
--

-- --------------------------------------------------------

--
-- Table structure for table `bundle_courses`
--

CREATE TABLE `bundle_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `selected_course` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'one_time',
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bundle_courses`
--

INSERT INTO `bundle_courses` (`id`, `user_id`, `title`, `slug`, `selected_course`, `subscription_status`, `price`, `thumbnail`, `banner`, `short_description`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Maeketing bundle', 'maeketing-bundle-', '1,2', 'one_time', '76', 'maeketing-bundle-647f014ecfda6.jpeg', NULL, 'Investor marketing\r\n\r\nSales enablement\r\n\r\nProduct marketing career & education\r\n\r\nAdvanced B2B marketing\r\n\r\nProduct led growth\r\n\r\nAdvertising\r\n\r\nProduct marketing analytics\r\n\r\nSoft skills\r\n\r\nChief Marketing Officer skills\r\n\r\nLeadership & people management\r\n\r\nGrowth\r\n\r\nBranding\r\n\r\nProduct Marketing Management Training\r\nChief Marketing Officer Training\r\nOutbound Product Management Training\r\n\r\nAbout Your Instructor', 'published', '2023-06-06 03:50:06', '2023-06-06 03:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','processing','completed','decline','canceled','refunded','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `amount` int(11) DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `user_id`, `instructor_id`, `course_id`, `payment_method`, `payment_status`, `payment_id`, `status`, `amount`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 3, 'stripe', 'paid', '23456mnbgfd3ertyu', 'completed', 10, '2023-06-08 06:17:01', '2023-07-20 06:17:01', '2023-06-15 06:17:01', '2023-06-21 06:17:01'),
(4, 6, 1, 3, 'paypal', 'good', '345tgbg4r3efrvg', 'completed', 43, '2023-04-04 06:17:01', '2023-07-22 06:17:01', '2023-07-29 04:10:12', '2023-06-21 06:17:01'),
(9, 2, 1, 3, 'stripe', 'paid', '23456mnbgfd3ertyu', 'completed', 10, '2023-06-08 00:17:01', '2023-07-20 00:17:01', '2023-06-15 00:17:01', '2023-06-21 00:17:01'),
(10, 6, 1, 5, 'paypal', 'good', '345tgbg4r3efrvg', 'completed', 43, '2023-04-04 00:17:01', '2023-07-22 00:17:01', '2023-07-28 22:10:12', '2023-06-21 00:17:01'),
(12, 4, 1, 1, 'Stripe', 'paid', 'pi_3NhowGIPOd0zPaLL1t1A1pWa', 'completed', 18, '2023-08-21 19:23:49', '2023-09-21 19:23:49', '2023-08-21 19:23:49', '2023-08-21 19:23:49'),
(13, 78, 1, 1, 'Stripe', 'paid', 'pi_3NjH7rIPOd0zPaLL1mwGyQwF', 'completed', 21, '2023-08-26 01:41:47', '2023-09-26 01:41:47', '2023-08-26 01:41:48', '2023-08-26 01:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `auto_complete` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` text COLLATE utf8mb4_unicode_ci,
  `features` text COLLATE utf8mb4_unicode_ci,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `prerequisites` text COLLATE utf8mb4_unicode_ci,
  `outcome` text COLLATE utf8mb4_unicode_ci,
  `promo_video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categories` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'public/assets/images/courses/thumbnail.png',
  `banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'suggested-banner.png',
  `short_description` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_lesson` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hascertificate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `sample_certificates` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `subscription_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'one_time',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `certificate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_review` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `auto_complete`, `user_id`, `sub_title`, `features`, `slug`, `prerequisites`, `outcome`, `promo_video`, `price`, `offer_price`, `categories`, `thumbnail`, `banner`, `short_description`, `description`, `meta_keyword`, `meta_description`, `number_of_module`, `number_of_lesson`, `number_of_attachment`, `number_of_video`, `duration`, `hascertificate`, `sample_certificates`, `subscription_status`, `status`, `created_at`, `updated_at`, `certificate`, `allow_review`) VALUES
(1, 'This course Id is 1 ad quisquam volu', 'on', '1', NULL, NULL, 'this-course-id-is-1-ad-quisquam-volu', NULL, NULL, NULL, NULL, NULL, NULL, 'assets/images/courses/ut-quae-ut-et-ipsum.webp', 'suggested-banner.png', 'Has image', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-01 10:01:30', '2023-09-09 02:42:50', NULL, 1),
(2, 'Nam consequatur nes', 'on', '1', NULL, NULL, 'nesciunt-eaque-esse', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/nesciunt-eaque-esse.webp', 'suggested-banner.png', '<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<p>hostpink</p>\n</body>\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-02 00:41:18', '2023-09-02 00:41:33', NULL, 1),
(3, 'Incididunt est ut la', NULL, '1', NULL, NULL, 'cillum-excepturi-exp', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', 'Omnis aliquip repreh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-03 23:41:48', '2023-09-03 23:41:56', NULL, 1),
(4, 'Eum ut velit id min', 'on', '1', NULL, NULL, 'dolore-consequatur', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Fuga Autem deleniti</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-04 03:39:59', '2023-09-04 03:41:26', NULL, 1),
(5, 'Suscipit ut velit no', 'on', '1', NULL, NULL, 'autem-nobis-corporis', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', 'Cumque ut beatae fac', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-04 06:01:53', '2023-09-04 06:01:53', NULL, 1),
(6, 'Working on video upload', 'on', '1', NULL, NULL, 'working-on-video-upload', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/working-on-video-upload.webp', 'suggested-banner.png', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Working on video upload</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-05 23:46:28', '2023-09-05 23:46:51', NULL, 1),
(7, 'TITLE no 1 Sit suspicion provide', 'on', '1', NULL, NULL, 'title-no-1-sit-suscipit-provid', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/title-no-1-sit-suscipit-provid.webp', 'suggested-banner.png', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<h4 style=\"list-style-type: none;\">Description</h4>\r\n<div style=\"list-style-type: none;\">\r\n<p style=\"list-style-type: none;\">Content</p>\r\n</div>\r\n<div style=\"list-style-type: none;\">\r\n<p style=\"list-style-type: none;\">Institutions</p>\r\n</div>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-06 02:21:28', '2023-09-06 02:22:43', NULL, 1),
(8, 'Image upload and link test Ut quisquam et magni', 'on', '1', NULL, NULL, 'image-upload-and-link-test-ut-quisquam-et-magni', NULL, NULL, NULL, NULL, NULL, NULL, 'assets/images/courses/image-upload-and-link-test-ut-quisquam-et-magni.webp', 'suggested-banner.png', '<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<p>assets/images/courses</p>\n</body>\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-06 02:41:29', '2023-09-06 02:42:04', NULL, 1),
(9, 'Reprehenderit sint e', NULL, '1', NULL, NULL, 'cumque-ducimus-exce', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', 'In modi adipisicing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-06 02:49:03', '2023-09-06 02:49:03', NULL, 1),
(10, 'Sed quia doloremque', NULL, '1', NULL, NULL, 'atque-dolore-amet-q', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', 'Consequat Accusamus assets/js/tinymce.js', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-06 02:50:12', '2023-09-06 02:50:12', NULL, 1),
(11, 'In Dark mode Totam sit dolorem la', 'on', '1', NULL, NULL, 'in-dark-mode-totam-sit-dolorem-la', NULL, NULL, NULL, NULL, NULL, NULL, 'assets/images/courses/in-dark-mode-totam-sit-dolorem-la.webp', 'suggested-banner.png', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>In Dark mode Totam sit dolorem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit do<strong>lorem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit dol</strong>orem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit dolorem laIn Dark mode Totam sit dolorem la</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-06 07:37:49', '2023-09-06 07:38:28', NULL, 1),
(12, 'Step 7 Laboris eos sequi an', 'on', '1', NULL, NULL, 'step-7-laboris-eos-sequi-an', NULL, NULL, NULL, NULL, NULL, NULL, 'assets/images/courses/step-7-laboris-eos-sequi-an.webp', 'suggested-banner.png', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>\r\n<div>public function step2(){</div>\r\n<div>$lastCourseId = session()-&gt;get(\'lastCourseId\');</div>\r\n<div>if(!$lastCourseId){</div>\r\n<div>return redirect(\'instructor/courses\');</div>\r\n<div>}</div>\r\n<div>return view(\'e-learning/course/instructor/create/step-2\',[\'lastCourseId\' =&gt; $lastCourseId]);</div>\r\n<div>}</div>\r\n<br />\r\n<div>public function step2c(Request $request){</div>\r\n<div>$lastCourseId = session()-&gt;get(\'lastCourseId\');</div>\r\n<div>$course = Course::where(\'id\', $lastCourseId)-&gt;firstOrFail();</div>\r\n<div>$request-&gt;validate([</div>\r\n<div>\'thumbnail\' =&gt; \'nullable|file|mimes:jpeg,png,pdf|max:5121\', // Example mime types and maximum size</div>\r\n<div>\'description\' =&gt; \'required|string\',</div>\r\n<div>]);</div>\r\n<div>&nbsp;</div>\r\n<div>// Handle file upload</div>\r\n<div>// if ($request-&gt;hasFile(\'thumbnail\')) {</div>\r\n<div>// $file = $request-&gt;file(\'thumbnail\');</div>\r\n<div>// $filename = time() . \'_\' . $file-&gt;getClientOriginalName();</div>\r\n<div>// $file-&gt;move(public_path(\'uploads\'), $filename);</div>\r\n<div>// }</div>\r\n<br />\r\n<div>$image_path = \'assets/images/courses/thumbnail.png\';</div>\r\n<div>if ($request-&gt;hasFile(\'thumbnail\')) {</div>\r\n<div>$file = $request-&gt;file(\'thumbnail\');</div>\r\n<div>$filename = time() . \'_\' . $file-&gt;getClientOriginalName();</div>\r\n<div>&nbsp;</div>\r\n<div>// Convert image to WebP using Intervention Image</div>\r\n<div>$image = Image::make($file);</div>\r\n<div>$image-&gt;encode(\'webp\', 90); // Convert to WebP with 90% quality</div>\r\n<div>&nbsp;</div>\r\n<div>$image_path = \'assets/images/courses/\'.$course-&gt;slug . \'.webp\';</div>\r\n<br />\r\n<div>$image-&gt;save(public_path(\'assets/images/courses/\') . $course-&gt;slug . \'.webp\');</div>\r\n<div>}</div>\r\n<br />\r\n<div>// Store other form data</div>\r\n<div>$description = $request-&gt;input(\'description\');</div>\r\n<div>$course-&gt;short_description = $description;</div>\r\n<div>$course-&gt;thumbnail = $image_path;</div>\r\n<div>$course-&gt;save();</div>\r\n<div>return redirect(\'instructor/courses/create/step-3\')-&gt;with(\'success\', \'Data has been saved successfully\');</div>\r\n<div>}\r\n<div>\r\n<div>public function step2(){</div>\r\n<div>$lastCourseId = session()-&gt;get(\'lastCourseId\');</div>\r\n<div>if(!$lastCourseId){</div>\r\n<div>return redirect(\'instructor/courses\');</div>\r\n<div>}</div>\r\n<div>return view(\'e-learning/course/instructor/create/step-2\',[\'lastCourseId\' =&gt; $lastCourseId]);</div>\r\n<div>}</div>\r\n<br />\r\n<div>public function step2c(Request $request){</div>\r\n<div>$lastCourseId = session()-&gt;get(\'lastCourseId\');</div>\r\n<div>$course = Course::where(\'id\', $lastCourseId)-&gt;firstOrFail();</div>\r\n<div>$request-&gt;validate([</div>\r\n<div>\'thumbnail\' =&gt; \'nullable|file|mimes:jpeg,png,pdf|max:5121\', // Example mime types and maximum size</div>\r\n<div>\'description\' =&gt; \'required|string\',</div>\r\n<div>]);</div>\r\n<div>&nbsp;</div>\r\n<div>// Handle file upload</div>\r\n<div>// if ($request-&gt;hasFile(\'thumbnail\')) {</div>\r\n<div>// $file = $request-&gt;file(\'thumbnail\');</div>\r\n<div>// $filename = time() . \'_\' . $file-&gt;getClientOriginalName();</div>\r\n<div>// $file-&gt;move(public_path(\'uploads\'), $filename);</div>\r\n<div>// }</div>\r\n<br />\r\n<div>$image_path = \'assets/images/courses/thumbnail.png\';</div>\r\n<div>if ($request-&gt;hasFile(\'thumbnail\')) {</div>\r\n<div>$file = $request-&gt;file(\'thumbnail\');</div>\r\n<div>$filename = time() . \'_\' . $file-&gt;getClientOriginalName();</div>\r\n<div>&nbsp;</div>\r\n<div>// Convert image to WebP using Intervention Image</div>\r\n<div>$image = Image::make($file);</div>\r\n<div>$image-&gt;encode(\'webp\', 90); // Convert to WebP with 90% quality</div>\r\n<div>&nbsp;</div>\r\n<div>$image_path = \'assets/images/courses/\'.$course-&gt;slug . \'.webp\';</div>\r\n<br />\r\n<div>$image-&gt;save(public_path(\'assets/images/courses/\') . $course-&gt;slug . \'.webp\');</div>\r\n<div>}</div>\r\n<br />\r\n<div>// Store other form data</div>\r\n<div>$description = $request-&gt;input(\'description\');</div>\r\n<div>$course-&gt;short_description = $description;</div>\r\n<div>$course-&gt;thumbnail = $image_path;</div>\r\n<div>$course-&gt;save();</div>\r\n<div>return redirect(\'instructor/courses/create/step-3\')-&gt;with(\'success\', \'Data has been saved successfully\');</div>\r\n<div>}\r\n<div>\r\n<div>public function step2(){</div>\r\n<div>$lastCourseId = session()-&gt;get(\'lastCourseId\');</div>\r\n<div>if(!$lastCourseId){</div>\r\n<div>return redirect(\'instructor/courses\');</div>\r\n<div>}</div>\r\n<div>return view(\'e-learning/course/instructor/create/step-2\',[\'lastCourseId\' =&gt; $lastCourseId]);</div>\r\n<div>}</div>\r\n<br />\r\n<div>public function step2c(Request $request){</div>\r\n<div>$lastCourseId = session()-&gt;get(\'lastCourseId\');</div>\r\n<div>$course = Course::where(\'id\', $lastCourseId)-&gt;firstOrFail();</div>\r\n<div>$request-&gt;validate([</div>\r\n<div>\'thumbnail\' =&gt; \'nullable|file|mimes:jpeg,png,pdf|max:5121\', // Example mime types and maximum size</div>\r\n<div>\'description\' =&gt; \'required|string\',</div>\r\n<div>]);</div>\r\n<div>&nbsp;</div>\r\n<div>// Handle file upload</div>\r\n<div>// if ($request-&gt;hasFile(\'thumbnail\')) {</div>\r\n<div>// $file = $request-&gt;file(\'thumbnail\');</div>\r\n<div>// $filename = time() . \'_\' . $file-&gt;getClientOriginalName();</div>\r\n<div>// $file-&gt;move(public_path(\'uploads\'), $filename);</div>\r\n<div>// }</div>\r\n<br />\r\n<div>$image_path = \'assets/images/courses/thumbnail.png\';</div>\r\n<div>if ($request-&gt;hasFile(\'thumbnail\')) {</div>\r\n<div>$file = $request-&gt;file(\'thumbnail\');</div>\r\n<div>$filename = time() . \'_\' . $file-&gt;getClientOriginalName();</div>\r\n<div>&nbsp;</div>\r\n<div>// Convert image to WebP using Intervention Image</div>\r\n<div>$image = Image::make($file);</div>\r\n<div>$image-&gt;encode(\'webp\', 90); // Convert to WebP with 90% quality</div>\r\n<div>&nbsp;</div>\r\n<div>$image_path = \'assets/images/courses/\'.$course-&gt;slug . \'.webp\';</div>\r\n<br />\r\n<div>$image-&gt;save(public_path(\'assets/images/courses/\') . $course-&gt;slug . \'.webp\');</div>\r\n<div>}</div>\r\n<br />\r\n<div>// Store other form data</div>\r\n<div>$description = $request-&gt;input(\'description\');</div>\r\n<div>$course-&gt;short_description = $description;</div>\r\n<div>$course-&gt;thumbnail = $image_path;</div>\r\n<div>$course-&gt;save();</div>\r\n<div>return redirect(\'instructor/courses/create/step-3\')-&gt;with(\'success\', \'Data has been saved successfully\');</div>\r\n<div>}\r\n<div>\r\n<div>public function step2(){</div>\r\n<div>$lastCourseId = session()-&gt;get(\'lastCourseId\');</div>\r\n<div>if(!$lastCourseId){</div>\r\n<div>return redirect(\'instructor/courses\');</div>\r\n<div>}</div>\r\n<div>return view(\'e-learning/course/instructor/create/step-2\',[\'lastCourseId\' =&gt; $lastCourseId]);</div>\r\n<div>}</div>\r\n<br />\r\n<div>public function step2c(Request $request){</div>\r\n<div>$lastCourseId = session()-&gt;get(\'lastCourseId\');</div>\r\n<div>$course = Course::where(\'id\', $lastCourseId)-&gt;firstOrFail();</div>\r\n<div>$request-&gt;validate([</div>\r\n<div>\'thumbnail\' =&gt; \'nullable|file|mimes:jpeg,png,pdf|max:5121\', // Example mime types and maximum size</div>\r\n<div>\'description\' =&gt; \'required|string\',</div>\r\n<div>]);</div>\r\n<div>&nbsp;</div>\r\n<div>// Handle file upload</div>\r\n<div>// if ($request-&gt;hasFile(\'thumbnail\')) {</div>\r\n<div>// $file = $request-&gt;file(\'thumbnail\');</div>\r\n<div>// $filename = time() . \'_\' . $file-&gt;getClientOriginalName();</div>\r\n<div>// $file-&gt;move(public_path(\'uploads\'), $filename);</div>\r\n<div>// }</div>\r\n<br />\r\n<div>$image_path = \'assets/images/courses/thumbnail.png\';</div>\r\n<div>if ($request-&gt;hasFile(\'thumbnail\')) {</div>\r\n<div>$file = $request-&gt;file(\'thumbnail\');</div>\r\n<div>$filename = time() . \'_\' . $file-&gt;getClientOriginalName();</div>\r\n<div>&nbsp;</div>\r\n<div>// Convert image to WebP using Intervention Image</div>\r\n<div>$image = Image::make($file);</div>\r\n<div>$image-&gt;encode(\'webp\', 90); // Convert to WebP with 90% quality</div>\r\n<div>&nbsp;</div>\r\n<div>$image_path = \'assets/images/courses/\'.$course-&gt;slug . \'.webp\';</div>\r\n<br />\r\n<div>$image-&gt;save(public_path(\'assets/images/courses/\') . $course-&gt;slug . \'.webp\');</div>\r\n<div>}</div>\r\n<br />\r\n<div>// Store other form data</div>\r\n<div>$description = $request-&gt;input(\'description\');</div>\r\n<div>$course-&gt;short_description = $description;</div>\r\n<div>$course-&gt;thumbnail = $image_path;</div>\r\n<div>$course-&gt;save();</div>\r\n<div>return redirect(\'instructor/courses/create/step-3\')-&gt;with(\'success\', \'Data has been saved successfully\');</div>\r\n<div>}</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-06 08:08:27', '2023-09-06 08:09:09', NULL, 1),
(13, 'Non ipsa consequunt', 'on', '1', NULL, NULL, 'aspernatur-qui-ad-vo', NULL, NULL, NULL, '33', '13', NULL, 'assets/images/courses/aspernatur-qui-ad-vo.webp', 'assets/images/courses/banner_aspernatur-qui-ad-vo.webp', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>instructor/cou rses/cr eate/step-1ins tructor/c ourses/cr eate/step-1ins tructor/c ourses/ create/step-1in structo r/cours es/create/step-1instr uctor/co urses/create/step-1inst ructor/c ourses/cr eate/step-1instructor/c ourses/cr eate/step-1&nbsp;</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'Draft', '2023-09-06 20:51:50', '2023-09-07 01:19:19', NULL, 1),
(14, 'Inventore irure cill', 'on', '1', NULL, NULL, 'cupidatat-adipisicin', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', 'Voluptatem Dolorum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-07 02:26:40', '2023-09-07 02:26:40', NULL, 1),
(15, '08-09 Obcaecati sit ut eni', 'on', '1', NULL, NULL, '08-09-obcaecati-sit-ut-eni', NULL, NULL, NULL, NULL, NULL, NULL, 'assets/images/courses/08-09-obcaecati-sit-ut-eni.webp', 'suggested-banner.png', 'Description  08-09 Obcaecati sit ut eni', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-08 00:07:31', '2023-09-08 00:08:05', NULL, 1),
(16, '09-09-01 Aliquid aut et ex ea', 'on', '1', NULL, NULL, '09-09-01-aliquid-aut-et-ex-ea', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', 'Magna atque ad paria', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-08 22:04:21', '2023-09-08 22:04:21', NULL, 1),
(17, 'Develop', 'on', '1', NULL, NULL, 'develop', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-09 02:00:45', '2023-09-09 02:00:45', NULL, 1),
(18, 'instru ctor/cour ses/crea te', 'on', '1', NULL, NULL, 'instru-ctorcour-sescrea-te', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-09 02:01:49', '2023-09-09 02:01:49', NULL, 1),
(19, '08-09 Obcaecati sit ut eni', 'on', '1', NULL, NULL, '08-09-obcaecati-sit-ut-eni-2', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', 'Description  08-09 Obcaecati sit ut eni', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-09 02:37:51', '2023-09-09 02:37:51', NULL, 1),
(20, 'This course Id is 20 ad quisquam volu', 'on', '1', NULL, NULL, 'this-course-id-is-20-ad-quisquam-volu-2', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', 'This course Id is 20 ad quisquam volu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-09 02:43:29', '2023-09-09 02:53:51', NULL, 1),
(21, 'step1c\')->name(\'course.store.step-1\');', 'on', '1', NULL, NULL, 'step1c-namecoursestorestep-1', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-09 03:04:54', '2023-09-09 03:04:54', NULL, 1),
(22, 'step1c\')->name', 'on', '1', NULL, NULL, 'step1c-name', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-09 03:05:10', '2023-09-09 03:05:10', NULL, 1),
(23, '24 created This course Id is 1 ad quisquam volu edited', 'on', '1', NULL, NULL, '24-created-this-course-id-is-1-ad-quisquam-volu-edited', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', 'Has image', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-09 03:15:18', '2023-09-09 03:51:31', NULL, 1),
(24, 'This 24 has been updated', 'on', '1', NULL, NULL, 'this-24-has-been-updated-2-2-2-2-2', NULL, NULL, NULL, NULL, NULL, NULL, 'assets/images/courses/thumbnail.png', 'suggested-banner.png', 'Hello course description of 24 short', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Hello course description of 24</p>\r\n<div>\r\n<div>description\r\n<div>\r\n<div>description\r\n<div>\r\n<div>description\r\n<div>\r\n<div>description\r\n<div>\r\n<div>description</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-09 03:53:06', '2023-09-09 04:35:46', NULL, 1),
(25, '25 updated', 'on', '1', NULL, NULL, '25-updated', NULL, NULL, NULL, NULL, NULL, NULL, 'public/assets/images/courses/thumbnail.png', 'suggested-banner.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-09 03:53:15', '2023-09-09 03:53:36', NULL, 1),
(26, 'Possimus nemo proid', 'on', '1', NULL, NULL, 'dolor-perferendis-en-2', NULL, NULL, NULL, NULL, NULL, NULL, 'assets/images/courses/dolor-perferendis-en-2.webp', 'suggested-banner.png', 'Dolor dolores labore', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div data-offset-key=\"b2sur-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"b2sur-0-0\"><span data-offset-key=\"b2sur-0-0\">আপনার যদি র PHP অথবা যে কোন PHP ফ্রেমওয়ার্কে নূন্যতম ১ বছর কাজের অভিজ্ঞতা থাকে তবে আমাদের টিমে জয়েন করতে পারেন। আমরা একটা আউটসোর্সিং এজেন্সি। আমাদের </span><span data-offset-key=\"b2sur-0-1\">ছোট টিম তাই, একটু প্রেসার নিয়ে, ভ্যারাইটিজ রকমের কাজ করতে হয়</span><span data-offset-key=\"b2sur-0-2\">। </span></div>\r\n</div>\r\n<div data-offset-key=\"8cma3-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"8cma3-0-0\"><span data-offset-key=\"8cma3-0-0\">&nbsp;</span></div>\r\n</div>\r\n<div data-offset-key=\"4v5us-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"4v5us-0-0\"><span data-offset-key=\"4v5us-0-0\">আমরা সাধারণত ওয়েব এপ্লিকেশন নিয়ে কাজ করে থাকি। যেমন </span></div>\r\n</div>\r\n<div data-offset-key=\"bt428-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"bt428-0-0\"><span data-offset-key=\"bt428-0-0\">- বিভিন্ন সিআরএম এপিএই ইন্টিগ্রেশন </span></div>\r\n</div>\r\n<div data-offset-key=\"f0a8a-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"f0a8a-0-0\"><span data-offset-key=\"f0a8a-0-0\">- সোশ্যাল সাইট এপিএই ইন্টিগ্রেশন </span></div>\r\n</div>\r\n<div data-offset-key=\"2s6di-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"2s6di-0-0\"><span data-offset-key=\"2s6di-0-0\">- পেমেন্টমেথড </span></div>\r\n</div>\r\n<div data-offset-key=\"fjhd4-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"fjhd4-0-0\"><span data-offset-key=\"fjhd4-0-0\">- ওয়ার্ডপ্রেস প্লাগিন </span></div>\r\n</div>\r\n<div data-offset-key=\"8jg1q-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"8jg1q-0-0\"><span data-offset-key=\"8jg1q-0-0\">- ড্র্যাগ ড্রপ ইমেইল টেমপ্লেট বিল্ডার </span></div>\r\n</div>\r\n<div data-offset-key=\"e5f71-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"e5f71-0-0\"><span data-offset-key=\"e5f71-0-0\">- বিভিন্ন এসইও/ মার্কেটিং টুলস </span></div>\r\n</div>\r\n<div data-offset-key=\"8tivl-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"8tivl-0-0\"><span data-offset-key=\"8tivl-0-0\">- মাঝে মাঝে পাইথন দিয়ে ডাটা স্ক্র্যাপিং </span></div>\r\n</div>\r\n<div data-offset-key=\"9qhjt-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"9qhjt-0-0\"><span data-offset-key=\"9qhjt-0-0\">আমরা সবসময় ওয়ার্ডপ্রেস এবং লারাভেল দিয়ে কাজ করার চেষ্টা করি। </span></div>\r\n</div>\r\n<div data-offset-key=\"5k2vo-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"5k2vo-0-0\"><span data-offset-key=\"5k2vo-0-0\">&nbsp;</span></div>\r\n</div>\r\n<div data-offset-key=\"2lrmf-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"2lrmf-0-0\"><span data-offset-key=\"2lrmf-0-0\">স্যালারি রেঞ্জ</span><span data-offset-key=\"2lrmf-0-1\"> :২০ থেকে ২৫ হাজার টাকা </span></div>\r\n</div>\r\n<div data-offset-key=\"3mnoa-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"3mnoa-0-0\"><span data-offset-key=\"3mnoa-0-0\">পদ সংখ্যা</span><span data-offset-key=\"3mnoa-0-1\"> : ১</span></div>\r\n</div>\r\n<div data-offset-key=\"6m036-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"6m036-0-0\"><span data-offset-key=\"6m036-0-0\">কর্ম দিবস</span><span data-offset-key=\"6m036-0-1\"> : শনি থেকে বৃহস্পতি</span></div>\r\n</div>\r\n<div data-offset-key=\"9sbrj-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"9sbrj-0-0\"><span data-offset-key=\"9sbrj-0-0\">সময়</span><span data-offset-key=\"9sbrj-0-1\"> : ৯টা থেকে ৬ টা (১:১৫ থেকে ২:৩০ লাঞ্চ ব্রেক)</span></div>\r\n</div>\r\n<div data-offset-key=\"4b9bb-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"4b9bb-0-0\"><span data-offset-key=\"4b9bb-0-0\">&nbsp;</span></div>\r\n</div>\r\n<div data-offset-key=\"788n1-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"788n1-0-0\"><span data-offset-key=\"788n1-0-0\">সুযোগ সুবিধা: </span></div>\r\n</div>\r\n<div data-offset-key=\"270p6-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"270p6-0-0\"><span data-offset-key=\"270p6-0-0\">- সিক লিভ </span></div>\r\n</div>\r\n<div data-offset-key=\"4ivds-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"4ivds-0-0\"><span data-offset-key=\"4ivds-0-0\">- ক্যাজুয়াল লিভ </span></div>\r\n</div>\r\n<div data-offset-key=\"ejcn9-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"ejcn9-0-0\"><span data-offset-key=\"ejcn9-0-0\">- সাধারণত মাসের শেষ দিন ব্যাংকে স্যালারি </span></div>\r\n</div>\r\n<div data-offset-key=\"b2iig-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"b2iig-0-0\"><span data-offset-key=\"b2iig-0-0\">- প্রজেক্ট এন্ড পারফরম্যান্স গিফট / বোনাস </span></div>\r\n</div>\r\n<div data-offset-key=\"ap5hn-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"ap5hn-0-0\"><span data-offset-key=\"ap5hn-0-0\">- শর্ট ট্যুর </span></div>\r\n</div>\r\n<div data-offset-key=\"f09er-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"f09er-0-0\"><span data-offset-key=\"f09er-0-0\">- ইয়ার্লি ট্যুর </span></div>\r\n</div>\r\n<div data-offset-key=\"43cls-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"43cls-0-0\"><span data-offset-key=\"43cls-0-0\">- ২টি ঈদ বোনাস (ডিপেন্ড ওন বিজনেস কন্ডিশন)</span></div>\r\n</div>\r\n<div data-offset-key=\"f76ta-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"f76ta-0-0\"><span data-offset-key=\"f76ta-0-0\">&nbsp;</span></div>\r\n</div>\r\n<div data-offset-key=\"f6t7k-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"f6t7k-0-0\"><span data-offset-key=\"f6t7k-0-0\">যোগ্যতা :</span></div>\r\n</div>\r\n<div data-offset-key=\"82m9t-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"82m9t-0-0\"><span data-offset-key=\"82m9t-0-0\">-- যে কোন পিএইচপি ফ্রেমওয়ার্কে ভালো জ্ঞান রাখা </span></div>\r\n</div>\r\n<div data-offset-key=\"3nff2-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"3nff2-0-0\"><span data-offset-key=\"3nff2-0-0\">-- গুড আন্ডাসটান্ডিং অফ ও.ও.পি </span></div>\r\n</div>\r\n<div data-offset-key=\"cp27k-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"cp27k-0-0\"><span data-offset-key=\"cp27k-0-0\">-- হিউমান রিডেবল কোড ও কমেন্ট লিখা </span></div>\r\n</div>\r\n<div data-offset-key=\"8qv72-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"8qv72-0-0\"><span data-offset-key=\"8qv72-0-0\">-- একাধিক টেবিলে জয়েন করে কুয়েরি লিখা </span></div>\r\n</div>\r\n<div data-offset-key=\"btb93-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"btb93-0-0\"><span data-offset-key=\"btb93-0-0\">-- সাইন্স ব্যাকগ্রাউন্ডে অনার্স পাশ </span></div>\r\n</div>\r\n<div data-offset-key=\"chqul-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"chqul-0-0\"><span data-offset-key=\"chqul-0-0\">&nbsp;</span></div>\r\n</div>\r\n<div data-offset-key=\"99sj9-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"99sj9-0-0\"><span data-offset-key=\"99sj9-0-0\">অতিরিক্ত যোগ্যতা: </span></div>\r\n</div>\r\n<div data-offset-key=\"67krg-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"67krg-0-0\"><span data-offset-key=\"67krg-0-0\">-- লারাভেল লাইভওয়ার এবং ফিলামেন্ট </span></div>\r\n</div>\r\n<div data-offset-key=\"e4qk6-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"e4qk6-0-0\"><span data-offset-key=\"e4qk6-0-0\">-- ফিজিমা টু এইচটিএমএল </span></div>\r\n</div>\r\n<div data-offset-key=\"aqpic-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"aqpic-0-0\"><span data-offset-key=\"aqpic-0-0\">-- যে কোন ইঞ্জিনারিং ব্যাকগ্রাউন্ড </span></div>\r\n</div>\r\n<div data-offset-key=\"dq5ed-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"dq5ed-0-0\"><span data-offset-key=\"dq5ed-0-0\">&nbsp;</span></div>\r\n</div>\r\n<div data-offset-key=\"70ke6-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"70ke6-0-0\"><span data-offset-key=\"70ke6-0-0\">ঠিকানা:</span><span data-offset-key=\"70ke6-0-1\"> জান ই সবা, হাউজিং, জামিলনগর, বগুড়া </span></div>\r\n</div>\r\n<div data-offset-key=\"8ql4s-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"8ql4s-0-0\"><span data-offset-key=\"8ql4s-0-0\">ওয়েবসাইট :</span> <span data-offset-key=\"8ql4s-1-0\"><a href=\"https://giopio.com\">https://giopio.com</a></span></div>\r\n</div>\r\n<div data-offset-key=\"2i3fh-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"2i3fh-0-0\"><span data-offset-key=\"2i3fh-0-0\">ইমেল :</span><span data-offset-key=\"2i3fh-0-1\"> giopioservice@gmail.com</span></div>\r\n</div>\r\n<div data-offset-key=\"crlp6-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"crlp6-0-0\"><span data-offset-key=\"crlp6-0-0\">ফোন : </span><span data-offset-key=\"crlp6-0-1\">01728247398</span></div>\r\n</div>\r\n<div data-offset-key=\"981u4-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"981u4-0-0\"><span data-offset-key=\"981u4-0-0\">&nbsp;</span></div>\r\n</div>\r\n<div data-offset-key=\"fp57h-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"fp57h-0-0\"><span data-offset-key=\"fp57h-0-0\">এপ্লাই করার নিয়ম : </span></div>\r\n</div>\r\n<div data-offset-key=\"1hsfm-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"1hsfm-0-0\"><span data-offset-key=\"1hsfm-0-0\">- ১৯শে সেপ্টেম্বর, ২০২৩ এর মধ্যে </span></div>\r\n</div>\r\n<div data-offset-key=\"dgpd4-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"dgpd4-0-0\"><span data-offset-key=\"dgpd4-0-0\">- নিজের নামে, ফাইল রিনেম করে </span></div>\r\n</div>\r\n<div data-offset-key=\"c6p-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"c6p-0-0\"><span data-offset-key=\"c6p-0-0\">- পিডিএফ ফরম্যাটে ইমেল করবেন </span></div>\r\n</div>\r\n<div data-offset-key=\"f98vi-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"f98vi-0-0\"><span data-offset-key=\"f98vi-0-0\">- সাবজেক্ট হবে \" PHP/Laravel Developer \"</span></div>\r\n</div>\r\n<div data-offset-key=\"bjann-0-0\" data-editor=\"dklip\" data-block=\"true\">\r\n<div data-offset-key=\"bjann-0-0\"><span data-offset-key=\"bjann-0-0\">সিভি পাঠাবেন এই এড্রেসে : giopioservice@gmail.com</span></div>\r\n</div>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '', 'one_time', 'draft', '2023-09-10 05:35:55', '2023-09-10 05:36:54', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_activities`
--

CREATE TABLE `course_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_completed` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_activities`
--

INSERT INTO `course_activities` (`id`, `course_id`, `module_id`, `lesson_id`, `user_id`, `is_completed`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 3, 4, 0, '2023-06-24 23:38:25', '2023-06-24 23:38:25'),
(2, 2, 1, 2, 4, 0, '2023-07-07 09:44:01', '2023-07-07 09:44:01'),
(3, 1, 3, 1, 78, 1, '2023-08-22 01:24:08', '2023-08-26 01:42:08'),
(4, 1, 17, 5, 4, 1, '2023-09-05 07:55:32', '2023-09-05 07:55:32'),
(5, 1, 17, 6, 4, 1, '2023-09-05 07:55:34', '2023-09-05 07:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `course_logs`
--

CREATE TABLE `course_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_logs`
--

INSERT INTO `course_logs` (`id`, `course_id`, `module_id`, `lesson_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 0, 5, '2023-06-24 23:37:28', '2023-06-24 23:37:28'),
(2, 3, 4, 3, 4, '2023-06-24 23:38:08', '2023-06-24 23:38:08'),
(3, 2, 1, 2, 4, '2023-07-07 09:28:03', '2023-07-07 09:28:03'),
(4, 0, 0, 0, 60, '2023-07-10 05:28:01', '2023-07-10 05:28:01'),
(5, 0, 0, 0, 69, '2023-07-11 10:11:18', '2023-07-11 10:11:18'),
(6, 1, 3, 1, 5, '2023-08-22 01:23:56', '2023-08-22 01:23:56'),
(7, 1, 3, 1, 78, '2023-08-26 01:41:54', '2023-08-26 01:41:54'),
(8, 1, 3, 1, 4, '2023-09-05 07:55:24', '2023-09-05 07:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `course_reviews`
--

CREATE TABLE `course_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `star` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_reviews`
--

INSERT INTO `course_reviews` (`id`, `course_id`, `user_id`, `comment`, `star`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 'Good but not good', 2, '2023-06-07 10:08:36', '2023-06-07 10:08:48'),
(2, 1, 4, 'hjbjgyggm', 5, '2023-06-08 02:24:31', '2023-07-10 16:45:11'),
(3, 1, 5, 'n', 2, '2023-07-07 09:27:53', '2023-07-07 09:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `course_user`
--

CREATE TABLE `course_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_user`
--

INSERT INTO `course_user` (`id`, `course_id`, `user_id`, `payment_method`, `amount`, `paid`, `start_at`, `end_at`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 'Stripe', '9.99', 1, NULL, NULL, '2023-06-08 03:31:55', '2023-06-08 03:31:55'),
(2, 1, 4, 'Stripe', '18.00', 1, '2023-06-08 08:42:26', '2023-07-08 08:42:26', '2023-06-08 08:42:26', '2023-06-08 08:42:26'),
(3, 3, 4, 'Stripe', '794.00', 1, NULL, NULL, '2023-06-24 23:38:07', '2023-06-24 23:38:07'),
(4, 1, 4, 'Stripe', '18.00', 1, '2023-08-22 01:23:49', '2023-09-22 01:23:49', '2023-08-22 01:23:49', '2023-08-22 01:23:49'),
(5, 1, 78, 'Stripe', '21.00', 1, '2023-08-26 01:41:47', '2023-09-26 01:41:47', '2023-08-26 01:41:48', '2023-08-26 01:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `profession` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` text COLLATE utf8mb4_unicode_ci,
  `join_date` date NOT NULL,
  `retire_date` date DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `user_id`, `profession`, `company_name`, `job_type`, `experience`, `join_date`, `retire_date`, `short_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Vero lorem quia comm', 'Stark Puckett LLC', 'Sequi atque esse ad', 'In quis deleniti fac', '1981-09-10', '2006-11-25', 'Reprehenderit labor', '2023-08-28 20:28:44', '2023-08-28 20:28:44'),
(2, 1, 'Eius laborum dolor e', 'Russell Moody Associates', 'Excepteur assumenda', 'Illum ea aut quidem', '1971-08-22', '2016-02-29', 'Et nihil animi amet', '2023-08-28 20:33:39', '2023-08-28 20:33:39'),
(3, 1, 'Quas do voluptatum o', 'Berry and Dickerson Inc', 'Non aute culpa velit', 'Est eum iusto in lab', '1800-09-14', '1900-09-15', 'Quod officia ab sit', '2023-08-28 20:36:38', '2023-08-28 20:36:38'),
(4, 1, 'itExp ? $editExp->profession: old(\'profession\') }}', 'Hudson Johnson Inc', 'Ullam consequat Min', 'Amet eiusmod occaec', '2000-09-30', '2005-12-28', 'Nobis veniam magna', '2023-08-28 21:04:42', '2023-08-28 21:24:34'),
(5, 1, 'Eius velit quia inci', 'Carpenter Booker Traders', 'Consequatur duis qu', 'Eum dolor enim aute', '1900-12-07', '1991-03-07', 'Et cillum eiusmod qu', '2023-08-28 21:26:19', '2023-08-28 21:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_module_settings`
--

CREATE TABLE `instructor_module_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lp_bg_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apple_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructor_module_settings`
--

INSERT INTO `instructor_module_settings` (`id`, `instructor_id`, `value`, `image`, `logo`, `lp_bg_image`, `apple_icon`, `app_logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"primary_color\":\"#d1d1d1\",\"secondary_color\":\"#ccb8b8\",\"lp_layout\":\"fullwidth\",\"meta_title\":\"Hello title\",\"meta_desc\":null}', '1128599898.jpg', '430716000.png', '586681253.jpeg', NULL, '1590873959.webp', NULL, '2023-06-21 09:03:00', '2023-09-06 03:03:38'),
(2, 7, '{\"banner_title\":null,\"button_text\":null,\"banner_text\":null,\"primary_color\":\"#a33e3e\",\"secondary_color\":\"#1ea9a9\",\"footer_promote_text\":null,\"footer_promote_btn_text\":null,\"lp_layout\":null,\"lp_title\":null,\"lp_banner_text\":null,\"lp_button_text\":null}', '322962315.jpg', '996413430.png', NULL, NULL, NULL, NULL, '2023-07-05 06:02:17', '2023-07-10 08:14:13'),
(4, 64, '{\"banner_title\":null,\"button_text\":null,\"banner_text\":null,\"primary_color\":\"#c31313\",\"secondary_color\":\"#1fc908\",\"footer_promote_text\":null,\"footer_promote_btn_text\":null,\"lp_layout\":null,\"lp_title\":null,\"lp_banner_text\":null,\"lp_button_text\":null}', '1072460872.jpg', '1242198268.png', NULL, NULL, NULL, NULL, '2023-07-10 08:37:06', '2023-07-10 14:20:19'),
(5, 19, '{\"banner_title\":null,\"button_text\":null,\"banner_text\":null,\"primary_color\":\"#3b4fe8\",\"secondary_color\":\"#f5490f\",\"footer_promote_text\":null,\"footer_promote_btn_text\":null,\"lp_layout\":null,\"lp_title\":null,\"lp_banner_text\":null,\"lp_button_text\":null,\"lp_bg_image\":{}}', '1164564229.png', '88345251.png', '1181397153.jpg', NULL, NULL, NULL, '2023-07-13 04:31:05', '2023-07-13 04:31:05'),
(6, 71, '{\"banner_title\":null,\"button_text\":null,\"banner_text\":null,\"primary_color\":\"#000000\",\"secondary_color\":\"#000000\",\"footer_promote_text\":null,\"footer_promote_btn_text\":null,\"lp_layout\":null,\"lp_title\":null,\"lp_banner_text\":null,\"lp_button_text\":null}', NULL, '442758074.png', NULL, NULL, NULL, NULL, '2023-07-17 08:14:05', '2023-07-17 08:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'thumbnail.png',
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `user_id`, `course_id`, `module_id`, `title`, `slug`, `video_link`, `thumbnail`, `lesson_file`, `short_description`, `meta_keyword`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, '1', '3', 'Et perferendis omnis', 'et-perferendis-omnis-', NULL, 'et-perferendis-omnis-647fe6afb7b34.jpeg', 'thumbnail.png', 'Rerum quod illo aspe', NULL, 'Quo possimus nesciu', 'draft', '2023-06-06 20:08:47', '2023-06-06 20:08:47'),
(2, 0, '2', '1', 'Elit reiciendis fac', 'elit-reiciendis-fac-', NULL, 'elit-reiciendis-fac-647fe6e338533.jpg', 'thumbnail.png', 'Fuga Laudantium el', NULL, 'Quo odit quod ad adi', 'published', '2023-06-06 20:09:39', '2023-06-06 20:09:39'),
(3, 0, '3', '4', 'Voluptatem voluptatu', 'voluptatem-voluptatu-', NULL, 'voluptatem-voluptatu-6482991b42ed4.svg', 'thumbnail.png', 'Omnis incidunt cons', NULL, 'Quam in illo laboris', 'draft', '2023-06-08 21:14:35', '2023-06-08 21:14:35'),
(4, 1, '13', '12', 'Text 13', 'text-13', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-01 03:48:19', '2023-09-01 03:48:19'),
(5, 1, '1', '17', 'Brady Mcgee', 'brady-mcgee', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-01 10:11:55', '2023-09-01 10:11:55'),
(6, 1, '1', '17', 'Ulla Zamora Lesson', 'ulla-zamora-lesson', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-01 10:12:26', '2023-09-01 10:12:26'),
(7, 1, '2', '20', 'hostpink lesson', 'hostpink-lesson', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-02 00:42:16', '2023-09-02 00:42:16'),
(8, 1, '3', '21', 'Bruce Klein', 'bruce-klein', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-04 00:25:26', '2023-09-04 00:25:26'),
(9, 1, '6', '23', 'Working on video upload lesson', 'working-on-video-upload-lesson', '/videos/861527482', '', 'thumbnail.png', '<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<div style=\"list-style-type: none;\">\n<p style=\"list-style-type: none;\">Please, while uploading the video. don\'t close the window or dont\'t change the URL *</p>\n</div>\n<h4 style=\"list-style-type: none;\">A Short description for this video</h4>\n<div style=\"list-style-type: none;\">\n<p style=\"list-style-type: none;\">Please, while uploading the video. don\'t close the window or dont\'t change the URL *</p>\n</div>\n<h4 style=\"list-style-type: none;\">A Short description for this video</h4>\n</body>\n</html>', NULL, NULL, 'draft', '2023-09-05 23:47:27', '2023-09-06 00:00:35'),
(10, 1, '8', '24', 'assets Lesson images Lesson courses', 'assets-lesson-images-lesson-courses', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-06 02:42:31', '2023-09-06 02:42:31'),
(11, 1, '11', '25', 'In Dark mode Totam sit dolorem la', 'in-dark-mode-totam-sit-dolorem-la', '/videos/861656510', '', 'thumbnail.png', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>instructor/courses/create/step-5</p>\r\n</body>\r\n</html>', NULL, NULL, 'draft', '2023-09-06 07:38:48', '2023-09-06 08:01:46'),
(12, 1, '12', '26', 'step 7 lesson', 'step-7-lesson', '/videos/861659836', '', 'thumbnail.png', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>\r\n<div>public function step2(){</div>\r\n<div>$lastCourseId = session()-&gt;get(\'lastCourseId\');</div>\r\n<div>if(!$lastCourseId){</div>\r\n<div>return redirect(\'instructor/courses\');</div>\r\n<div>}</div>\r\n<div>return view(\'e-learning/course/instructor/create/step-2\',[\'lastCourseId\' =&gt; $lastCourseId]);</div>\r\n<div>}</div>\r\n<br />\r\n<div>public function step2c(Request $request){</div>\r\n<div>$lastCourseId = session()-&gt;get(\'lastCourseId\');</div>\r\n<div>$course = Course::where(\'id\', $lastCourseId)-&gt;firstOrFail();</div>\r\n<div>$request-&gt;validate([</div>\r\n<div>\'thumbnail\' =&gt; \'nullable|file|mimes:jpeg,png,pdf|max:5121\', // Example mime types and maximum size</div>\r\n<div>\'description\' =&gt; \'required|string\',</div>\r\n<div>]);</div>\r\n<div>&nbsp;</div>\r\n<div>// Handle file upload</div>\r\n<div>// if ($request-&gt;hasFile(\'thumbnail\')) {</div>\r\n<div>// $file = $request-&gt;file(\'thumbnail\');</div>\r\n<div>// $filename = time() . \'_\' . $file-&gt;getClientOriginalName();</div>\r\n<div>// $file-&gt;move(public_path(\'uploads\'), $filename);</div>\r\n<div>// }</div>\r\n<br />\r\n<div>$image_path = \'assets/images/courses/thumbnail.png\';</div>\r\n<div>if ($request-&gt;hasFile(\'thumbnail\')) {</div>\r\n<div>$file = $request-&gt;file(\'thumbnail\');</div>\r\n<div>$filename = time() . \'_\' . $file-&gt;getClientOriginalName();</div>\r\n<div>&nbsp;</div>\r\n<div>// Convert image to WebP using Intervention Image</div>\r\n<div>$image = Image::make($file);</div>\r\n<div>$image-&gt;encode(\'webp\', 90); // Convert to WebP with 90% quality</div>\r\n<div>&nbsp;</div>\r\n<div>$image_path = \'assets/images/courses/\'.$course-&gt;slug . \'.webp\';</div>\r\n<br />\r\n<div>$image-&gt;save(public_path(\'assets/images/courses/\') . $course-&gt;slug . \'.webp\');</div>\r\n<div>}</div>\r\n<br />\r\n<div>// Store other form data</div>\r\n<div>$description = $request-&gt;input(\'description\');</div>\r\n<div>$course-&gt;short_description = $description;</div>\r\n<div>$course-&gt;thumbnail = $image_path;</div>\r\n<div>$course-&gt;save();</div>\r\n<div>return redirect(\'instructor/courses/create/step-3\')-&gt;with(\'success\', \'Data has been saved successfully\');</div>\r\n<div>}</div>\r\n</div>\r\n</body>\r\n</html>', NULL, NULL, 'draft', '2023-09-06 08:09:33', '2023-09-06 08:10:24'),
(13, 1, '13', '27', 'Lesson 1 of Module 7', 'lesson-1-of-module-7', '/videos/861877874', '', 'thumbnail.png', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>instruct4 or/courses/create/step-1inst 4 ructor/courses/cre 4 4ate/step-1instruct or/cours 4 4 es/create/st ep-1instruct 4 or/courses/create/step-1instructor/cours 4 es/create/step-1instruc 4 tor/cour 4 ses/create/step-1instructor/courses/create/step-1</p>\r\n</body>\r\n</html>', NULL, NULL, 'draft', '2023-09-06 20:52:53', '2023-09-06 20:54:28'),
(14, 1, '15', '30', 'Test lessons', 'test-lessons', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-08 00:21:56', '2023-09-08 00:21:56'),
(15, 1, '15', '31', 'Test lesson 2', 'test-lesson-2', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-08 00:22:35', '2023-09-08 00:22:35'),
(16, 1, '24', '34', 'Lesson 1 of module 34', 'lesson-1-of-module-34', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-09 06:08:07', '2023-09-09 06:08:07'),
(17, 1, '24', '34', 'Lesson 2 of module 34', 'lesson-2-of-module-34', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-09 06:08:25', '2023-09-09 06:08:25'),
(18, 1, '26', '37', 'Lesson 1', 'lesson-1', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-10 05:37:34', '2023-09-10 05:37:34'),
(19, 1, '26', '37', 'Lesson 2', 'lesson-2', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-10 05:37:42', '2023-09-10 05:37:42'),
(20, 1, '26', '38', 'Lesson 3', 'lesson-3', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-10 05:37:53', '2023-09-10 05:37:53'),
(21, 1, '26', '38', 'Lesson 4', 'lesson-4', NULL, '', 'thumbnail.png', NULL, NULL, NULL, 'draft', '2023-09-10 05:38:01', '2023-09-10 05:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `receiver_id`, `course_id`, `message`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 'THis is 1st message from user 1', 1, '2023-08-01 07:28:55', NULL),
(2, 1, 1, 'Message from user 2', 2, '2023-08-08 18:00:00', NULL),
(3, 1, 1, 'Message from user 2, this is anohter mesage', 2, '2023-08-06 07:29:18', NULL),
(4, 1, 2, 'Message from user 2', 6, '2023-08-06 18:00:00', NULL),
(5, 1, 1, 'Message from user 6, this is anohter mesage', 2, '1999-01-02 07:29:26', NULL),
(6, 6, 2, 'Message from user 7, this is anohter mesage', 7, '2023-12-06 07:30:45', NULL),
(7, 1, 2, 'Message from user 2, this is anohter mesage', 6, '2023-12-03 18:00:00', NULL),
(8, 1, 1, 'Message from user 2, this is anohter mesage', 2, '1999-01-09 07:31:05', NULL),
(9, 1, 1, 'Message from user 2, this is anohter mesage', 2, '2023-08-10 07:31:20', NULL),
(10, 1, 1, 'Message from user 2, this is anohter mesage', 2, '2023-08-28 07:31:31', NULL),
(11, 2, 0, 'Good', 1, '2023-08-29 01:36:40', '2023-08-29 01:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2023_05_14_061221_add_username_to_users', 1),
(30, '2014_10_12_000000_create_users_table', 2),
(31, '2014_10_12_100000_create_password_resets_table', 2),
(32, '2019_08_19_000000_create_failed_jobs_table', 2),
(33, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(35, '2023_05_18_054308_create_modules_table', 2),
(36, '2023_05_18_070744_create_lessons_table', 2),
(37, '2023_05_19_041526_create_bundle_courses_table', 2),
(38, '2023_06_03_085108_create_checkouts_table', 2),
(39, '2023_06_03_101843_add_stripe_data_to_users_table', 2),
(40, '2023_06_03_135026_create_messages_table', 2),
(41, '2023_06_03_144920_create_course_user_table', 2),
(42, '2023_06_06_045002_create_subscriptions_table', 3),
(43, '2023_06_06_045020_create_stripe_subscriptions_table', 3),
(44, '2023_06_06_053441_create_subscription_packages_table', 3),
(45, '2023_06_06_182323_create_course_reviews_table', 3),
(46, '2023_06_09_091844_add_user_id_to_modules_table', 4),
(47, '2023_06_09_201903_add_subscription_pakage_id_to_subcriptions_table', 5),
(48, '2023_06_10_041946_create_vimeo_data_table', 5),
(49, '2023_06_11_184240_create_courselogs', 6),
(50, '2023_06_11_185552_create_course_activities', 6),
(51, '2023_06_21_041557_add_instructor_id_to_checkouts_table', 7),
(53, '2023_06_21_033110_create_instructor_module_settings_table', 8),
(58, '2023_06_24_170835_drop_message_table', 9),
(59, '2023_06_24_171546_create_messages_updated_table', 9),
(60, '2023_07_28_044318_add_new_fields_to_instructor_module_settings', 9),
(62, '2023_08_28_070528_create_experiences_table', 10),
(63, '2023_08_29_061726_add_app_logo_to_instructor_module_settings_table', 11),
(67, '2023_05_17_073812_create_courses_table', 12),
(69, '2023_09_07_053918_add_certificate_to_courses_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_lesson` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `course_id`, `user_id`, `title`, `slug`, `number_of_lesson`, `number_of_attachment`, `number_of_video`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(2, '2', '1', 'Email: Module 2', 'email-module-2', '12', '10', '12', '34', 'published', '2023-06-06 03:46:06', '2023-06-06 03:46:06'),
(3, '1', '1', '100: Module 3', '100-module-3', '22', '11', '33', '33', 'published', '2023-06-06 03:47:20', '2023-06-06 03:47:20'),
(5, '1', '1', 'ttest', 'ttest', '5', '5', '5', '5', 'published', '2023-07-05 11:54:53', '2023-07-05 11:54:53'),
(10, '13', '1', 'dd($request->is_module);', 'ddrequest-is-module', '', NULL, NULL, '', 'pending', '2023-09-01 03:44:31', '2023-09-01 03:44:31'),
(14, '13', '1', 'Text 13', 'text-13', '', NULL, NULL, '', 'pending', '2023-09-01 03:49:33', '2023-09-01 03:49:33'),
(17, '1', '1', 'Module', 'module', '', NULL, NULL, '', 'pending', '2023-09-01 10:09:15', '2023-09-01 10:09:15'),
(18, '1', '1', 'Zia Shields', 'zia-shields', '', NULL, NULL, '', 'pending', '2023-09-01 10:10:57', '2023-09-01 10:10:57'),
(19, '2', '1', 'hostpink module', 'hostpink-module', '', NULL, NULL, '', 'pending', '2023-09-02 00:41:47', '2023-09-02 00:41:47'),
(20, '2', '1', 'hostpink moduke', 'hostpink-moduke', '', NULL, NULL, '', 'pending', '2023-09-02 00:42:03', '2023-09-02 00:42:03'),
(21, '3', '1', 'Todd Rollins', 'todd-rollins', '', NULL, NULL, '', 'pending', '2023-09-04 00:25:12', '2023-09-04 00:25:12'),
(23, '6', '1', 'Working on video upload module', 'working-on-video-upload-module', '', NULL, NULL, '', 'pending', '2023-09-05 23:47:10', '2023-09-05 23:47:10'),
(24, '8', '1', 'assets /images/ courses', 'assets-images-courses', '', NULL, NULL, '', 'pending', '2023-09-06 02:42:14', '2023-09-06 02:42:14'),
(25, '11', '1', 'In Dark mode Totam sit dolorem la', 'in-dark-mode-totam-sit-dolorem-la', '', NULL, NULL, '', 'pending', '2023-09-06 07:38:40', '2023-09-06 07:38:40'),
(27, '13', '1', 'Module 7', 'module-7', '', NULL, NULL, '', 'pending', '2023-09-06 20:52:39', '2023-09-06 20:52:39'),
(29, '15', '1', 'Module 2', 'module-2', '', NULL, NULL, '', 'pending', '2023-09-08 00:12:29', '2023-09-08 00:12:29'),
(30, '15', '1', 'Module 3', 'module-3', '', NULL, NULL, '', 'pending', '2023-09-08 00:12:38', '2023-09-08 00:12:38'),
(32, '24', '1', 'Module 1', 'module-1', '', NULL, NULL, '', 'pending', '2023-09-09 05:52:40', '2023-09-09 05:52:40'),
(33, '24', '1', 'Module 1', 'module-1', '', NULL, NULL, '', 'pending', '2023-09-09 05:52:52', '2023-09-09 05:52:52'),
(34, '24', '1', 'Module 1', 'module-1', '', NULL, NULL, '', 'pending', '2023-09-09 05:53:08', '2023-09-09 05:53:08'),
(35, '24', '1', 'Module 5', 'module-5', '', NULL, NULL, '', 'pending', '2023-09-09 05:53:54', '2023-09-09 05:53:54'),
(36, '24', '1', 'Lesson 1 of module 34', 'lesson-1-of-module-34', '', NULL, NULL, '', 'pending', '2023-09-09 06:06:43', '2023-09-09 06:06:43'),
(37, '26', '1', 'Module 1', 'module-1', '', NULL, NULL, '', 'pending', '2023-09-10 05:37:09', '2023-09-10 05:37:09'),
(38, '26', '1', 'Module2', 'module2', '', NULL, NULL, '', 'pending', '2023-09-10 05:37:21', '2023-09-10 05:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stripe_subscriptions`
--

CREATE TABLE `stripe_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_packages_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `subscription_packages_id`, `instructor_id`, `name`, `stripe_plan`, `quantity`, `start_at`, `end_at`, `trial_ends_at`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '1', 'pi_3NLWfaIPOd0zPaLL1GbhzF37', 1, '2023-06-21 13:26:25', '2023-07-21 13:26:25', NULL, '2023-07-21 13:26:25', '2023-06-21 13:26:25'),
(4, 1, 7, '1', 'pi_3NQX5pIPOd0zPaLL1O9vkq0d', 1, '2023-06-05 12:54:14', '2023-07-04 12:54:14', NULL, '2023-08-23 12:54:14', '2023-07-05 12:54:14'),
(5, 2, 19, '2', 'pi_3NRBnFIPOd0zPaLL0O0cnnuY', 1, '2023-07-07 08:21:45', '2023-08-06 08:21:45', NULL, '2023-09-07 08:21:45', '2023-07-07 08:21:45'),
(6, 1, 40, '1', 'pi_3NRgsOIPOd0zPaLL0JN3b66r', 1, '2023-08-08 17:33:07', '2023-09-07 17:33:07', NULL, '2023-05-08 17:33:07', '2023-07-08 17:33:07'),
(21, 2, 62, '2', 'pi_3NSGgYIPOd0zPaLL0SOhgSAc', 1, '2023-09-10 07:56:29', '2023-10-09 07:56:29', NULL, '2023-06-10 07:56:29', '2023-07-10 07:56:29'),
(22, 1, 81, '1', 'pi_3NoKEjIPOd0zPaLL1nUl9zeg', 1, '2023-09-09 00:01:45', '2023-10-09 00:01:45', NULL, '2023-09-09 00:01:45', '2023-09-09 00:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_packages`
--

CREATE TABLE `subscription_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `features` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('monthly','yearly') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_packages`
--

INSERT INTO `subscription_packages` (`id`, `name`, `slug`, `amount`, `features`, `type`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Package 1', NULL, '70.00', '\"[\\\"Feature 1\\\",\\\"Feature 2\\\",\\\"Feature 3\\\"]\"', 'monthly', 'active', 5, '2023-06-08 02:14:57', '2023-06-08 02:14:57'),
(2, 'Package 2', NULL, '120.00', '\"[\\\"All of package 1\\\",\\\"Feature 4\\\",\\\"Feature 5\\\",\\\"Feature 6\\\"]\"', 'monthly', 'active', 5, '2023-06-08 02:15:40', '2023-06-08 02:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'students',
  `short_bio` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar.png',
  `social_links` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `recivingMessage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_secret_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_public_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `user_role`, `short_bio`, `phone`, `avatar`, `social_links`, `description`, `recivingMessage`, `email_verified_at`, `password`, `stripe_secret_key`, `stripe_public_key`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr Instructor1', 'insttwo', 'instructor2@yopmail.com', 'instructor', 'A short bio should provide a concise overview of a person\'s background, achievements, and relevant information. Here are some elements that can be included in a short bio:', '098763456789', 'mr-instructor1-648b14eb35fa4.png', 'https://facebook.com', 'Begin with a brief introduction stating your name and any relevant titles or roles you hold. Example: \"John Smith is a seasoned software engineer and technology enthusiast.\" Professional background: Summarize your professional experience, highlighting key roles, companies, or projects you have been involved in. Example: \"With over a decade of experience, John has worked for prominent tech companies such as XYZ Corporation and ABC Tech Solutions. He has contributed to the development of innovative software products and led successful teams.\" Expertise and skills: Highlight your areas of expertise and relevant skills that make you stand out in your field. Example: \"John specializes in full-stack web development, with proficiency in programming languages such as Python, JavaScript, and Java. He possesses deep knowledge of clo', NULL, '2023-07-10 07:33:14', '$2y$10$PvOMP3pHfK9To.Wfno3XTOeiEU1eJB/ZmlKKAHWd7MksFcXnql.Ki', 'sk_test_51MyRmPIPOd0zPaLLVoU39SY8hJKkKLWSXU4y8bule6fXQuzRtInpIbdJqD4CPxvPOkzhiRefwgDy1UgEInscPT1100cKRkHxeu', 'pk_test_51MyRmPIPOd0zPaLLN71WLbcuccz8GS8HNyBtHXbBm29fSqDh6cvCsTQ1ObtyztIeuqNtuW0EwLYv0upGzLDorSFX00vivHvukF', 'GTpWj6rQqlmIMYLx6hZA0D7KwYZcWeoTOAt8kT3eBQyuqTcYDGQDsdxwSt4J', '2023-06-06 02:55:52', '2023-08-28 00:21:26'),
(2, 'Haley Sargent', 'Haley', 'luqahykuhe@mailinator.com', 'student', 'Doloribus rerum assu', '+1 (982) 595-5944', 'haley-sargent-647f025b474bb.png', 'Magnam repudiandae q', 'Minus rem non quia n', '1', NULL, '$2y$10$I5rLgI2JRjHA.IkXG9zK1.qKq5qXOsFwDRGchbzBtEHlgq0TzBnVy', NULL, NULL, NULL, '2023-06-06 03:54:35', '2023-06-06 03:54:35'),
(3, 'Ezekiel Sargent', 'Sargent', 'vatusatohy@mailinator.com', 'student', 'Ex velit ex sint qua', '+1 (433) 492-8722', 'ezekiel-sargent-647f02794653b.png', 'Ut deserunt non repu', 'Laboris a ut qui vol', '1', NULL, '$2y$10$p92nXz/0kTLW83IAxklTl.PxyL1eyj9i5tbth.f2CPZ07dKWR7f5C', NULL, NULL, NULL, '2023-06-06 03:55:05', '2023-06-06 03:55:05'),
(4, 'Student one', 'Coreone', 'student1@yopmail.com', 'student', 'Design tab a total figma page ache 53. (baki gula static screenshot) Avrage worktime per page 30mint kre dhrle 25 ghonta moto lagbe', '1234509876543', 'student-one-64d5c3fc8c0fe.jpg', 'https://twitter.com', 'Design tab a total figma page ache 53. (baki gula static screenshot) Design tab a total figma page ache 53. (baki gula static screenshot)\r\nAvrage worktime per page 30mint kre dhrle 25 ghonta moto lagbe Avrage worktime per page 30mint kre dhrle 25 ghonta moto lagbe\r\nDesign tab a total figma page ache 53. (baki gula static screenshot)\r\nAvrage worktime per page 30mint kre dhrle 25 ghonta moto lagbe Design tab a total figma page ache 53. (baki gula static screenshot)\r\nAvrage worktime per page 30mint kre dhrle 25 ghonta moto lagbe', NULL, '2023-07-10 06:13:12', '$2y$10$J5KdVZQNA1.ZGrBMQoJVgOEZq037fHYXt9XcoKd9lqfqE15ucIzr2', NULL, NULL, 'qrP76RI8gkJ1bRq9sYcISC81vAzhcwVIfIc7xAl2uznEsT0ztkmqNJ1EJoUn', '2023-06-06 04:12:21', '2023-08-10 23:15:40'),
(5, 'Kennedy Alexander', 'Alexkin', 'admin@yopmail.com', 'admin', 'https://chat.openai.com/', '+1 (349) 545-6312', 'kennedy-alexander-64e435c8dd5fa.png', 'https://chat.openai.com/,https://chat.openai.com/,https://docs.google.com/document/d/1CJK2T0Q/edit,https://giopio-huddle-home.netlify.app/', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Elon Musk is a prominent entrepreneur and innovator known for his work in the technology and space industries. He was born on June 28, 1971, in Pretoria, South Africa. Musk is the founder, CEO, and lead designer of SpaceX; CEO and product architect of Tesla, Inc.; CEO of Neuralink; and founder of The Boring Company. His ventures have had a significant impact on various sectors, ranging from electric vehicles and renewable energy to space exploration and neural technology.</p>\r\n<p>One of Musk\'s most notable achievements is co-founding PayPal, an online payment company that revolutionized digital transactions. He later turned his attention to electric cars and renewable energy, founding Tesla Motors in 2004. Tesla\'s electric vehicles have gained widespread recognition for their performance, design, and role in driving the adoption of sustainable transportation.</p>\r\n<p>SpaceX, founded in 2002, is another groundbreaking endeavor by Musk. The company aims to reduce space transportation costs and enable the colonization of Mars. SpaceX has achieved numerous milestones, including the development of the Falcon 1, Falcon 9, and Falcon Heavy rockets, as well as the Dragon spacecraft. The company\'s achievements include successfully launching and landing reusable rockets, significantly reducing the cost of space travel.</p>\r\n<p>&nbsp;</p>\r\n</body>\r\n</html>', '1', '2023-07-10 06:13:12', '$2y$10$oYc9UYPel1o6naRVYcsUTuLMqkeN6Crk.tcNAzzr.uqc6Xj8dQp1K', NULL, NULL, NULL, '2023-06-06 04:17:36', '2023-08-25 00:05:41'),
(6, 'Raphael Hale', 'Harop', 'student2@yopmail.com', 'student', 'Culpa eum consequat', '+1 (499) 824-5923', 'raphael-hale-64eac895b687f.webp', 'Debitis maiores fugi,https://www.kymiwi.org.au', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '0', '2023-08-26 01:38:26', '$2y$10$G.ZYeU5l.l/4w8Cdax/VXeVy/62HWyHivokNhY2/3i6JFNTymnUxu', NULL, NULL, NULL, '2023-06-08 10:03:46', '2023-08-26 21:52:53'),
(7, 'jakarea', 'jakarea', 'jakarea@yopmail.com', 'instructor', 'jakareaparvez mail.com', '234567890', 'avatar.png', '', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '0', '2023-07-10 06:31:32', '$2y$10$e5OEASxficA5tTiQ4ru5tefyWEzVPvYQosR1fuInrR5pkeOtLOH/m', NULL, NULL, NULL, '2023-07-04 05:29:45', '2023-07-10 06:31:32'),
(11, 'ins2', 'Makoir', 'ins2@yopmail.com', 'student', NULL, NULL, 'avatar.png', NULL, NULL, '0', '2023-07-10 12:24:21', '$2y$10$uB9jMfacQ.IsaOGmY//K8e9BVOZLVmwGQHkyftKZzbBPmDjmTYhQe', NULL, NULL, NULL, '2023-07-05 07:59:45', '2023-07-10 12:24:21'),
(13, 'jason', 'Jaonis', 'jmohabali@gmail.com', 'instructor', NULL, NULL, 'avatar.jpg', NULL, NULL, '0', NULL, '$2y$10$DcDDKyKlylc3dQoSE9YGIOn35heDMTB4/PMxH5zI2TAAU5jeroJWa', NULL, NULL, NULL, '2023-07-05 11:53:17', '2023-07-05 11:53:17'),
(19, 'Inst 3', 'ins3', 'inst3@yopmail.com', 'instructor', 'inst3 yopmail.com', '23456876', 'avatar.png', '', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '0', '2023-07-13 04:29:23', '$2y$10$HUh.hgC6JYp5FQDfOxJKr.8O4hUwFrT4uVHksN2YOk.hBQMlui.i6', NULL, NULL, NULL, '2023-07-07 08:17:52', '2023-07-13 04:29:23'),
(40, 'Jason Mohab-Ali', 'Moh', 'jason__m@outlook.com', 'instructor', NULL, NULL, 'avatar.png', NULL, NULL, '0', NULL, '$2y$10$UjKZy5EhKsbOfh2kP9QNze0A7bNXQc2aS1p3zRxR6tYjw5ep/xeau', NULL, NULL, NULL, '2023-07-08 17:31:33', '2023-07-08 17:31:33'),
(42, 'Akram Khan', 'tester', 'tester@admin.com', 'admin', 'https://giopio.com/', '+1 (173) 839-7145', 'test-user-64aae7b874899.webp', 'http://localhost:8000/,https://twitter.com/', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>I started my Freelance Design Career 10 years ago and learned everything the hard way myself. I went from scratch to end up working for FORTUNE 500 companies like INTEL, PANASONIC and Coca Cola. In just 1 years of Serious UI Designing, I made my place on DRIBBBLE Working with Art Directors from Coca Cola and Project Managers from UK, I learned a lot in short period of time.</p>\r\n</body>\r\n</html>', '1', NULL, '$2y$10$aSqfcrP.kxPEVLRMLxg7ge.rbkm.lOIM3mOp39sVGowM5aRHkuhhi', NULL, NULL, NULL, '2023-07-09 15:00:40', '2023-08-10 12:33:23'),
(44, 'nayan akram', 'Naakm', 'nayan@yopmail.com', 'students', 'tester admin com text', '+1 (173) 839-7145', 'avatar.jpg', '', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '1', NULL, '$2y$10$zaGm9U0QUlffGqGuR9N6SOMHmflNYHuMcTINWI2DEoaTZcSEv3peS', NULL, NULL, NULL, '2023-07-09 15:03:49', '2023-07-09 15:03:49'),
(46, 'Mr Admin test', 'nothing', 'admintest@yopmail.com', 'admin', 'Short bio', '987456789', 'avatar.png', '', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '1', NULL, '$2y$10$cycqhoNnM8lqGIYYZ6pvcOUTATLFvB2oGy1MpyDHHLylhT5VP9boq', NULL, NULL, NULL, '2023-07-10 00:43:11', '2023-07-10 00:43:11'),
(60, 'Jason Mohab-Ali', NULL, 'jason@gonextlevelagency.nl', 'student', NULL, NULL, NULL, NULL, NULL, '0', '2023-07-10 05:27:14', '$2y$10$dlGfbygD4YQKiMDa5VWJZeVZX45UWmEOtvZo8p8eAqz/qsyMmlU7W', NULL, NULL, NULL, '2023-07-10 05:26:38', '2023-07-10 05:27:14'),
(64, 'New Instructor', 'newinst', 'newinst@yopmail.com', 'instructor', 'short bio', '98756789', 'new-instructor-64abdf2eed239.jpg', '', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '0', '2023-07-10 08:30:50', '$2y$10$TOqvYthAo/mjMIL.mrYgKeXXGJqUIgzB61n8y1pojvGo.C/InlRSa', NULL, NULL, NULL, '2023-07-10 08:29:25', '2023-07-10 08:36:30'),
(66, 'Md Arif', 'Ardeo', 'ins9@yopmail.com', 'instructor', NULL, NULL, 'avatar.jpg', NULL, NULL, '0', NULL, '$2y$10$vp2SzLTGI/sIl0fvXxdJUu6ak/tLZHPLxrZEAA7lVtqF1tyqF9peO', NULL, NULL, NULL, '2023-07-10 09:34:24', '2023-07-10 09:34:24'),
(68, 'Demo Ins', 'Dmino', 'demoins@yopmail.com', 'instructor', NULL, NULL, 'avatar.png', NULL, NULL, '0', '2023-07-10 13:56:57', '$2y$10$N14JGifwrq9mQyq9o/lFeejBMs/nzcFcdMevw/ef0FxRo4dk9qDpe', NULL, NULL, NULL, '2023-07-10 13:55:26', '2023-07-10 13:56:57'),
(71, 'Inst Two', 'insttwo2', 'instructor22@yopmail.com', 'instructor', 'A short bio for instructor2', '9745678934', 'inst-two-64b5142e2e0d4.jpg', '', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '1', '2023-07-17 08:07:00', '$2y$10$mPb2dwcwTyQ9yBpcU7Ed3u2VYSwWhXpMkqgHLv/euixTjt2dzYAEy', NULL, NULL, NULL, '2023-07-17 08:06:30', '2023-07-17 08:13:02'),
(72, 'Erica Thompson', NULL, 'gusapulol@mailinator.com', 'admin', 'https://www.fisogesaxebate.com.au', '+1 (266) 591-3881', 'avatar.png', 'Consectetur dolorum', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '1', NULL, '$2y$10$zll8ChUha2og7Sqf23HHWO/JAUZCR1gMQJH5blmQ92O5LUTSvOsMK', NULL, NULL, NULL, '2023-08-10 09:43:32', '2023-08-10 09:43:32'),
(73, 'Hall Landry', NULL, 'kodajox@mailinator.com', 'admin', 'https://www.nit.cc', '+1 (166) 366-4145', 'hall-landry-64e445bc56e0a.png', 'https://www.nit.cc,https://www.facebook.cc', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Elon Musk, born on June 28, 1971, in South Africa, is a renowned entrepreneur known for his work in technology and space. He\'s the CEO of SpaceX, advancing space travel; CEO of Tesla, promoting electric cars; and founder of Neuralink, exploring brain-computer interfaces. Musk\'s innovative ventures have left an indelible mark on industries, pushing boundaries and shaping the future.</p>\r\n</body>\r\n</html>', '0', NULL, '$2y$10$u46Y7FTtuymmIUHGD9bCyu1B7GFzolzQS3cGOKi9mBG9ocsGg3OqC', NULL, NULL, NULL, '2023-08-21 23:21:00', '2023-08-21 23:21:00'),
(74, 'Arsenio Mercer', 'lasadakaby', 'nunuk@mailinator.com', 'instructor', 'Laborum voluptate qu', '+1 (338) 605-6578', 'avatar.png', 'http://app.localhost/admin/instructor/create', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p><a href=\"create\" aria-invalid=\"true\">http://app.localhost/admin/instructor/create</a></p>\r\n</body>\r\n</html>', '1', NULL, '$2y$10$922/a/Jat2tT5APlONiENemHPS0FOhsh1MIqlOLPhbz5kz4sLjKDe', NULL, NULL, NULL, '2023-08-21 23:32:00', '2023-08-21 23:32:00'),
(75, 'Elaine Ingram', NULL, 'nybuwek@mailinator.com', 'students', 'Short BIO Elon Musk, born on June 28, 1971, in South Africa, is a renowned entrepreneur known for his work in technology and space. He\'s the CEO of SpaceX, advancing space travel; CEO of Tesla, promoting electric cars; and founder of Neuralink, exploring brain-computer interfaces. Musk\'s innovative ventures have left an indelible mark on industries, pushing boundaries and shaping the future.', '+1 (609) 865-2986', 'avatar.png', 'http://app.localhost/admin/students/create', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Description Elon Musk, born on June 28, 1971, in South Africa, is a renowned entrepreneur known for his work in technology and space. He\'s the CEO of SpaceX, advancing space travel; CEO of Tesla, promoting electric cars; and founder of Neuralink, exploring brain-computer interfaces. Musk\'s innovative ventures have left an indelible mark on industries, pushing boundaries and shaping the future.Elon Musk, born on June 28, 1971, in South Africa, is a renowned entrepreneur known for his work in technology and space. He\'s the CEO of SpaceX, advancing space travel; CEO of Tesla, promoting electric cars; and founder of Neuralink, exploring brain-computer interfaces. Musk\'s innovative ventures have left an indelible mark on industries, pushing boundaries and shaping the future.</p>\r\n</body>\r\n</html>', '1', NULL, '$2y$10$NdtVedPoajoW.zis3fXNA.SvBPcSEbX47r8RAoBsqw1Uu4kny.Jsi', NULL, NULL, NULL, '2023-08-21 23:45:19', '2023-08-21 23:45:19'),
(76, 'Malcolm Castro', NULL, 'nejytu@mailinator.com', 'students', '1Elon Musk, born on June 28, 1971, in South Africa, is a renowned entrepreneur known for his work in technology and space. He\'s the CEO of SpaceX, advancing space travel; CEO of Tesla, promoting electric cars; and founder of Neuralink, exploring brain-computer interfaces. Musk\'s innovative ventures have left an indelible mark on industries, pushing boundaries and shaping the future.', '+1 (125) 562-5425', 'avatar.png', '2Quas est nulla in d', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>3 Elon Musk, born on June 28, 1971, in South Africa, is a renowned entrepreneur known for his work in technology and space. He\'s the CEO of SpaceX, advancing space travel; CEO of Tesla, promoting electric cars; and founder of Neuralink, exploring brain-computer interfaces. Musk\'s innovative ventures have left an indelible mark on industries, pushing boundaries and shaping the future.</p>\r\n</body>\r\n</html>', '1', NULL, '$2y$10$wSEB0736/MTRrpABt3OIauYP/EAm5puIWzUHqFHxptSQ5HGpyhYZ2', NULL, NULL, NULL, '2023-08-21 23:46:04', '2023-08-21 23:46:04'),
(77, 'Sylvia Lambert', NULL, 'vigizap@mailinator.com', 'students', 'Perspiciatis volupt', '+1 (491) 167-5342', 'avatar.png', 'In pariatur Do erro', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '0', NULL, '$2y$10$susa4F6J8Oa/F8Jw9uvByus8Ry/22rI1EKhy.NTO4kojdI7F.IEQW', NULL, NULL, NULL, '2023-08-21 23:52:09', '2023-08-21 23:52:09'),
(78, 'Fresh Student', NULL, 'freshstudent@yopmail.com', 'student', NULL, NULL, 'avatar.png', NULL, NULL, '0', '2023-08-26 01:40:45', '$2y$10$7hjxmpZhLE1M5CIyfI8A/ONiu1OHNAIKedkkPp2ENpr8J77RlDiYa', NULL, NULL, NULL, '2023-08-26 01:39:55', '2023-08-26 01:40:45'),
(79, 'Inga Trevino', NULL, 'sihico@mailinator.com', 'student', 'Qui voluptas adipisi', '+1 (913) 634-9796', 'inga-trevino-64eac856c9da6.jpg', 'Voluptatem minima r', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '1', NULL, '$2y$10$xA21Cg/DCSr8Lopmm1yruumZduCG2/05TDtTAk.OQn2I/wTlTPrKm', NULL, NULL, NULL, '2023-08-26 21:51:50', '2023-08-26 21:51:50'),
(80, 'Rhoda Richards', NULL, 'feso@mailinator.com', 'student', 'Amet ea nulla volup', '+1 (733) 264-7705', 'rhoda-richards-64eac86ddf499.webp', 'Error sequi voluptat', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '0', NULL, '$2y$10$nfnuy6HxQgSpMmQ9yNlTRu4u0.UiL969NHNq5qDIjETCTuY3TQNJ.', NULL, NULL, NULL, '2023-08-26 21:52:13', '2023-08-26 21:52:13'),
(81, 'Instructor Three', 'instructor3', 'instructor3@yopmail.com', 'instructor', NULL, NULL, 'avatar.png', NULL, NULL, '0', '2023-09-08 23:17:09', '$2y$10$AQkJlusxjISmiA.BHhP6iuFOBLS58j2AHjyIHtNLuqyaFZ23efZoa', NULL, NULL, NULL, '2023-09-08 23:16:33', '2023-09-09 00:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `vimeo_data`
--

CREATE TABLE `vimeo_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vimeo_data`
--

INSERT INTO `vimeo_data` (`id`, `client_id`, `client_secret`, `access_key`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 1, '2023-07-11 10:00:29', '2023-07-11 10:00:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bundle_courses`
--
ALTER TABLE `bundle_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkouts_user_id_foreign` (`user_id`),
  ADD KEY `checkouts_course_id_foreign` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_activities`
--
ALTER TABLE `course_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_logs`
--
ALTER TABLE `course_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_user`
--
ALTER TABLE `course_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_user_course_id_foreign` (`course_id`),
  ADD KEY `course_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiences_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instructor_module_settings`
--
ALTER TABLE `instructor_module_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `stripe_subscriptions`
--
ALTER TABLE `stripe_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `subscription_packages`
--
ALTER TABLE `subscription_packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_packages_name_unique` (`name`),
  ADD UNIQUE KEY `subscription_packages_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vimeo_data`
--
ALTER TABLE `vimeo_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vimeo_data_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bundle_courses`
--
ALTER TABLE `bundle_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `course_activities`
--
ALTER TABLE `course_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_logs`
--
ALTER TABLE `course_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_reviews`
--
ALTER TABLE `course_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_user`
--
ALTER TABLE `course_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor_module_settings`
--
ALTER TABLE `instructor_module_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stripe_subscriptions`
--
ALTER TABLE `stripe_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subscription_packages`
--
ALTER TABLE `subscription_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `vimeo_data`
--
ALTER TABLE `vimeo_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `checkouts_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checkouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_user`
--
ALTER TABLE `course_user`
  ADD CONSTRAINT `course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vimeo_data`
--
ALTER TABLE `vimeo_data`
  ADD CONSTRAINT `vimeo_data_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
