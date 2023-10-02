-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2023 at 11:04 AM
-- Server version: 10.4.27-MariaDB
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
  `user_id` varchar(191) NOT NULL,
  `title` text NOT NULL,
  `slug` text DEFAULT NULL,
  `selected_course` varchar(191) NOT NULL,
  `subscription_status` varchar(191) NOT NULL DEFAULT 'one_time',
  `price` varchar(191) DEFAULT NULL,
  `thumbnail` varchar(191) DEFAULT NULL,
  `short_description` longtext DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `instructor_id` varchar(191) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(191) DEFAULT NULL,
  `payment_status` varchar(191) DEFAULT NULL,
  `payment_id` varchar(191) DEFAULT NULL,
  `status` enum('pending','processing','completed','decline','canceled','refunded','failed') NOT NULL DEFAULT 'pending',
  `amount` int(11) DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `user_id`, `course_id`, `instructor_id`, `payment_method`, `payment_status`, `payment_id`, `status`, `amount`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 12, 2, 4, 'Stripe', 'Paid', 'pm_1NwMGBAElm5ocjhNazmVuPjL', 'completed', 137, '2023-07-12 18:16:11', '2023-11-05 13:35:00', '2023-07-12 18:16:11', NULL),
(2, 12, 5, 3, 'Stripe', 'Paid', 'pi_3LxXaBAElm5ocjhN11BKMRFf', 'completed', 579, '2023-07-24 02:41:29', '2024-04-29 09:35:54', '2023-07-24 02:41:29', NULL),
(3, 14, 2, 2, 'Stripe', 'Paid', 'pi_3NwMGCAElm5ocjhN1shnLduR', 'completed', 17, '2023-08-23 06:40:29', '2024-05-31 21:28:54', '2023-08-23 06:40:29', NULL),
(4, 15, 1, 2, 'Stripe', 'Paid', 'pi_3NwMGCAElm5ocjhN1shnLduR', 'completed', 12, '2023-04-01 01:10:34', '2024-02-12 04:01:02', '2023-04-01 01:10:34', NULL),
(5, 13, 10, 6, 'Stripe', 'Paid', 'pi_3NwMGCAElm5ocjhN1shnLduR', 'completed', 521, '2023-06-29 18:32:34', '2024-04-06 10:30:35', '2023-06-29 18:32:34', NULL),
(6, 11, 3, 3, 'Stripe', 'Paid', 'pi_3NwMGCAElm5ocjhN1shnLduR', 'completed', 82, '2023-09-24 18:28:42', '2024-08-31 23:25:08', '2023-09-24 18:28:42', NULL),
(7, 11, 1, 3, 'Stripe', 'Paid', 'pm_1NwMGBAElm5ocjhNazmVuPjL', 'completed', 436, '2023-03-01 23:04:56', '2023-11-01 22:30:50', '2023-03-01 23:04:56', NULL),
(8, 11, 3, 3, 'Stripe', 'Paid', 'pm_1NwMGBAElm5ocjhNazmVuPjL', 'completed', 655, '2023-09-05 11:22:58', '2024-01-30 20:09:24', '2023-09-05 11:22:58', NULL),
(9, 12, 7, 3, 'Stripe', 'Paid', 'pi_3LxXaBAElm5ocjhN11BKMRFf', 'completed', 506, '2023-08-18 22:36:24', '2024-02-12 08:57:52', '2023-08-18 22:36:24', NULL),
(10, 11, 8, 3, 'Stripe', 'Paid', 'pi_3LxXaBAElm5ocjhN11BKMRFf', 'completed', 830, '2023-02-18 00:54:18', '2024-05-16 08:28:30', '2023-02-18 00:54:18', NULL),
(11, 7, 3, 2, 'Stripe', 'paid', 'pi_3NwhAXIPOd0zPaLL0MNSbBvm', 'completed', 33, NULL, NULL, '2023-10-02 02:08:02', '2023-10-02 02:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `auto_complete` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `promo_video` varchar(191) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `offer_price` decimal(10,2) DEFAULT NULL,
  `categories` text DEFAULT NULL,
  `thumbnail` varchar(191) NOT NULL DEFAULT 'public/assets/images/courses/thumbnail.png',
  `short_description` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` varchar(160) DEFAULT NULL,
  `hascertificate` tinyint(4) NOT NULL DEFAULT 0,
  `sample_certificates` varchar(191) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'draft',
  `allow_review` tinyint(4) NOT NULL DEFAULT 1,
  `language` varchar(30) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `objective` longtext DEFAULT NULL,
  `curriculum` varchar(191) DEFAULT NULL,
  `objective_details` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `auto_complete`, `user_id`, `slug`, `promo_video`, `price`, `offer_price`, `categories`, `thumbnail`, `short_description`, `description`, `meta_keyword`, `meta_description`, `hascertificate`, `sample_certificates`, `status`, `allow_review`, `language`, `platform`, `objective`, `curriculum`, `objective_details`, `created_at`, `updated_at`) VALUES
(1, 'Tempore ex nisi est et possimus.', 0, 4, 'suscipit-exercitationem-sapiente-velit-molestiae', NULL, '58.01', '43.81', 'voluptates sunt', 'assets/images/courses/a-thumbnail5.avif', 'Adipisci facilis soluta voluptatem quod odio. Ea optio neque dolor perferendis sapiente. Qui minus laborum eum maxime sed vel aliquam sint.', 'Quia voluptatibus earum in. Enim vel voluptatum beatae. Omnis quia ut aliquam est veritatis ad cumque.\n\nModi mollitia est corporis nobis qui id occaecati. Quidem ratione possimus cumque. Ut et veniam veniam tempora magnam. Voluptates facilis nihil illo debitis dolores occaecati aut.\n\nTemporibus cupiditate ut et harum at. Laudantium et ut magnam sunt omnis eius molestiae.', 'qui et rerum', 'Et et architecto voluptatum ut consequuntur voluptatem.', 1, 'certificate5.png', 'published', 0, 'fo', 'laboriosam', 'Qui quo voluptatibus mollitia ut veniam sunt qui. Esse dolore voluptates similique sed ipsa ipsa. Adipisci nulla architecto laborum tempora aliquam.', 'curriculum998', 'Dolor deleniti consequuntur repudiandae dolor voluptatibus. Quasi eum ut accusamus nam sit dolores. Atque repellat numquam sed sit veritatis officia.', '2023-10-02 05:18:52', '2023-10-02 00:53:33'),
(2, 'Ratione est nostrum blanditiis deserunt doloremque molestiae.', 1, 2, 'sint-aut-earum-quo-dolores-qui-quaerat-consequatur', NULL, '87.68', '33.73', 'doloremque vitae', 'assets/images/courses/a-thumbnail2.avif', 'At sunt dolor aut consequatur voluptas quos. Autem cupiditate ab facilis quia pariatur cupiditate tenetur velit. Facilis quo corrupti libero modi qui consectetur. Id est velit dicta rem aliquam assumenda quam.', 'Sit neque optio deserunt nulla odio quod. Animi id illo esse eveniet facilis et ut rerum. Ullam ex dolor ut laborum.\n\nSed beatae quae illo aliquam ea qui. Qui iure voluptas eos. Explicabo dolore aut quae quo tenetur fugiat.\n\nNisi quod libero laborum cupiditate corporis. Deleniti consequatur repellendus ullam. Sapiente non fugiat nulla quod quasi qui perferendis modi. Reiciendis quas repudiandae est molestiae.', 'possimus ab necessitatibus', 'Non non quia officiis magni architecto error.', 1, 'certificate1.png', 'draft', 1, 'uk', 'reprehenderit', 'Maxime sit ea quaerat occaecati vel corrupti non. Est et distinctio laudantium officia tempore rerum officia. Aut et sapiente sit. Maxime eius aut repellat ducimus.', 'curriculum834', 'Et expedita velit quos porro omnis assumenda sed enim. Consequatur hic hic et omnis accusamus dolore harum qui. Consectetur ut eum qui. Eos eos ut est itaque.', '2023-05-21 11:56:39', '2023-10-02 00:53:34'),
(3, 'Est reprehenderit vitae animi debitis nemo.', 0, 2, 'et-deserunt-consectetur-perspiciatis-totam-quis-nisi', NULL, '32.17', '32.99', 'consequatur assumenda', 'assets/images/courses/a-thumbnail_real-time-course.png', 'Autem ratione veritatis ut sint placeat quas. Nisi velit est facilis saepe eum et est vitae. Fugit nulla nihil ducimus sapiente sed sunt. Suscipit fugiat id fugiat sapiente sit amet non.', 'Porro cumque amet eum aliquam sit. Et ipsa ut corporis sed et. Est magni accusamus modi architecto est impedit. Laborum corrupti sed sunt sit. Accusamus earum dolorem possimus sequi sit.\r\n\r\nEst aut amet omnis ut eveniet. Voluptatem aliquid similique accusamus quaerat consequatur et. Dignissimos corporis et expedita deserunt debitis.\r\n\r\nConsequatur sed aperiam dolores saepe id quos doloribus nostrum. Dicta expedita magni velit tempore voluptatem harum. Sapiente maiores quo voluptatum fuga nisi vero. Quibusdam nihil illum nemo doloribus recusandae earum.', 'autem alias aut', 'Perspiciatis voluptatem reiciendis aspernatur magni ex modi fugit.', 0, 'certificate1.png', 'published', 1, 'fo', 'in', 'Expedita quisquam rerum earum sunt amet exercitationem. Provident provident sed nihil in. Dolores quia quia dolorum dolorem totam. Aut temporibus consequatur sit doloribus vitae consequatur beatae.', 'curriculum303', 'Id est hic repellendus facilis modi et. Aut exercitationem delectus qui corrupti. Maiores ratione dignissimos qui ea odio magnam. Mollitia tenetur et sint et modi.', '2023-09-25 20:16:01', '2023-10-02 00:53:34'),
(4, 'Est laudantium debitis in quisquam quae voluptatem in.', 0, 3, 'consequatur-corrupti-consectetur-eaque-vel-nostrum-dolor-ut-enim', NULL, '29.55', '48.74', 'reiciendis aperiam', 'assets/images/courses/a-thumbnail3.avif', 'Sunt inventore iste molestiae et aliquid. Aut distinctio repellat magni optio. Doloremque sequi quis a veritatis magnam. Voluptatum sapiente quam quia quia aut voluptas.', 'Soluta iure aut et explicabo ad saepe excepturi. Sed molestiae veritatis incidunt magni neque inventore. Nihil debitis nemo voluptas eos ut mollitia qui rerum. Animi reiciendis doloribus iure sed unde molestiae omnis quia.\n\nDicta laborum non autem. Et totam rerum quis distinctio inventore possimus. Esse delectus voluptatem quaerat vel illo officiis. Sit vero nihil quo.\n\nQuis doloribus repudiandae sit consequatur esse animi. Suscipit adipisci quibusdam molestiae. Quibusdam molestiae eum iusto qui. Iusto quisquam repellendus at in.', 'natus quaerat eius', 'Autem dolores nisi ullam voluptas.', 0, 'certificate1.png', 'published', 0, 'el', 'qui', 'Dolorem alias omnis voluptatem voluptatem deserunt sit porro numquam. Explicabo natus velit nemo et dolorem sint. Eligendi eos omnis eos nostrum cumque molestiae nihil. Sunt sit occaecati illo quaerat.', 'curriculum691', 'Corrupti nesciunt praesentium occaecati fugit totam. Dolorem officia unde provident id aut. Illo dolorem quasi labore voluptatum.', '2024-02-22 05:41:32', '2023-10-02 00:53:34'),
(5, 'Suscipit excepturi reprehenderit dolorem.', 0, 6, 'saepe-officiis-eveniet-incidunt-vitae-voluptatem-vitae-rem', NULL, '80.82', '30.75', 'doloremque quidem', 'assets/images/courses/a-thumb12.webp', 'Recusandae nihil non ea distinctio. Consequatur asperiores sunt quo vel velit est earum. Ad tenetur delectus optio. Eum saepe placeat nulla voluptatem.', 'Sed reprehenderit error molestiae sed ducimus dolor. Cum ea placeat sint iure sed quis. Culpa asperiores vel temporibus est quibusdam dolores perspiciatis. Dolore omnis est eum neque.\n\nMolestias nisi repellat quasi doloremque nulla voluptatem quia culpa. Dolores cumque possimus voluptatem optio illum occaecati non enim. Doloremque nemo sed quo illo nesciunt.\n\nEt corporis et quo numquam. Rerum adipisci vel accusamus dolores omnis. Iste velit debitis deserunt qui iusto. Ut adipisci et facere sunt consectetur. Soluta ullam voluptate inventore sapiente alias molestiae culpa.', 'illum culpa magnam', 'Molestiae ut ullam sit voluptatem libero molestiae dolores.', 1, 'certificate3.png', 'draft', 0, 'xh', 'eos', 'Et aperiam quae quisquam quam quo voluptatem accusamus. Enim qui beatae fugit enim velit sint ipsum. Quis maiores tenetur vitae.', 'curriculum392', 'Quibusdam qui laboriosam repudiandae. Dolor autem quo dolore dignissimos. Illum et voluptates ipsam ex facere nesciunt. Aut modi impedit inventore ut perferendis provident est.', '2023-07-21 22:05:29', '2023-10-02 00:53:34'),
(6, 'Eveniet libero quidem quisquam quam et similique est.', 0, 2, 'laboriosam-quisquam-libero-nam-odio', NULL, '49.29', '41.33', 'dicta nostrum', 'assets/images/courses/a-thumbnail8.avif', 'Exercitationem voluptatem doloribus eos doloribus qui est eum pariatur. Placeat voluptas sit excepturi recusandae natus. Maxime enim placeat quod quae dignissimos voluptatibus rerum non.', 'Dolor qui optio qui enim. Dolor et iure dolores voluptatem sint a. Quia soluta suscipit nostrum perferendis eum temporibus itaque quos. Sed magni nesciunt numquam quia expedita sit magni.\n\nMaxime repellat et molestias at. Quam delectus dolorum at aperiam consequatur.\n\nSint quas quidem a optio dolor. Iste consequatur cum veritatis vero dolorem dolorem itaque. Voluptas ea veritatis sunt aut. Ullam accusantium est totam velit.', 'ratione nihil repellendus', 'Ipsa consequuntur neque aut eveniet.', 1, 'certificate1.png', 'draft', 1, 'km', 'architecto', 'Pariatur nesciunt quis doloremque quia qui fuga fugiat facilis. Aut fuga quisquam quisquam consectetur consequatur qui vel. Consequatur dignissimos laudantium et facere et.', 'curriculum395', 'Et aspernatur blanditiis sit odio quos. Placeat mollitia blanditiis harum iusto error non corrupti. Amet enim aut a sequi ut. Occaecati tempore repellat qui mollitia sunt dolore.', '2024-01-15 04:26:11', '2023-10-02 00:53:34'),
(7, 'Sint omnis voluptate velit.', 0, 5, 'veniam-voluptatem-qui-pariatur-maiores-quis', NULL, '76.92', '43.95', 'sit corrupti', 'assets/images/courses/a-thumbnail.webp', 'Omnis non ut qui. Ratione assumenda minima quos. Omnis enim voluptatem mollitia repudiandae et assumenda voluptate.', 'Corrupti facilis praesentium enim ipsam alias. Nam ab qui porro sunt. Voluptatem est repellendus ullam perspiciatis.\n\nEst velit unde et sint omnis. Eveniet aut nulla repellat voluptatem ut ipsam aut recusandae. Ut facilis temporibus alias aut. Exercitationem sit et non quae autem omnis.\n\nPraesentium ut porro ullam sapiente ad voluptatibus. Quia nobis vero sint sunt ut odio nesciunt. Necessitatibus eum laboriosam aut rerum. Adipisci quam dolor est blanditiis ut amet. Molestiae harum aut quo et distinctio nostrum.', 'error consequuntur illum', 'Praesentium sequi ut voluptas ratione dignissimos expedita.', 1, 'certificate4.png', 'published', 0, 'iu', 'explicabo', 'Aut eos voluptatibus fugit quas explicabo. Quod omnis hic vitae at voluptas.', 'curriculum441', 'Delectus natus optio molestiae rerum odio. Similique necessitatibus quaerat consectetur consequuntur. Dicta porro quod magnam itaque dolore dolore ex qui. Ipsam ratione est accusamus est ut eveniet. Recusandae doloremque alias odit accusantium dignissimos voluptatem.', '2023-11-19 15:34:17', '2023-10-02 00:53:34'),
(8, 'Cupiditate odio velit dolores mollitia.', 0, 4, 'expedita-quas-vitae-aliquid-facere-vitae', NULL, '25.02', '27.74', 'sed dignissimos', 'assets/images/courses/a-thumbnail7.avif', 'Qui quo voluptatem ducimus est. Eos fuga consequatur sint debitis. Tenetur voluptatem consequatur omnis libero ab incidunt nam.', 'In non qui delectus consequuntur. Sed delectus non earum culpa. Atque mollitia qui architecto animi.\n\nUt et dolor sunt quam quos. Debitis molestiae vel ipsa voluptatibus. Quae ad laborum labore. Itaque iusto odio similique quaerat quidem aliquam. Voluptatem fugiat voluptatibus a et mollitia.\n\nPossimus exercitationem error dolore aut aut sunt et exercitationem. Voluptatibus officia repellendus tenetur modi. Nesciunt sit aspernatur exercitationem atque facilis rerum. Est optio velit ut tempore distinctio.', 'minus earum esse', 'Quis dolorum enim error eligendi.', 1, 'certificate2.png', 'published', 0, 'se', 'maxime', 'Enim molestias omnis et possimus quisquam voluptates tempora dolores. Magnam delectus tempora id maiores animi enim reiciendis error. Non molestiae aut rerum deleniti voluptates est. Voluptatem non quia nihil rem sed.', 'curriculum353', 'Omnis dolorem officiis qui saepe. Placeat qui cumque nam est consequatur. Quia ea qui et.', '2024-02-24 22:49:18', '2023-10-02 00:53:34'),
(9, 'In saepe harum consequatur modi error illo.', 0, 6, 'ut-molestiae-similique-voluptatem-itaque-qui-sunt', NULL, '83.63', '17.20', 'voluptatem qui', 'assets/images/courses/a-thumbnail_new-real-time-audio-text-course.png', 'Qui eligendi dignissimos maiores ut quas. Culpa libero enim voluptatum animi. Officia laborum velit totam laborum voluptates animi.', 'Omnis veniam ut unde repellat perspiciatis. Ab quas asperiores nostrum possimus et minus ut. Voluptatem unde ratione quas quia voluptas. Cupiditate recusandae sit vel reprehenderit debitis deserunt sequi voluptatem.\n\nId vel nostrum dicta beatae cumque quia quas. Et laboriosam officia minima aliquid. Beatae atque praesentium ut soluta asperiores. Doloremque nihil fuga non dolorum sapiente ut et.\n\nUt quis at voluptatem. Provident et cumque voluptas et ducimus. Tempora iusto assumenda perspiciatis vero quo ut. Quidem quam maiores ea nobis.', 'mollitia possimus dicta', 'Laborum numquam fugiat consequuntur repellendus.', 0, 'certificate1.png', 'published', 0, 'sl', 'nulla', 'Corporis facilis aperiam deleniti a non ex. Cum tempora quaerat est magnam doloremque ex. Fugiat dolores cupiditate impedit et. Deserunt pariatur veniam consequuntur nisi ullam.', 'curriculum422', 'Est sunt voluptate asperiores et nisi. Soluta quo aliquam molestiae aut perspiciatis eum. Et exercitationem reprehenderit accusantium quas eius culpa. Nihil dicta dolore exercitationem quos explicabo ut iure.', '2023-08-25 11:57:51', '2023-10-02 00:53:34'),
(10, 'Et est aut nemo qui aut.', 1, 4, 'facere-voluptas-sequi-error-qui-accusantium-inventore-qui', NULL, '48.87', '28.89', 'quae et', 'assets/images/courses/a-thumbnail1.avif', 'Facilis illo enim sunt quo ut. Alias dolor impedit eum ut labore incidunt consectetur. Sed asperiores voluptas nihil ut a. A quia commodi nisi.', 'Non consequuntur vitae tempore quam est porro minima. Sequi tempora placeat est omnis. Ducimus sint quis commodi sunt reprehenderit et. Qui asperiores sint iusto ut. Incidunt sit enim sed similique odio.\n\nVoluptates hic inventore quo et. Reprehenderit officia eligendi quos odit harum nam. Veritatis suscipit aut molestias inventore facere.\n\nNulla necessitatibus modi sit itaque mollitia tenetur. Ipsum excepturi facilis omnis ab expedita. Qui et temporibus doloremque alias pariatur qui facere saepe. Dicta inventore fugiat doloremque illum vitae.', 'veniam sapiente quasi', 'Aspernatur ut quis eveniet facere.', 1, 'certificate3.png', 'draft', 1, 'kn', 'totam', 'Libero omnis nisi laboriosam dolores dicta. Hic omnis ab omnis. Asperiores sit quia porro. Aut officiis voluptate sint amet esse minima.', 'curriculum157', 'Voluptatem pariatur laborum odio omnis corporis. Non dolores ad et fuga. Facere rerum explicabo est quibusdam.', '2023-05-01 03:26:56', '2023-10-02 00:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `course_activities`
--

CREATE TABLE `course_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_completed` tinyint(4) NOT NULL DEFAULT 0,
  `duration` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_activities`
--

INSERT INTO `course_activities` (`id`, `course_id`, `instructor_id`, `module_id`, `lesson_id`, `user_id`, `is_completed`, `duration`, `created_at`, `updated_at`) VALUES
(101, 3, 0, 1, 32, 7, 1, 0, '2023-10-02 02:55:11', '2023-10-02 02:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `course_likes`
--

CREATE TABLE `course_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_likes`
--

INSERT INTO `course_likes` (`id`, `course_id`, `instructor_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 4, 2, 9, '', '2023-06-05 07:12:51', '2023-10-02 01:09:01'),
(3, 5, 6, 18, '', '2023-07-23 01:58:12', '2023-10-02 01:09:01'),
(4, 4, 2, 10, '', '2024-03-01 02:05:07', '2023-10-02 01:09:01'),
(5, 10, 5, 9, '', '2023-08-17 13:56:37', '2023-10-02 01:09:01'),
(6, 5, 4, 13, '', '2023-10-04 16:31:55', '2023-10-02 01:09:01'),
(7, 5, 6, 10, '', '2024-02-20 00:40:57', '2023-10-02 01:09:01'),
(8, 6, 3, 12, '', '2024-02-16 16:22:53', '2023-10-02 01:09:01'),
(9, 8, 2, 15, '', '2023-06-07 16:15:31', '2023-10-02 01:09:01'),
(10, 2, 4, 12, '', '2024-01-01 01:02:59', '2023-10-02 01:09:01'),
(11, 2, 3, 12, '', '2023-08-28 01:58:37', '2023-10-02 01:09:01'),
(12, 1, 6, 11, '', '2024-03-07 02:38:40', '2023-10-02 01:09:01'),
(13, 9, 5, 12, '', '2024-04-17 21:01:16', '2023-10-02 01:09:01'),
(14, 2, 5, 7, '', '2023-10-22 00:00:08', '2023-10-02 01:09:01'),
(15, 4, 3, 14, '', '2023-10-21 20:28:37', '2023-10-02 01:09:01'),
(16, 3, 2, 7, '1', '2023-10-02 02:30:51', '2023-10-02 02:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `course_logs`
--

CREATE TABLE `course_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_logs`
--

INSERT INTO `course_logs` (`id`, `course_id`, `instructor_id`, `module_id`, `lesson_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 5, 23, 11, '2023-06-05 04:24:58', '2023-10-02 01:05:47'),
(2, 9, 3, 6, 7, 13, '2023-08-30 02:17:53', '2023-10-02 01:05:47'),
(3, 7, 6, 19, 20, 14, '2024-04-07 09:41:44', '2023-10-02 01:05:47'),
(4, 3, 2, 2, 25, 8, '2024-02-28 20:31:34', '2023-10-02 01:05:47'),
(5, 10, 4, 18, 15, 9, '2023-11-18 02:28:46', '2023-10-02 01:05:47'),
(6, 9, 4, 16, 28, 14, '2023-06-18 13:58:44', '2023-10-02 01:05:47'),
(7, 9, 3, 18, 23, 12, '2023-12-16 13:04:08', '2023-10-02 01:05:47'),
(8, 8, 6, 7, 15, 8, '2023-10-28 00:20:52', '2023-10-02 01:05:47'),
(9, 8, 6, 6, 5, 14, '2023-08-17 20:24:50', '2023-10-02 01:05:47'),
(10, 6, 4, 16, 11, 11, '2023-11-18 01:03:42', '2023-10-02 01:05:47'),
(11, 8, 4, 13, 8, 14, '2023-09-26 02:42:45', '2023-10-02 01:05:47'),
(12, 3, 3, 13, 24, 11, '2024-03-31 14:57:44', '2023-10-02 01:05:47'),
(13, 2, 5, 6, 25, 8, '2024-01-02 12:29:42', '2023-10-02 01:05:47'),
(14, 4, 3, 9, 26, 8, '2023-07-03 19:21:12', '2023-10-02 01:05:47'),
(15, 2, 6, 6, 5, 11, '2023-06-01 01:14:12', '2023-10-02 01:05:47'),
(16, 6, 4, 5, 22, 13, '2024-03-09 04:46:03', '2023-10-02 01:05:47'),
(17, 7, 3, 6, 17, 8, '2023-09-11 23:33:26', '2023-10-02 01:05:47'),
(18, 8, 2, 10, 10, 15, '2024-02-25 10:18:09', '2023-10-02 01:05:47'),
(19, 9, 2, 18, 11, 10, '2023-12-12 18:28:47', '2023-10-02 01:05:47'),
(20, 3, 2, 6, 9, 10, '2023-08-30 10:25:59', '2023-10-02 01:05:47'),
(21, 7, 2, 19, 20, 13, '2023-05-30 10:56:24', '2023-10-02 01:05:47'),
(22, 7, 4, 11, 7, 8, '2023-10-24 01:10:02', '2023-10-02 01:05:47'),
(23, 5, 6, 17, 27, 9, '2024-03-22 05:48:22', '2023-10-02 01:05:47'),
(24, 9, 3, 16, 7, 15, '2023-05-31 03:53:07', '2023-10-02 01:05:47'),
(25, 5, 6, 3, 8, 15, '2024-03-22 18:21:42', '2023-10-02 01:05:47'),
(26, 2, 5, 16, 7, 8, '2023-11-12 00:45:51', '2023-10-02 01:05:47'),
(27, 7, 2, 11, 26, 8, '2023-08-11 16:23:44', '2023-10-02 01:05:47'),
(28, 1, 5, 17, 16, 9, '2023-10-26 09:11:07', '2023-10-02 01:05:47'),
(29, 2, 6, 9, 29, 12, '2024-01-06 04:04:14', '2023-10-02 01:05:47'),
(30, 4, 5, 14, 23, 15, '2023-11-17 07:46:04', '2023-10-02 01:05:47'),
(31, 1, 2, 1, 14, 15, '2024-04-15 20:38:57', '2023-10-02 01:05:47'),
(32, 1, 4, 17, 11, 11, '2023-12-21 17:09:15', '2023-10-02 01:05:47'),
(33, 9, 4, 5, 10, 11, '2024-03-28 11:48:50', '2023-10-02 01:05:47'),
(34, 1, 3, 19, 17, 8, '2024-02-02 21:58:58', '2023-10-02 01:05:47'),
(35, 7, 5, 9, 28, 10, '2023-10-18 00:00:10', '2023-10-02 01:05:47'),
(36, 2, 5, 17, 10, 11, '2023-11-26 03:15:40', '2023-10-02 01:05:47'),
(37, 4, 2, 19, 18, 10, '2024-04-13 13:45:22', '2023-10-02 01:05:47'),
(38, 8, 5, 10, 25, 10, '2023-09-25 15:59:26', '2023-10-02 01:05:47'),
(39, 10, 6, 14, 14, 10, '2023-12-19 17:15:52', '2023-10-02 01:05:47'),
(40, 9, 6, 14, 23, 10, '2023-08-03 06:29:21', '2023-10-02 01:05:47'),
(41, 4, 5, 13, 22, 7, '2024-03-13 13:05:22', '2023-10-02 01:05:47'),
(42, 8, 4, 1, 27, 14, '2023-11-21 00:08:36', '2023-10-02 01:05:47'),
(43, 8, 3, 4, 19, 15, '2024-02-21 17:09:48', '2023-10-02 01:05:47'),
(44, 10, 4, 9, 4, 7, '2023-06-25 01:44:56', '2023-10-02 01:05:47'),
(45, 9, 4, 7, 12, 11, '2024-03-02 09:06:43', '2023-10-02 01:05:47'),
(46, 10, 4, 3, 8, 10, '2024-01-05 22:04:03', '2023-10-02 01:05:47'),
(47, 2, 5, 14, 25, 10, '2023-08-02 18:51:18', '2023-10-02 01:05:47'),
(48, 1, 2, 17, 28, 14, '2023-12-31 06:19:17', '2023-10-02 01:05:47'),
(49, 2, 4, 14, 22, 13, '2023-12-18 10:14:24', '2023-10-02 01:05:47'),
(50, 8, 2, 11, 22, 11, '2024-03-07 01:52:45', '2023-10-02 01:05:47'),
(51, 3, 0, 1, 32, 7, '2023-10-02 02:08:52', '2023-10-02 03:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `course_reviews`
--

CREATE TABLE `course_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` longtext NOT NULL,
  `star` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_user`
--

CREATE TABLE `course_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(191) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_user`
--

INSERT INTO `course_user` (`id`, `course_id`, `user_id`, `instructor_id`, `payment_method`, `amount`, `paid`, `start_at`, `end_at`, `created_at`, `updated_at`) VALUES
(1, 8, 15, 3, 'Stripe', '723.00', 1, '2023-09-02 12:19:56', '2024-05-28 19:58:21', '2023-09-02 12:19:56', NULL),
(2, 9, 9, 3, 'Stripe', '137.00', 1, '2023-07-12 18:16:11', '2023-11-05 13:35:00', '2023-07-12 18:16:11', NULL),
(3, 5, 10, 2, 'Stripe', '579.00', 1, '2023-07-24 02:41:29', '2024-04-29 09:35:54', '2023-07-24 02:41:29', NULL),
(4, 4, 14, 6, 'Stripe', '17.00', 1, '2023-08-23 06:40:29', '2024-05-31 21:28:54', '2023-08-23 06:40:29', NULL),
(5, 10, 13, 3, 'Stripe', '12.00', 1, '2023-04-01 01:10:34', '2024-02-12 04:01:02', '2023-04-01 01:10:34', NULL),
(6, 3, 9, 5, 'Stripe', '521.00', 1, '2023-06-29 18:32:34', '2024-04-06 10:30:35', '2023-06-29 18:32:34', NULL),
(7, 5, 15, 2, 'Stripe', '82.00', 1, '2023-09-24 18:28:42', '2024-08-31 23:25:08', '2023-09-24 18:28:42', NULL),
(8, 2, 12, 4, 'Stripe', '436.00', 1, '2023-03-01 23:04:56', '2023-11-01 22:30:50', '2023-03-01 23:04:56', NULL),
(9, 1, 9, 2, 'Stripe', '655.00', 1, '2023-09-05 11:22:58', '2024-01-30 20:09:24', '2023-09-05 11:22:58', NULL),
(10, 6, 15, 4, 'Stripe', '506.00', 1, '2023-08-18 22:36:24', '2024-02-12 08:57:52', '2023-08-18 22:36:24', NULL),
(11, 8, 9, 5, 'Stripe', '830.00', 1, '2023-02-18 00:54:18', '2024-05-16 08:28:30', '2023-02-18 00:54:18', NULL),
(12, 3, 7, 0, 'Stripe', '32.99', 1, NULL, NULL, '2023-10-02 02:08:02', '2023-10-02 02:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `profession` varchar(191) NOT NULL,
  `company_name` varchar(191) NOT NULL,
  `job_type` varchar(191) NOT NULL,
  `experience` text DEFAULT NULL,
  `join_date` date NOT NULL,
  `retire_date` date DEFAULT NULL,
  `short_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_module_settings`
--

CREATE TABLE `instructor_module_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `app_logo` varchar(191) DEFAULT NULL,
  `favicon` varchar(191) DEFAULT NULL,
  `apple_icon` varchar(191) DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `lp_bg_image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructor_module_settings`
--

INSERT INTO `instructor_module_settings` (`id`, `instructor_id`, `app_logo`, `favicon`, `apple_icon`, `value`, `image`, `logo`, `lp_bg_image`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, NULL, '{\"primary_color\":\"#ffffff\",\"secondary_color\":\"#000000\",\"lp_layout\":\"\",\"meta_title\":null,\"meta_desc\":null}', NULL, NULL, NULL, '2023-02-18 00:54:18', '2023-10-02 01:30:37'),
(2, 3, NULL, NULL, NULL, '{\"primary_color\":\"#ffffff\",\"secondary_color\":\"#000000\",\"lp_layout\":\"\",\"meta_title\":null,\"meta_desc\":null}', NULL, NULL, NULL, '2023-02-18 00:54:18', '2023-10-02 01:30:37'),
(3, 4, NULL, NULL, NULL, '{\"primary_color\":\"#ffffff\",\"secondary_color\":\"#000000\",\"lp_layout\":\"\",\"meta_title\":null,\"meta_desc\":null}', NULL, NULL, NULL, '2023-02-18 00:54:18', '2023-10-02 01:30:37'),
(4, 5, NULL, NULL, NULL, '{\"primary_color\":\"#ffffff\",\"secondary_color\":\"#000000\",\"lp_layout\":\"\",\"meta_title\":null,\"meta_desc\":null}', NULL, NULL, NULL, '2023-02-18 00:54:18', '2023-10-02 01:30:37'),
(5, 6, NULL, NULL, NULL, '{\"primary_color\":\"#ffffff\",\"secondary_color\":\"#000000\",\"lp_layout\":\"\",\"meta_title\":null,\"meta_desc\":null}', NULL, NULL, NULL, '2023-02-18 00:54:18', '2023-10-02 01:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `duration` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `module_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `video_link` varchar(191) DEFAULT NULL,
  `thumbnail` varchar(191) NOT NULL,
  `short_description` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `type` varchar(30) NOT NULL DEFAULT 'video',
  `audio` varchar(191) DEFAULT NULL,
  `text` varchar(191) DEFAULT NULL,
  `lesson_file` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `user_id`, `course_id`, `instructor_id`, `duration`, `module_id`, `title`, `slug`, `video_link`, `thumbnail`, `short_description`, `status`, `type`, `audio`, `text`, `lesson_file`, `created_at`, `updated_at`) VALUES
(4, 2, 3, 2, 190, 1, 'Et est dolor voluptatem aut.', 'et-et-doloremque-modi', 'videos/870202238', '', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'pending', 'video', NULL, NULL, NULL, '2023-12-23 04:06:14', '2023-10-02 02:05:42'),
(5, 2, 3, 2, 500, 1, 'Ratione voluptatem molestias dignissimos voluptatum ipsa odit.', 'enim-cupiditate-magnam-aperiam-excepturi-quaerat', 'videos/870202238', '', 'Autem dolorum error odit qui ut possimus vitae ad. Neque aperiam eaque dicta dignissimos omnis eos laboriosam. Enim et ullam quas id repellendus. Impedit ut delectus excepturi id consequuntur quia qui.', 'pending', 'video', NULL, NULL, NULL, '2023-07-13 11:52:19', '2023-10-02 00:59:58'),
(6, 2, 3, 2, 340, 2, 'Voluptatum optio laboriosam dicta est.', 'sit-dolorem-possimus-esse', 'videos/870202238', '', 'Nobis et repellendus cupiditate harum architecto ullam molestias. Hic quia ipsam mollitia consequatur rerum in dolores. Voluptate iusto maiores tempora culpa facilis sint ea. Aut quis dolor ab sint non velit.', 'pending', 'video', NULL, NULL, NULL, '2024-03-06 09:18:13', '2023-10-02 00:59:58'),
(7, 3, 4, 2, 0, 3, 'Eaque vel unde inventore voluptatum sed aut.', 'id-corporis-cumque-quidem-laudantium', 'videos/870202238', '', 'Et nihil eaque enim voluptates. Aliquam impedit quia consequuntur vitae debitis. Ut ipsa sunt aut. Et asperiores omnis et animi nisi aut et.', 'pending', 'video', NULL, NULL, NULL, '2023-11-10 19:56:49', '2023-10-02 00:59:58'),
(8, 2, 3, 2, 120, 3, 'Ut nulla et eum.', 'omnis-vel-officiis-corporis-reprehenderit-unde-perferendis-voluptatum', 'videos/870202238', '', 'Modi facilis laboriosam quia dolor ut distinctio reiciendis totam. Quia suscipit consequatur rerum consequuntur laudantium. Maxime et et veritatis dolor necessitatibus nihil non recusandae.', 'pending', 'video', NULL, NULL, NULL, '2024-03-17 09:28:11', '2023-10-02 00:59:58'),
(9, 4, 4, 6, 0, 3, 'Veritatis ducimus consequatur libero consequuntur vel quia.', 'qui-aut-et-distinctio-sint-sit-ut-quos-quibusdam', 'videos/870202238', '', 'Qui est cum deleniti nihil nisi est sit. Autem excepturi doloribus rerum et et deleniti qui. Temporibus harum numquam quod dicta error reprehenderit. Earum incidunt aut eos aut ea voluptas.', 'pending', 'video', NULL, NULL, NULL, '2023-09-17 19:44:31', '2023-10-02 00:59:58'),
(11, 2, 3, 2, 493, 2, 'Illo quo adipisci incidunt officia qui ipsum corporis.', 'consequatur-delectus-reprehenderit-amet-vel-pariatur-non-pariatur-nam', 'videos/870202238', '', 'Atque quod id ipsa ratione tempore voluptatibus. Occaecati et architecto aperiam maiores quo quae. Quis sed rerum ratione deleniti et sed. Vel excepturi dolor modi eos.', 'published', 'video', NULL, NULL, NULL, '2024-01-31 06:24:34', '2023-10-02 00:59:58'),
(12, 4, 1, 5, 0, 10, 'Dolores aut cum consequuntur ea maxime soluta.', 'repudiandae-doloribus-minus-enim-adipisci-repudiandae-cupiditate-magni', 'videos/870202238', '', 'Est modi alias aperiam et rem quo numquam ut. Veniam excepturi quasi cupiditate temporibus dolor. Rerum doloribus et aut perspiciatis.', 'pending', 'video', NULL, NULL, NULL, '2023-08-10 04:54:07', '2023-10-02 00:59:58'),
(14, 5, 1, 3, 0, 1, 'Atque maiores quidem numquam.', 'tempore-perferendis-qui-earum-enim-quisquam-voluptatem', 'videos/870202238', '', 'Laudantium est ab error esse tempore. Ad quia et assumenda dolor rerum velit minima. Reprehenderit ut fuga similique non. Asperiores et consequatur ab ut deleniti ex ut eaque.', 'pending', 'video', NULL, NULL, NULL, '2024-05-24 02:21:11', '2023-10-02 00:59:58'),
(16, 5, 2, 2, 0, 12, 'Explicabo ipsam asperiores laudantium quod doloremque commodi rerum.', 'tempore-in-consequuntur-minus-rerum-expedita-consequatur-omnis-adipisci', 'videos/870202238', '', 'Possimus vel est perspiciatis est ipsam voluptatem. Commodi ipsa aut ratione error et qui consequatur. Esse non eius quasi quia rem.', 'published', 'video', NULL, NULL, NULL, '2023-11-06 04:34:36', '2023-10-02 00:59:58'),
(17, 3, 5, 2, 0, 14, 'Qui aut est quaerat et ad sit.', 'veniam-quam-deleniti-odio-officia-sequi', 'videos/870202238', '', 'Tempore vero in sit rerum dolores sunt. Rerum consequatur unde et velit numquam qui est. Nesciunt quisquam velit tenetur qui tenetur.', 'published', 'video', NULL, NULL, NULL, '2024-04-16 13:54:11', '2023-10-02 00:59:58'),
(18, 4, 2, 4, 0, 11, 'Magnam quia ratione porro cumque similique.', 'quia-incidunt-unde-repellat-occaecati-deleniti-odit-harum-mollitia', 'videos/870202238', '', 'Facilis consequatur nesciunt ut aut sed in quia. Aut esse praesentium temporibus consectetur iste illum est. Et eum in veritatis et.', 'pending', 'video', NULL, NULL, NULL, '2023-08-31 23:47:13', '2023-10-02 00:59:58'),
(19, 3, 1, 4, 0, 14, 'Autem consequatur vel sed sint.', 'qui-occaecati-minima-et-quis-culpa-et', 'videos/870202238', '', 'Dolorum mollitia fuga aut officiis et consequatur. Voluptatibus aut ipsam autem laboriosam ipsa. Et quasi enim ab ut. Omnis assumenda non maiores omnis a in.', 'pending', 'video', NULL, NULL, NULL, '2023-12-03 07:21:39', '2023-10-02 00:59:58'),
(20, 2, 2, 5, 0, 13, 'Molestiae perspiciatis alias voluptatum.', 'tempora-magnam-odit-labore-et-quis-voluptatibus-nobis', 'videos/870202238', '', 'Dolores qui voluptatem voluptas possimus cumque voluptatem atque. Non dicta temporibus atque qui tenetur perspiciatis repellendus. Recusandae et harum provident quos dolorem ducimus consequuntur recusandae. Doloremque nostrum architecto quisquam doloremque dolorem eum ut voluptas.', 'pending', 'video', NULL, NULL, NULL, '2024-01-27 01:07:36', '2023-10-02 00:59:58'),
(21, 3, 5, 6, 0, 2, 'Eius id accusantium cumque asperiores voluptas.', 'velit-ab-et-iusto-quaerat', 'videos/870202238', '', 'Consequatur sed numquam dolore odit. Laudantium praesentium et commodi culpa consectetur veniam et. Magnam voluptate eos voluptatem vel quisquam aperiam.', 'published', 'video', NULL, NULL, NULL, '2023-11-27 05:16:21', '2023-10-02 00:59:58'),
(23, 2, 1, 3, 0, 3, 'Et quia omnis sed.', 'ipsa-ducimus-neque-unde', 'videos/870202238', '', 'Ut minus et quae similique rerum. In dignissimos sunt aspernatur et. Deleniti unde asperiores ut dolor qui voluptatum iusto. Rerum repellendus asperiores voluptas aut mollitia vel.', 'published', 'video', NULL, NULL, NULL, '2023-09-12 19:54:42', '2023-10-02 00:59:58'),
(24, 2, 5, 6, 0, 14, 'Nam optio ut quod consequatur sed voluptates voluptatum.', 'eum-qui-deleniti-est-rerum-saepe-et-qui', 'videos/870202238', '', 'Non ratione error omnis distinctio odio expedita. Error illo harum maiores consequatur numquam praesentium nihil. Eos magnam facilis maiores officia.', 'published', 'video', NULL, NULL, NULL, '2024-05-27 21:09:43', '2023-10-02 00:59:58'),
(25, 4, 2, 4, 0, 3, 'Sint laudantium sapiente a qui et omnis minus.', 'nihil-expedita-quia-aspernatur-sed-non', 'videos/870202238', '', 'Natus quam et debitis repudiandae sit nemo similique. Qui expedita ut et iusto. Debitis quo laborum rerum sit. Eius et aut suscipit voluptas rerum eaque.', 'published', 'video', NULL, NULL, NULL, '2024-03-18 01:04:59', '2023-10-02 00:59:58'),
(26, 3, 1, 3, 0, 14, 'Harum nostrum sit consequatur magni et nemo iste vitae.', 'blanditiis-et-libero-eos', 'videos/870202238', '', 'Eos eos vel aperiam vero temporibus. Dicta voluptates corrupti laudantium vitae sed nostrum deleniti. Et laudantium dolorem ut qui mollitia.', 'pending', 'video', NULL, NULL, NULL, '2023-12-16 08:06:25', '2023-10-02 00:59:58'),
(27, 3, 1, 3, 0, 2, 'Doloremque non eaque aut dolorem ipsum.', 'corporis-ea-necessitatibus-quae', 'videos/870202238', '', 'Aut a accusantium est similique. Commodi et dolore accusamus et ab et id libero. Sed voluptate magni cumque ipsa fugiat sed.', 'pending', 'video', NULL, NULL, NULL, '2023-11-16 18:00:52', '2023-10-02 00:59:58'),
(28, 2, 1, 3, 0, 6, 'Quibusdam maxime aut iure qui distinctio mollitia.', 'reiciendis-a-qui-reiciendis-ea-doloribus', 'videos/870202238', '', 'Illum voluptas quis tenetur. Fugit sint quia sed reprehenderit asperiores sapiente nisi quasi. Animi deserunt quod totam aliquam asperiores. Molestias earum autem in.', 'published', 'video', NULL, NULL, NULL, '2023-08-29 08:02:54', '2023-10-02 00:59:58'),
(29, 2, 3, 2, 40, 2, 'Vero expedita dolor quisquam et.', 'corporis-quibusdam-similique-natus-molestiae-laboriosam', 'videos/870202238', '', 'Aut qui similique tempora molestiae unde. Aliquid inventore dolores suscipit hic sit eos aut accusamus. Repellendus alias eveniet iusto architecto aut qui modi.', 'published', 'video', NULL, NULL, NULL, '2023-11-29 00:08:16', '2023-10-02 00:59:58'),
(30, 5, 4, 4, 0, 5, 'Occaecati cupiditate consequatur delectus voluptates.', 'fugiat-consequatur-vitae-dolorem-temporibus-occaecati-numquam-eius', 'videos/870202238', '', 'Earum nam atque distinctio rerum. Et dolores aut sunt perspiciatis sunt non et. Odio inventore eligendi quia voluptas quam quam non.', 'pending', 'video', NULL, NULL, NULL, '2023-12-24 06:24:49', '2023-10-02 00:59:58'),
(31, 2, 6, 0, 395, 9, 'This is video lesson for test', 'this-is-video-lesson-for-test', 'videos/870202238', '', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'pending', 'video', NULL, NULL, NULL, '2023-10-02 02:04:07', '2023-10-02 02:04:45'),
(32, 2, 3, 0, 395, 1, 'Module Number One Video Lesson', 'module-number-one-video-lesson', '/videos/870214459', '', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>This is&nbsp; short description for video</p>\r\n</body>\r\n</html>', 'pending', 'video', NULL, NULL, NULL, '2023-10-02 02:50:54', '2023-10-02 02:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` varchar(191) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `course_id` varchar(191) NOT NULL,
  `message` longtext NOT NULL,
  `attachment` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_17_073812_create_courses_table', 1),
(6, '2023_05_18_054308_create_modules_table', 1),
(7, '2023_05_18_070744_create_lessons_table', 1),
(8, '2023_05_19_041526_create_bundle_courses_table', 1),
(9, '2023_06_03_085108_create_checkouts_table', 1),
(10, '2023_06_03_144920_create_course_user_table', 1),
(11, '2023_06_06_045002_create_subscriptions_table', 1),
(12, '2023_06_06_045020_create_stripe_subscriptions_table', 1),
(13, '2023_06_06_053441_create_subscription_packages_table', 1),
(14, '2023_06_06_182323_create_course_reviews_table', 1),
(15, '2023_06_10_041946_create_vimeo_data_table', 1),
(16, '2023_06_11_184240_create_courselogs', 1),
(17, '2023_06_11_185552_create_course_activities', 1),
(18, '2023_06_21_033110_create_instructor_module_settings_table', 1),
(19, '2023_08_28_070528_create_experiences_table', 1),
(20, '2023_09_14_100215_create_course_likes_table', 1),
(21, '2023_09_18_191615_create_carts_table', 1),
(22, '2023_09_19_113342_create_notifications_table', 1),
(23, '2023_09_29_070003_create_messages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `course_id`, `instructor_id`, `user_id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 2, 'Course Number Three Number One Module', 'course-number-three-number-one-module', 'draft', '2023-07-31 11:21:16', '2023-10-02 02:49:57'),
(2, 3, 2, 2, 'Veniam ut laboriosam sed et facilis nihil.', 'mollitia-aut-aut-modi-sunt-est-sint', 'draft', '2023-07-19 21:07:34', '2023-10-02 00:55:18'),
(3, 3, 2, 3, 'Quas dolorem qui sed illum cumque.', 'asperiores-blanditiis-pariatur-sunt-dolorum-non-vel-dolorem', 'published', '2023-05-13 19:54:34', '2023-10-02 00:55:18'),
(4, 8, 6, 2, 'Quam libero voluptatum voluptatem id esse rerum.', 'architecto-nobis-non-voluptas-quis', 'published', '2023-08-29 04:12:07', '2023-10-02 00:55:18'),
(5, 1, 3, 2, 'Possimus quia quis nulla exercitationem quas rerum non.', 'sapiente-nesciunt-eum-minus-voluptatem-explicabo', 'published', '2023-08-05 05:08:56', '2023-10-02 00:55:18'),
(6, 7, 5, 2, 'Dolor dolorem dolores natus soluta voluptatem.', 'commodi-dolorum-natus-sint-minima-et-perferendis-a', 'draft', '2023-09-04 07:57:35', '2023-10-02 00:55:18'),
(7, 9, 2, 3, 'Amet maxime delectus dolor possimus quisquam assumenda et.', 'blanditiis-labore-quod-eum-explicabo-dicta-sint', 'draft', '2023-07-08 18:40:24', '2023-10-02 00:55:18'),
(9, 6, 2, 5, 'Quasi non cum ea et ullam.', 'iusto-voluptas-dolorem-voluptas', 'published', '2023-12-21 19:58:12', '2023-10-02 00:55:18'),
(10, 7, 3, 4, 'Praesentium quia iusto qui nemo neque numquam.', 'hic-est-qui-qui-vitae-fuga-aut-ipsam-commodi', 'draft', '2023-08-12 05:57:04', '2023-10-02 00:55:18'),
(11, 7, 3, 2, 'Amet quia temporibus iste et sit iusto et.', 'neque-voluptas-aut-numquam-fuga', 'draft', '2023-10-21 04:34:49', '2023-10-02 00:55:18'),
(12, 4, 6, 3, 'A id tempora earum quos.', 'voluptas-iste-quasi-voluptate-consequuntur-corporis-et', 'draft', '2023-08-07 02:41:46', '2023-10-02 00:55:18'),
(13, 6, 4, 4, 'In officiis quis in ut esse reiciendis.', 'ex-iusto-qui-aliquam-laudantium', 'published', '2023-11-30 00:24:12', '2023-10-02 00:55:18'),
(14, 1, 4, 3, 'Reprehenderit in laborum et ducimus corrupti hic.', 'dolorem-ab-quia-doloribus-non-officiis-ab-eligendi', 'draft', '2024-02-23 03:05:25', '2023-10-02 00:55:18'),
(15, 10, 5, 2, 'Illo voluptatibus similique assumenda dolores.', 'velit-unde-quo-ipsa-nostrum-consequuntur', 'draft', '2023-06-26 08:17:27', '2023-10-02 00:55:18'),
(16, 4, 3, 6, 'Magnam et ullam temporibus est.', 'voluptatem-voluptatem-fugiat-sunt-fuga', 'published', '2024-02-16 18:45:50', '2023-10-02 00:55:18'),
(17, 9, 6, 3, 'Et velit est earum earum.', 'sunt-laboriosam-et-officia-sit-quia-cumque-at', 'published', '2023-11-27 14:19:05', '2023-10-02 00:55:18'),
(18, 5, 6, 5, 'Qui perspiciatis sint vitae praesentium.', 'mollitia-est-rerum-repellat-sit-tenetur-tenetur-culpa-id', 'published', '2023-09-05 00:27:09', '2023-10-02 00:55:18'),
(19, 5, 5, 3, 'Quod repudiandae unde quia qui velit.', 'quam-velit-libero-error-ab-eius', 'published', '2023-08-23 04:08:55', '2023-10-02 00:55:18'),
(20, 10, 6, 6, 'Est et voluptas hic.', 'aliquam-aperiam-ab-incidunt-et', 'published', '2023-10-21 08:58:03', '2023-10-02 00:55:18'),
(21, 5, 4, 2, 'Repudiandae aut perferendis repellendus veritatis et fuga et.', 'dicta-ea-dolores-quia-nostrum-et', 'draft', '2024-01-02 17:54:11', '2023-10-02 00:55:18'),
(22, 6, 4, 5, 'Enim in id cupiditate veritatis rerum iste.', 'facere-quia-similique-quod-molestiae-tempora-delectus-quia', 'published', '2023-06-03 04:45:01', '2023-10-02 00:55:18'),
(23, 10, 2, 4, 'Doloremque labore beatae illo porro dolorum unde accusantium.', 'impedit-est-quis-nulla-iusto-iusto', 'draft', '2023-09-26 04:11:29', '2023-10-02 00:55:18'),
(24, 2, 4, 4, 'Repellendus velit veritatis itaque nesciunt corrupti dignissimos.', 'non-pariatur-esse-similique-eius', 'published', '2024-01-11 17:58:38', '2023-10-02 00:55:18'),
(25, 4, 6, 3, 'Et praesentium distinctio officia eum.', 'aut-ut-minima-minus-est-doloribus-dolorem-soluta', 'published', '2023-09-17 12:46:53', '2023-10-02 00:55:18'),
(26, 1, 2, 4, 'Est sint id voluptatem aut sed.', 'occaecati-molestias-et-ullam-nesciunt-quas', 'draft', '2023-12-09 02:24:08', '2023-10-02 00:55:18'),
(28, 5, 4, 6, 'Quia accusamus quia dolorum id corrupti porro earum doloremque.', 'id-praesentium-voluptatem-ducimus-quia-non-voluptatem', 'published', '2023-07-05 20:19:46', '2023-10-02 00:55:18'),
(29, 10, 4, 5, 'Architecto repellat laboriosam eos ex debitis.', 'reprehenderit-qui-fugit-minima-facilis-occaecati-natus', 'draft', '2023-08-05 05:42:18', '2023-10-02 00:55:18'),
(30, 9, 4, 3, 'Placeat vitae nihil saepe et eius ratione similique.', 'atque-ut-repellendus-veritatis-ea-repellat-ipsa-et', 'published', '2023-12-25 20:51:52', '2023-10-02 00:55:18'),
(31, 5, 2, 2, 'Et autem sint repellendus ea voluptate distinctio.', 'est-praesentium-iste-quia-sed-culpa-dicta-voluptatibus', 'published', '2023-06-30 22:50:07', '2023-10-02 00:55:18'),
(33, 1, 2, 5, 'Saepe dignissimos ex adipisci sint.', 'ut-sint-enim-non-alias-fuga-id-voluptatibus-iusto', 'published', '2024-02-19 21:35:28', '2023-10-02 00:55:18'),
(34, 4, 5, 4, 'Delectus quas assumenda reprehenderit aut id sint accusantium assumenda.', 'iusto-sunt-optio-beatae-sit', 'draft', '2023-04-20 00:07:27', '2023-10-02 00:55:18'),
(36, 4, 3, 4, 'Et minima illo sit cupiditate inventore nihil similique vel.', 'adipisci-error-rerum-in-aspernatur-rerum-aut', 'draft', '2024-02-07 04:35:21', '2023-10-02 00:55:18'),
(38, 1, 4, 4, 'Architecto repellat itaque vero nihil.', 'velit-ducimus-sunt-cum-nihil-voluptatem-quibusdam-vel-autem', 'draft', '2023-08-02 03:23:02', '2023-10-02 00:55:18'),
(39, 8, 5, 3, 'Odio voluptatem ipsa adipisci in magni incidunt et.', 'ratione-modi-voluptatem-omnis-quia-ullam-corrupti-enim', 'published', '2024-01-12 04:11:03', '2023-10-02 00:55:18'),
(42, 2, 6, 5, 'Sit pariatur ratione reprehenderit aut reprehenderit vel.', 'nesciunt-accusantium-impedit-odit-eos', 'published', '2023-09-23 07:34:46', '2023-10-02 00:55:18'),
(43, 8, 4, 5, 'Nulla qui aut autem mollitia ipsa.', 'nemo-ut-ratione-ullam-sunt-minima', 'draft', '2023-09-21 12:35:01', '2023-10-02 00:55:18'),
(45, 5, 4, 6, 'Recusandae fuga voluptatem dolores.', 'aperiam-voluptatem-ducimus-ipsam-architecto-adipisci-magnam-fuga', 'published', '2023-04-23 16:49:46', '2023-10-02 00:55:18'),
(47, 5, 2, 3, 'Consectetur rerum consequatur est ut fuga.', 'blanditiis-accusamus-facere-corporis-in-maiores', 'published', '2023-08-23 22:12:38', '2023-10-02 00:55:18'),
(48, 1, 4, 3, 'Laborum quo officiis optio accusamus cumque dolorum eligendi.', 'tempora-accusantium-qui-reprehenderit-ipsum', 'draft', '2024-02-05 06:43:16', '2023-10-02 00:55:18'),
(49, 10, 3, 5, 'Accusantium sed quisquam autem in at laudantium est.', 'quidem-qui-vero-sed-quia-dicta-et', 'draft', '2024-01-17 00:28:21', '2023-10-02 00:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(191) NOT NULL,
  `message` longtext NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'unseen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
  `stripe_id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `stripe_plan` varchar(191) NOT NULL,
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
  `name` varchar(191) NOT NULL,
  `stripe_plan` varchar(191) NOT NULL,
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
(1, 4, 6, 'qheidenreich', 'pi_3NwJgmAElm5ocjhN1LGyB7sr', 1, '2023-09-02 12:19:56', '2024-05-28 19:58:21', NULL, '2023-09-02 12:19:56', '2023-10-02 01:29:28'),
(2, 2, 6, 'dboyer', 'pi_3NwJgmAElm5ocjhN1LGyB7sr', 1, '2023-07-12 18:16:11', '2023-11-05 13:35:00', NULL, '2023-07-12 18:16:11', '2023-10-02 01:30:37'),
(3, 4, 5, 'eprice', 'pi_3NwJgmAElm5ocjhN1LGyB7sr', 1, '2023-07-24 02:41:29', '2024-04-29 09:35:54', NULL, '2023-07-24 02:41:29', '2023-10-02 01:30:37'),
(4, 3, 4, 'krista.veum', 'pi_3NwJgmAElm5ocjhN1LGyB7sr', 1, '2023-08-23 06:40:29', '2024-05-31 21:28:54', NULL, '2023-08-23 06:40:29', '2023-10-02 01:30:37'),
(5, 4, 5, 'sabrina.rutherford', 'pi_3NwMGCAElm5ocjhN1shnLduR', 1, '2023-04-01 01:10:34', '2024-02-12 04:01:02', NULL, '2023-04-01 01:10:34', '2023-10-02 01:30:37'),
(6, 1, 5, 'twiegand', 'pi_3NwLMUIPOd0zPaLL1EK4QWhi', 1, '2023-06-29 18:32:34', '2024-04-06 10:30:35', NULL, '2023-06-29 18:32:34', '2023-10-02 01:30:37'),
(7, 2, 6, 'lessie.anderson', 'pi_3NwMGCAElm5ocjhN1shnLduR', 1, '2023-09-24 18:28:42', '2024-08-31 23:25:08', NULL, '2023-09-24 18:28:42', '2023-10-02 01:30:37'),
(8, 2, 2, 'iohara', 'pi_3NwJgmAElm5ocjhN1LGyB7sr', 1, '2023-03-01 23:04:56', '2023-11-01 22:30:50', NULL, '2023-03-01 23:04:56', '2023-10-02 01:30:37'),
(9, 1, 2, 'klein.benjamin', 'pi_3NwJgmAElm5ocjhN1LGyB7sr', 1, '2023-09-05 11:22:58', '2024-01-30 20:09:24', NULL, '2023-09-05 11:22:58', '2023-10-02 01:30:37'),
(10, 1, 3, 'gwuckert', 'pi_3NwMGCAElm5ocjhN1shnLduR', 1, '2023-08-18 22:36:24', '2024-02-12 08:57:52', NULL, '2023-08-18 22:36:24', '2023-10-02 01:30:37'),
(11, 3, 5, 'alexandria.upton', 'pi_3NwLMUIPOd0zPaLL1EK4QWhi', 1, '2023-02-18 00:54:18', '2024-05-16 08:28:30', NULL, '2023-02-18 00:54:18', '2023-10-02 01:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_packages`
--

CREATE TABLE `subscription_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `features` longtext NOT NULL,
  `type` enum('monthly','yearly') NOT NULL DEFAULT 'monthly',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_packages`
--

INSERT INTO `subscription_packages` (`id`, `name`, `slug`, `amount`, `features`, `type`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Temporibus in et.', 'ad-autem-est-ut-enim', '53.43', 'Dolorum in consectetur qui eum ipsum ab ipsa.,Ab deserunt tempora magni aut.,Reiciendis qui similique amet rerum.,Eum provident voluptas veniam earum magnam at sunt.,Earum cum itaque explicabo.', 'monthly', 'inactive', 1, '2023-09-24 17:58:28', '2023-10-02 01:01:57'),
(2, 'Nisi beatae autem.', 'nulla-totam-dolore-dolores-iusto-et', '71.02', 'Illum suscipit praesentium quos nobis veritatis.,Voluptas impedit sint iste ut.,Similique eum autem repellendus culpa minus perspiciatis quia.,Ratione voluptate praesentium nam et qui tempora et.,Iure voluptatem enim placeat sed sint occaecati et.', 'yearly', 'active', 1, '2023-09-03 20:18:21', '2023-10-02 01:01:57'),
(3, 'Quia inventore.', 'nulla-omnis-aut-totam-tenetur-ea-ut-sit', '83.97', 'Dolorem facere reiciendis suscipit corporis.,Tempora vitae vel qui cum consequatur.', 'yearly', 'active', 1, '2023-09-28 19:33:50', '2023-10-02 01:01:57'),
(4, 'Quas doloremque rerum.', 'qui-ut-voluptatem-enim-provident-ipsa', '71.16', 'Amet ut earum qui autem sint ut et.,Et id qui harum eaque nihil vitae.,Impedit labore et nemo non recusandae et qui.,Fugiat molestias ab et et.', 'monthly', 'inactive', 1, '2023-09-18 12:25:51', '2023-10-02 01:01:57'),
(5, 'Sequi id.', 'et-dignissimos-consequatur-cum-et-optio-est', '72.05', 'Illo vel numquam temporibus quia maxime.,Ducimus qui id vel placeat qui.,Alias consequatur sed possimus hic quia perspiciatis.,Sed id perferendis eveniet.,Dolor et facilis similique eos amet.', 'monthly', 'active', 1, '2023-09-13 08:26:28', '2023-10-02 01:01:57'),
(6, 'Et quasi ut.', 'ipsa-et-eius-sunt-deleniti', '95.02', 'Earum rem magni tempore consequuntur sit itaque magnam.,Praesentium nam corrupti corporis optio ex.,Nisi excepturi sunt aperiam iure.', 'monthly', 'inactive', 1, '2023-09-30 01:06:33', '2023-10-02 01:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `subdomain` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `user_role` varchar(191) NOT NULL DEFAULT 'student',
  `company_name` text DEFAULT NULL,
  `short_bio` text DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `social_links` varchar(191) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `recivingMessage` varchar(191) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `vimeo_data` varchar(191) NOT NULL,
  `stripe_secret_key` varchar(191) DEFAULT NULL,
  `stripe_public_key` varchar(191) DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `subdomain`, `email`, `user_role`, `company_name`, `short_bio`, `phone`, `avatar`, `social_links`, `description`, `recivingMessage`, `email_verified_at`, `password`, `vimeo_data`, `stripe_secret_key`, `stripe_public_key`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr Admin', NULL, 'admin1@yopmail.com', 'admin', 'Schmidt, Christiansen and Daniel', 'Odio aspernatur recusandae quae iusto est nisi qui.', '+19474983367', 'assets/images/avatar.png', NULL, 'Enim numquam quia dicta. Optio sit quis non perspiciatis non sequi. Magnam incidunt minus omnis explicabo omnis et. Aspernatur autem est omnis aliquid doloremque atque porro.', '1', '2023-10-02 00:49:58', '$2y$10$koGBts3r7BNfc4LgaPPcluEFFM9rytySgPDI62Bft/nIQJtrmqfNa', '', NULL, NULL, 'active', NULL, '2023-05-16 10:47:02', '2023-10-02 00:49:58'),
(2, 'Dr. Curtis Ernser III', 'instructor1', 'instructor1@yopmail.com', 'instructor', 'Kassulke-Waters', 'Quidem ut omnis et rerum maxime.', '+1 (657) 459-5658', 'assets/images/users/6.jpeg', NULL, 'Voluptatem quia dolor omnis iusto nesciunt placeat architecto. Est veritatis neque delectus maxime voluptatem at. Eligendi at corporis molestias corporis deleniti molestias. Quas consequatur voluptatum ex.', '1', '2023-10-02 00:49:58', '$2y$10$ft2INPhIpmCflI.eP4BruOWT.FiKAihcZ2GcCIhVW6NtC1ZXxeyWe', '', 'sk_test_51MyRmPIPOd0zPaLLVoU39SY8hJKkKLWSXU4y8bule6fXQuzRtInpIbdJqD4CPxvPOkzhiRefwgDy1UgEInscPT1100cKRkHxeu', 'pk_test_51MyRmPIPOd0zPaLLN71WLbcuccz8GS8HNyBtHXbBm29fSqDh6cvCsTQ1ObtyztIeuqNtuW0EwLYv0upGzLDorSFX00vivHvukF', 'active', NULL, '2023-06-11 07:45:27', '2023-10-02 01:31:45'),
(3, 'Dr. Maude Bednar', 'instructor2', 'instructor2@yopmail.com', 'instructor', 'Conn-Pouros', 'Iure rerum eos eligendi aperiam aliquam.', '(346) 396-8174', 'assets/images/users/15.jpeg', NULL, 'Asperiores repudiandae sed accusantium laborum officiis. Nemo porro sunt et distinctio neque. Aliquid culpa quibusdam labore est harum ab fugit.', '1', '2023-10-02 00:49:58', '$2y$10$0OSSTyHYsa3c5nlonTMPZe5/zROX1AoeAWJ4.Hxcj.z.frKSHivsS', '', NULL, NULL, 'active', NULL, '2023-03-04 13:05:32', '2023-10-02 00:49:58'),
(4, 'Mazie Powlowski', 'instructor3', 'instructor3@yopmail.com', 'instructor', 'D\'Amore-Wuckert', 'Consectetur quasi quis reprehenderit.', '(520) 987-5424', 'assets/images/users/8.jpeg', NULL, 'Est veniam quas et. Ut ut ab numquam voluptas vel ea laborum. Esse est esse quidem.', '1', '2023-10-02 00:49:58', '$2y$10$QrunwxlktV9bmvjbwbTADeEta9/nuTDLDIrRcu66d.MMAVKIZLnVO', '', NULL, NULL, 'active', NULL, '2023-09-07 06:37:46', '2023-10-02 00:49:58'),
(5, 'Ida Crist', 'instructor4', 'instructor4@yopmail.com', 'instructor', 'Kessler-Cronin', 'Sit corrupti minima asperiores nihil in tempore dolorem.', '+1 (260) 609-7519', 'assets/images/users/2.jpeg', NULL, 'Pariatur hic fugiat voluptate esse in accusantium doloremque voluptatem. Laboriosam ad impedit esse dignissimos quo reprehenderit. Aut id facere sit autem perferendis molestiae eum.', '1', '2023-10-02 00:49:58', '$2y$10$zd3EonXjZJyiC4WPOe//Bu1aVfWftsBU/2oW6X5l6UBUSk0AqkpN6', '', NULL, NULL, 'active', NULL, '2023-09-09 18:09:04', '2023-10-02 00:49:59'),
(6, 'Eden Runte', 'instructor5', 'instructor5@yopmail.com', 'instructor', 'Douglas LLC', 'Aspernatur nihil cum officiis quia maxime.', '314.707.8024', 'assets/images/users/15.jpeg', NULL, 'Quis vero non id. Omnis optio eaque inventore ipsum ullam quo.', '1', '2023-10-02 00:49:59', '$2y$10$AVU8wJPNLN0JBi10SZoJ2eLXG849tMPUd4zruA5UPYyy.mXCF9cR2', '', NULL, NULL, 'active', NULL, '2022-11-24 00:46:20', '2023-10-02 00:49:59'),
(7, 'Samanta Bode', NULL, 'student1@yopmail.com', 'student', 'Yost Ltd', 'Porro voluptas placeat perferendis mollitia.', '+15647453944', 'assets/images/users/6.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Neque voluptatem natus ipsum reiciendis et soluta. Aliquam et sequi magni quae doloribus vel. Et sit aliquam delectus modi laboriosam est.', '1', '2023-10-02 00:49:59', '$2y$10$5NH3EYojjfpu7N.aWH6wJewxYLztbrJcMI1mbZvz4/l9OmxcL7DLC', '', NULL, NULL, 'active', NULL, '2023-05-08 09:04:48', '2023-10-02 00:49:59'),
(8, 'Dr. Abdul Lowe Jr.', NULL, 'student2@yopmail.com', 'student', 'O\'Reilly Group', 'Nihil voluptatum ut reiciendis provident.', '+1-564-838-4001', 'assets/images/users/1.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Fuga vitae officia necessitatibus eligendi. Corporis est explicabo quia dolores.', '1', '2023-10-02 00:49:59', '$2y$10$hlSOiYYlVuZHgHJsx/fIyO/7TI/DYneksDtZH94PJUeyb9UDLnR5e', '', NULL, NULL, 'active', NULL, '2022-12-23 06:20:18', '2023-10-02 00:49:59'),
(9, 'Candido Johnson', NULL, 'student3@yopmail.com', 'student', 'Prosacco, Will and Witting', 'Aut doloribus id voluptatem qui qui.', '430-241-1269', 'assets/images/users/12.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Facere ex dolorem quia. Voluptatum quam nesciunt provident pariatur blanditiis. Quaerat culpa officiis velit minus ut. Dolor laboriosam nemo laudantium ipsum ab voluptate doloremque.', '1', '2023-10-02 00:49:59', '$2y$10$E7b9kx8qkN9OH.PbC0peUu17weeItSQF/XnIttyYqZycvyAb4Y9Na', '', NULL, NULL, 'active', NULL, '2023-07-29 11:30:36', '2023-10-02 00:49:59'),
(10, 'Mr. Arthur Welch I', NULL, 'student4@yopmail.com', 'student', 'Koss-Cole', 'Repudiandae et qui ut aspernatur.', '(838) 587-2826', 'assets/images/users/3.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Sunt unde at id labore sit odio quia. Eius perferendis ex commodi deserunt accusamus. Inventore nam commodi neque pariatur. Fuga odit qui labore perspiciatis repellat sit voluptates facere. Ad similique veniam fuga explicabo maiores.', '1', '2023-10-02 00:49:59', '$2y$10$cvuBrPDQr9zTyAVbBVNTj.7.eCff2t/bgidOTo02CVn8YYUDNekEe', '', NULL, NULL, 'active', NULL, '2023-01-08 21:34:22', '2023-10-02 00:49:59'),
(11, 'Herbert Murphy', NULL, 'student5@yopmail.com', 'student', 'Heller-Bashirian', 'Ut quisquam commodi accusantium officiis facere.', '317.385.5385', 'assets/images/users/7.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Illum aliquid dolor vero excepturi et. Enim veritatis commodi saepe qui. Et corporis autem vel nisi illo.', '1', '2023-10-02 00:49:59', '$2y$10$LRNcAwkHE9A9Sg9MWQei3eEqQzmxKl3nfUKT27GiVYq2uLByTdajS', '', NULL, NULL, 'active', NULL, '2023-02-03 16:18:23', '2023-10-02 00:49:59'),
(12, 'Graciela Fritsch IV', NULL, 'student6@yopmail.com', 'student', 'Larkin LLC', 'Voluptatem vel cupiditate dolor sint corporis ea sunt provident.', '(270) 514-2042', 'assets/images/users/11.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Ipsam eum quaerat ratione aspernatur enim ullam consectetur. Et debitis quaerat vel quis. Eius modi omnis modi doloribus et sed omnis itaque. Minima sit praesentium reiciendis enim atque et est.', '1', '2023-10-02 00:49:59', '$2y$10$49lAdPSQEs/87viEHGAtpuwBzqapSTyUHkY/ieGhMSrVG2lP2R9Ki', '', NULL, NULL, 'active', NULL, '2023-03-30 09:34:27', '2023-10-02 00:49:59'),
(13, 'Dr. Nickolas Ritchie Jr.', NULL, 'student7@yopmail.com', 'student', 'Hand Inc', 'Libero neque aperiam vero eum vel veniam reprehenderit consequatur.', '559-342-0167', 'assets/images/users/11.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Et voluptas voluptas facilis quaerat vero autem. Voluptates veniam eum reiciendis veritatis ut. Nihil dicta maiores excepturi natus amet quaerat. Amet amet pariatur nobis cupiditate omnis dolorem.', '1', '2023-10-02 00:49:59', '$2y$10$.03sammsY01oz87kVeR0rOTc1bPlSsbc6gDbYkzWQCVXznA63JfaG', '', NULL, NULL, 'active', NULL, '2023-03-18 19:00:31', '2023-10-02 00:49:59'),
(14, 'Madyson Windler', NULL, 'student8@yopmail.com', 'student', 'Reinger LLC', 'Est impedit quis qui qui et hic aliquid.', '+1 (614) 587-5290', 'assets/images/users/9.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Ipsam sit est praesentium delectus ex ut et. Quia illum occaecati sint accusamus dolores sint nesciunt. Vitae sint consectetur asperiores dolorem quisquam.', '1', '2023-10-02 00:49:59', '$2y$10$bMDx44bQIWpscxZ6hyuR6uLDFjn9atUBPTR9v5pDTls1rpSgWUdJi', '', NULL, NULL, 'active', NULL, '2023-08-06 15:09:45', '2023-10-02 00:49:59'),
(15, 'Orion Reynolds', NULL, 'student9@yopmail.com', 'student', 'Purdy, Mills and Schaden', 'Eos maxime alias veniam ab.', '1-781-900-3799', 'assets/images/users/12.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Facilis veritatis porro quasi maxime illo doloribus maiores. Earum debitis et fugiat deleniti vel fuga. Aut at aut dolor sed consectetur doloremque.', '1', '2023-10-02 00:49:59', '$2y$10$Cxhsiuxyp4VMEiVN.nrFBuSRuDAUAAuGLmnNAaLIxoLgLH130DNYm', '', NULL, NULL, 'active', NULL, '2023-07-06 15:44:16', '2023-10-02 00:49:59'),
(16, 'Aliza Carter V', NULL, 'student10@yopmail.com', 'student', 'Skiles PLC', 'Esse ullam culpa et quia.', '+1.334.542.2674', 'assets/images/users/19.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Nulla est voluptate dolor quos sed id. Ut magnam nobis sed repellat est. Consequatur eaque recusandae aperiam soluta dolore est. Ad velit quia consequatur sint eum.', '1', '2023-10-02 00:49:59', '$2y$10$MBkBq3oPhQ3gVLgXbJT0T.y/G3PgQT3gOmNwe1bNRNzIIdEMTLYaW', '', NULL, NULL, 'active', NULL, '2023-03-07 07:46:45', '2023-10-02 00:49:59'),
(17, 'Stone Dibbert DDS', NULL, 'student11@yopmail.com', 'student', 'Hoeger and Sons', 'Quaerat est sunt voluptatum id at.', '651.701.5258', 'assets/images/users/3.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Mollitia reiciendis aut cumque. Ut ut sit autem nam et. Dolores est omnis iusto modi. Culpa autem eligendi possimus molestiae accusantium placeat deserunt.', '1', '2023-10-02 00:49:59', '$2y$10$flwnvSDB.J2tJ01VdMLdPOkhpXyXTnIARF2rKh/.mynshiFVqBc5e', '', NULL, NULL, 'active', NULL, '2022-11-20 22:49:45', '2023-10-02 00:49:59'),
(18, 'Mr. Christian Hilpert', NULL, 'student12@yopmail.com', 'student', 'Smith, Feeney and Will', 'Laborum est sunt molestiae.', '1-951-799-4806', 'assets/images/users/17.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Labore rerum id molestiae sunt et labore. Dolores repellendus id consequuntur sed odit repellendus ut. Natus aut corporis iure repellendus recusandae. Ut quis voluptatem enim et. Voluptatem atque minima atque sunt deserunt blanditiis quasi ratione.', '1', '2023-10-02 00:49:59', '$2y$10$kvpIiJl7L.P1QOEBWNYTmOcQRuNapi0TTae1nGM8MzsD60BAGeVGu', '', NULL, NULL, 'active', NULL, '2023-08-22 04:17:44', '2023-10-02 00:49:59'),
(19, 'Prof. Haylie Hickle', NULL, 'student13@yopmail.com', 'student', 'Torphy-Morissette', 'Tempora rerum rerum debitis ipsam.', '702-981-8556', 'assets/images/users/2.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Quos harum error saepe aspernatur debitis. Et magni amet quia dolorem. Commodi omnis culpa voluptatem architecto sit in aut.', '1', '2023-10-02 00:49:59', '$2y$10$YKf/becacVJMM9vjZxo3duG95NJX74buREUC4Q7VV.LbmcyjyAtta', '', NULL, NULL, 'active', NULL, '2023-04-17 13:51:36', '2023-10-02 00:50:00'),
(20, 'Marco Kuvalis', NULL, 'student14@yopmail.com', 'student', 'Cummings, Schinner and Padberg', 'Sapiente alias nostrum tenetur.', '+1 (810) 720-7153', 'assets/images/users/16.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Praesentium illum voluptates sapiente consequuntur. Maxime qui porro quisquam fugit explicabo exercitationem. Odit quia dolor consequatur qui optio illo eum ratione.', '1', '2023-10-02 00:50:00', '$2y$10$GJFgwohYkVqjRWXSH674puksCqBJ13DIqYvSvGhzig4U2U6orOfCO', '', NULL, NULL, 'active', NULL, '2023-01-16 09:34:08', '2023-10-02 00:50:00'),
(21, 'Prof. Deangelo Doyle III', NULL, 'student15@yopmail.com', 'student', 'Keebler PLC', 'Ut officia dolore quaerat voluptatum.', '(856) 682-6243', 'assets/images/users/14.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Repudiandae sequi harum nam. Magnam tempora reiciendis cum error a. Excepturi quae quasi ut reprehenderit. Ut sit non laudantium iusto beatae quos voluptas.', '1', '2023-10-02 00:50:00', '$2y$10$PI2Ar78cLXb0F1BGrlELAOaapwUR92JP1XszZeXgf/xKgECFP8wTy', '', NULL, NULL, 'active', NULL, '2023-06-27 21:02:18', '2023-10-02 00:50:00'),
(22, 'Prof. Alexane Bailey IV', NULL, 'student16@yopmail.com', 'student', 'Littel, Effertz and Powlowski', 'Magni quia sed et necessitatibus.', '+1 (520) 487-8052', 'assets/images/users/20.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Dolor dolores sunt repellat repellendus quas. Repellendus dolores est qui debitis asperiores eaque. Cupiditate aliquam aliquam ab.', '1', '2023-10-02 00:50:00', '$2y$10$A0PNbzFAHpaQSe0VluvFVuNSI/iUqhYPcU4Hrp2KxNVc6NeTkz9o2', '', NULL, NULL, 'active', NULL, '2023-03-25 17:12:06', '2023-10-02 00:50:00'),
(23, 'Ms. Kaelyn Feeney', NULL, 'student17@yopmail.com', 'student', 'Heidenreich-Friesen', 'Et distinctio tempora explicabo deserunt qui accusamus.', '+1-870-909-5462', 'assets/images/users/16.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Odit tenetur esse eius illum. Illum ratione porro ducimus accusamus eligendi et vel quo. Vel vel delectus voluptatum quo.', '1', '2023-10-02 00:50:00', '$2y$10$m3aGozJqUFhb0UQkoxn4aeYDEi34sCgXOf8ac6K1jx30DpjOzgGwu', '', NULL, NULL, 'active', NULL, '2023-02-20 16:11:01', '2023-10-02 00:50:00'),
(24, 'Michael Sauer', NULL, 'student18@yopmail.com', 'student', 'Rau PLC', 'Nisi expedita maiores dolore velit suscipit.', '985-363-4221', 'assets/images/users/16.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Officiis dolorem ea sunt aut accusamus optio odit. Vero corrupti fugit ratione iure exercitationem. Sed sed nulla molestiae omnis cum. Recusandae quo error est.', '1', '2023-10-02 00:50:00', '$2y$10$OYS4zty065ZXHRSXnO84l.jSSvdTiAKsTxxnJr/iBiP..Y9fMmrbu', '', NULL, NULL, 'active', NULL, '2023-08-05 16:25:00', '2023-10-02 00:50:00'),
(25, 'Mr. Wilburn Mayer', NULL, 'student19@yopmail.com', 'student', 'Weber Inc', 'At nostrum expedita sunt magnam debitis recusandae.', '412.465.6924', 'assets/images/users/8.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Placeat dolorum dolores cumque sit velit dicta enim laudantium. Qui porro sed non eos. Sapiente et sed cupiditate dolores quasi distinctio autem. Quibusdam adipisci porro nobis.', '1', '2023-10-02 00:50:00', '$2y$10$qI8Jz4Yqsp5SM23ZmDKOnequYmYE4w/C/CDhGLV2/Kyt/laWtpMx6', '', NULL, NULL, 'active', NULL, '2023-03-09 22:39:03', '2023-10-02 00:50:00'),
(26, 'Makenzie Bartoletti III', NULL, 'student20@yopmail.com', 'student', 'Schamberger, Wintheiser and Nolan', 'Ut voluptatem dolorem error ab dolorem molestias nihil.', '1-856-384-7530', 'assets/images/users/12.jpeg', 'https://facebook.com/faye26,https://twitter.com/dudley.von,https://instagram.com/audra.aufderhar', 'Et eum perferendis omnis. Modi ipsum laborum omnis autem officia qui ipsum. Quos illo ullam eaque cupiditate.', '1', '2023-10-02 00:50:00', '$2y$10$sBU7MdnICJfeUBS4C4yf0Ogr1gFe5ivaDswb5nsIXaJZeMaLgWcpq', '', NULL, NULL, 'active', NULL, '2022-11-11 17:08:01', '2023-10-02 00:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `vimeo_data`
--

CREATE TABLE `vimeo_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` varchar(191) DEFAULT NULL,
  `client_secret` varchar(191) DEFAULT NULL,
  `access_key` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vimeo_data`
--

INSERT INTO `vimeo_data` (`id`, `client_id`, `client_secret`, `access_key`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 6, NULL, NULL),
(2, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 2, NULL, NULL),
(3, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 6, NULL, NULL),
(4, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 5, NULL, NULL),
(5, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 2, NULL, NULL),
(6, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 3, NULL, NULL),
(7, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 4, NULL, NULL),
(8, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 3, NULL, NULL),
(9, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 3, NULL, NULL),
(10, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 4, NULL, NULL),
(11, '9b9327a8ad7087c1026d89a0e44dc86dee9fa385', 'VuARaezQdBxBpxeFs4esXAvX8EEZ/FzTcAxVnxsUzb92QY8UVJNhXFpZaFcxwAntc6BrkcKTrXhQsLZpCouhvWQWTf3JQT2DW6FWtd8RvSTTwUj/GtixFoczkr4N81j7', '4324498bedca1cbf865b359196f066a0', 5, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bundle_courses`
--
ALTER TABLE `bundle_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `course_likes`
--
ALTER TABLE `course_likes`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bundle_courses`
--
ALTER TABLE `bundle_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `course_activities`
--
ALTER TABLE `course_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `course_likes`
--
ALTER TABLE `course_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `course_logs`
--
ALTER TABLE `course_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `course_reviews`
--
ALTER TABLE `course_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_user`
--
ALTER TABLE `course_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor_module_settings`
--
ALTER TABLE `instructor_module_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subscription_packages`
--
ALTER TABLE `subscription_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `vimeo_data`
--
ALTER TABLE `vimeo_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
