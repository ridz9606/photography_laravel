-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 18, 2026 at 02:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photography_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_payments`
--

CREATE TABLE `advance_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_mode` enum('upi','card','netbanking') DEFAULT NULL,
  `payment_status` enum('success','failed','pending') NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slot_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `appointment_date` date NOT NULL,
  `status` enum('selected','booked','cancelled') NOT NULL DEFAULT 'selected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_tasks`
--

CREATE TABLE `assigned_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `editor_id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `task_description` text DEFAULT NULL,
  `status` enum('pending','in_progress','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text DEFAULT NULL,
  `blog_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `advance_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `remaining_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `booking_status` enum('pending','confirm','cancelled') NOT NULL DEFAULT 'pending',
  `payment_status` enum('partial','paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalogues`
--

CREATE TABLE `catalogues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `catalogue_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalogues`
--

INSERT INTO `catalogues` (`id`, `category_id`, `catalogue_name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Little Ms. Poser', 'Pure innocence wrapped in warmth, this newborn rests peacefully in a cozy, earthy setup. A timeless capture of love, softness, and new beginnings.', 'Little Ms. Poser.jpeg', 'active', '2026-03-17 02:50:53', '2026-03-17 04:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `status` enum('active','unactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kids', 'kids.png', 'active', '2026-03-15 13:00:53', '2026-03-15 13:00:53'),
(2, 'New Born', '1773582986_img.png', 'active', '2026-03-15 08:26:26', '2026-03-15 08:26:26'),
(3, 'Maternity', '1773583244_img.png', 'active', '2026-03-15 08:30:44', '2026-03-15 08:30:44'),
(4, 'Family', '1773583269_img.png', 'active', '2026-03-15 08:31:09', '2026-03-17 03:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('block','unblock') NOT NULL DEFAULT 'unblock',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Thalia Hilpert', 'misty.corwin@yahoo.com', '5337683232', '$2y$12$fRWqkclLWROWJ32XMp5j5ev5Eg/6Bgm4EdG8.mPFS1MtYJMjTDXHK', 'unblock', '2026-03-14 08:21:06', '2026-03-14 08:21:06'),
(2, 'Prof. Pierre Gutkowski IV', 'erdman.dominic@wisoky.com', '9190876851', '$2y$12$ulLZj4L6NSTIWLqefjxskOXDnL/um6j/zQjp1U4pphyMvETWedzu.', 'unblock', '2026-03-14 08:21:07', '2026-03-14 08:21:07'),
(3, 'Eden Schmeler MD', 'pouros.paris@hotmail.com', '5687693934', '$2y$12$6uP8Fi/TiZJ6FvdFYRx6rOn2IWrFULVmdjNRVLiUfflpY258S1hOy', 'unblock', '2026-03-14 08:21:07', '2026-03-14 08:21:07'),
(4, 'Greyson Hill', 'isadore.bergstrom@hintz.com', '5953027414', '$2y$12$Eq3PsT2PH6b5dAk5NjW2tuzeA3Cscy0BnpkQDNEwSUgeIhv2bFuc2', 'unblock', '2026-03-14 08:21:07', '2026-03-14 08:21:07'),
(5, 'Loraine Altenwerth', 'alex05@hotmail.com', '5778738641', '$2y$12$.pe43pzpvY2VLfWlmK5qB.smrdTCe4JArmDrRltEU1F/LwOZNJ6DG', 'unblock', '2026-03-14 08:21:08', '2026-03-14 08:21:08'),
(6, 'Kelvin Christiansen MD', 'kamryn.denesik@hotmail.com', '4524616248', '$2y$12$O55qvkR7smUoFzBAy4vjfOj9C/q6FonGYAWD45W1sAZH1dnY9N9iG', 'unblock', '2026-03-14 08:21:08', '2026-03-14 08:21:08'),
(7, 'Mrs. Yvette Heaney', 'mvandervort@hotmail.com', '5315931815', '$2y$12$mKEeE/5lxE83GFKnBIam1uTRflghHOdj2JChSTxUNbeLbKX4JxFDG', 'unblock', '2026-03-14 08:21:08', '2026-03-14 08:21:08'),
(8, 'Dr. Edwina Kuvalis', 'sunny.lowe@wilderman.org', '4983584860', '$2y$12$DXV9nitiScE0VU594fpTdeqk1uy0bHzT88TxeUsh/dUQyrqNaX4my', 'unblock', '2026-03-14 08:21:09', '2026-03-14 08:21:09'),
(9, 'Maritza Koepp', 'pink32@jakubowski.biz', '9908789615', '$2y$12$p1V6/RAgEHcaa7hclozWHOrv4wKZ.CJffDAqCEEgEidhOa1TMX7qK', 'unblock', '2026-03-14 08:21:09', '2026-03-14 08:21:09'),
(10, 'Dr. Carlo Kulas', 'austen.bode@lubowitz.com', '2512170515', '$2y$12$aDBRs4jHgkzbJjmqQVz/MeGVER7rBjqP70Ri1cbPzu5j62EgIsrbu', 'unblock', '2026-03-14 08:21:09', '2026-03-14 08:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `discount_type` enum('percentage','fixed') NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `editors`
--

CREATE TABLE `editors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('block','unblock') NOT NULL DEFAULT 'unblock',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `status` enum('new','responded','closed') NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `full_payments`
--

CREATE TABLE `full_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_mode` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catalogue_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image_title` varchar(150) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_03_13_065153_create_categories_table', 1),
(6, '2026_03_13_065154_create_clients_table', 1),
(7, '2026_03_13_065154_create_slots_table', 1),
(8, '2026_03_13_065155_create_catalogues_table', 1),
(9, '2026_03_13_065155_create_photographers_table', 1),
(10, '2026_03_13_065156_create_appointments_table', 1),
(11, '2026_03_13_065156_create_packages_table', 1),
(12, '2026_03_13_065157_create_advance_payments_table', 1),
(13, '2026_03_13_065157_create_bookings_table', 1),
(14, '2026_03_13_065158_create_feedback_table', 1),
(15, '2026_03_13_065158_create_full_payments_table', 1),
(16, '2026_03_13_065159_create_galleries_table', 1),
(17, '2026_03_13_065200_create_invoices_table', 1),
(18, '2026_03_13_065200_create_notifications_table', 1),
(19, '2026_03_13_070214_create_enquiries_table', 1),
(20, '2026_03_13_070215_create_blogs_table', 1),
(21, '2026_03_13_070215_create_coupons_table', 1),
(22, '2026_03_13_070216_create_support_tickets_table', 1),
(23, '2026_03_16_063154_create_contacts_table', 2),
(24, '2026_03_16_063236_create_editors_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `max_catelogues` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photographers`
--

CREATE TABLE `photographers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photographers`
--

INSERT INTO `photographers` (`id`, `name`, `email`, `password`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tanmay Sharma', 'tanmay12@gmail.com', '$2y$12$ydRlNMG.op/jZjVcTDjJde5snZdHWvir40Jq7zhjYqHfV8VR83ehm', '9874563210', 'active', '2026-03-14 06:34:40', '2026-03-16 04:53:28'),
(2, 'Alysson Veum', 'buford.legros@hermann.info', '$2y$12$8pi7WZ05gGD.p2SA7DzAieNmacNkOGSWgAdTHDUxX6d5haGOtG/e2', '9516281945', 'active', '2026-03-14 08:08:00', '2026-03-14 08:08:00'),
(3, 'Broderick Gutkowski PhD', 'cremin.jamir@hotmail.com', '$2y$12$7LxKvrd2OkSozx.xFJ6Cxeldg/jAXMWTvkuA8ZaF2NacSaSv/gYQe', '2221947128', 'active', '2026-03-14 08:08:00', '2026-03-14 08:08:00'),
(4, 'Dr. Jackeline Mante IV', 'dmaggio@hotmail.com', '$2y$12$llnmie8.t5sz4B..GfS8keXx3gUoKTZTGTEInoIovzpEV8kL.ibDu', '3144543130', 'active', '2026-03-14 08:08:01', '2026-03-14 08:08:01'),
(5, 'Kris Kreiger Jr.', 'eulah80@vandervort.net', '$2y$12$nO6qY1dhsZpdKEbMk2T6r.8QyyVAXo0r9YSk5bcFybjWfR9YRTbi2', '9444811633', 'active', '2026-03-14 08:08:01', '2026-03-14 08:08:01'),
(6, 'Dion Rutherford', 'goodwin.freeman@breitenberg.org', '$2y$12$ViwOSnkox4SMri1E/ovdMOY0L8Pk4bTJQmcbTnSQlZU2ld5ni2h8i', '2871911578', 'active', '2026-03-14 08:08:01', '2026-03-14 08:08:01'),
(7, 'Baron Keebler', 'alyson.bernier@howell.com', '$2y$12$WzoX97WvsseFBzrJXXNCSuE3hGl0P/lXTL1epGAf4pzNnID4LscTe', '1767216234', 'active', '2026-03-14 08:08:02', '2026-03-14 08:08:02'),
(8, 'Kiara Reynolds DVM', 'wgutmann@stark.com', '$2y$12$GOcfcOHOQS6H0szvMYZghObMh5zxJj3jLarCv12Jfu0FJkdI1RG4.', '9850247554', 'active', '2026-03-14 08:08:02', '2026-03-14 08:08:02'),
(9, 'Dejah Jenkins', 'ewehner@gmail.com', '$2y$12$pGa40QrlwXQfwkoAsAA09O1mSQioCsieX4jk0fKzhEqdE0dTw7aoy', '3215494920', 'active', '2026-03-14 08:08:02', '2026-03-14 08:08:02'),
(10, 'Wellington Jenkins', 'joesph82@gmail.com', '$2y$12$yp7fdNo.7RJUYQ5CHCp6yes4I8aKbvG5Yf4SBOhJAODtb1ZYF0DP.', '0385797934', 'active', '2026-03-14 08:08:03', '2026-03-14 08:08:03'),
(11, 'Eulalia Flatley', 'rashad.grant@hotmail.com', '$2y$12$rGgIL7a7oF1MkBHhIMXr0e4siVCixaOogK.LGGvhYISTNfU6u0.ou', '7668356616', 'active', '2026-03-14 08:08:03', '2026-03-14 08:08:03'),
(12, 'Isobel Schneider', 'gkutch@gmail.com', '$2y$12$W1xXaEm5JqFJxwILC4TJhOcq7kQufM/LxyxuJuaVgwNFvRp5kyiFW', '8759552808', 'active', '2026-03-14 08:19:53', '2026-03-14 08:19:53'),
(13, 'Aditya Prosacco', 'haylie06@schaden.biz', '$2y$12$dYDhEeSIFD7NOXW339Ag1epsOnAmgos7gYWt2ICGmrvyfad7s8F/O', '8780385352', 'active', '2026-03-14 08:19:54', '2026-03-14 08:19:54'),
(14, 'Ettie Pagac', 'bartell.hailee@yahoo.com', '$2y$12$r74lyw6aYWIj6wRlZXFbiuoZzxFgWirfz6pQDFpCijVIAKCHfQ9dK', '3717972797', 'active', '2026-03-14 08:19:54', '2026-03-14 08:19:54'),
(15, 'Magali Lesch', 'germaine27@kshlerin.info', '$2y$12$rMw67sXfP/9CxI5nWpEXMe88ZFj93jJqaxzlKGSzLNHqEVnmnsVNK', '3902811188', 'active', '2026-03-14 08:19:54', '2026-03-14 08:19:54'),
(16, 'Jeffery Jones', 'zemlak.heaven@dooley.com', '$2y$12$LcWW4RlDYpxuykPIOT0eD.6m/zQ8nabl7mDHPja0ExFErGF3EzmpC', '7935336383', 'active', '2026-03-14 08:19:55', '2026-03-14 08:19:55'),
(17, 'Maye Lakin', 'opal68@rowe.com', '$2y$12$x5yIb0SEHbuMeYfPNgAvTOb5U0pPpdLjozfCvzj75Z9FUDcbC6jY2', '4740778455', 'active', '2026-03-14 08:19:55', '2026-03-14 08:19:55'),
(18, 'Juanita Rau', 'maximillian70@hotmail.com', '$2y$12$cbOeMQml7np3tASI9DzzCOvgH42eBWAXMRn.TtT0f91spoEpJhRkC', '1095321158', 'active', '2026-03-14 08:19:55', '2026-03-14 08:19:55'),
(19, 'Mr. Triston Zulauf III', 'tmosciski@collier.net', '$2y$12$ork9AQHW38TDMjqLEcLNgOQ77veUhJ3nwodGxCr8f/QRRTm7oDJ/i', '3595882085', 'active', '2026-03-14 08:19:56', '2026-03-14 08:19:56'),
(20, 'Aylin Dicki', 'sipes.edyth@hotmail.com', '$2y$12$JQuLEJC9m7pIMttxe2ccsOgnDuOVjzcwBx2k868NwX780PC/DxoM.', '4073329279', 'active', '2026-03-14 08:19:56', '2026-03-14 08:19:56'),
(21, 'Prof. Darien Batz', 'soconnell@yahoo.com', '$2y$12$R3waAx6BZUtVdZOWB65tYOukd3AieBxtC29yENaw40ONXS4pdIBOK', '8304021667', 'active', '2026-03-14 08:19:56', '2026-03-14 08:19:56'),
(22, 'Miss Bianka Parisian III', 'bailey81@schmitt.net', '$2y$12$xO0OgMCR1r5fyxv7AeLVa.v.iLGPRyqvoRAsHxPGeD29o/vqbuT7a', '1208802395', 'active', '2026-03-14 08:21:03', '2026-03-14 08:21:03'),
(23, 'Kianna Harvey', 'imarvin@bailey.com', '$2y$12$Ye5JJRtqZqpN4k1LfhOA1uv6A/0womvZqhnqRlmbKN0K91G.DJrcC', '6729025193', 'active', '2026-03-14 08:21:04', '2026-03-14 08:21:04'),
(24, 'June Bednar', 'hansen.tania@lind.com', '$2y$12$Ob33zTtgngZ96P7MD2wbIe/pQpOz7M/IctCZE1EZGSA1QWxsvqGIK', '6762585499', 'active', '2026-03-14 08:21:04', '2026-03-14 08:21:04'),
(25, 'Edythe McDermott', 'danielle.luettgen@gmail.com', '$2y$12$ffguFAoBE6t87id86DaU8.29H.jDX02YoDMy4vBrFSgdaMI/XgHn2', '5485794085', 'active', '2026-03-14 08:21:04', '2026-03-14 08:21:04'),
(26, 'Prof. Bonita Crona', 'yadira.flatley@gmail.com', '$2y$12$BSCZR67j4G4Vwo8OCPHzUerVFS1nTtQpBsyUDqqu.XTRs1q8r6Lky', '4414551132', 'active', '2026-03-14 08:21:05', '2026-03-14 08:21:05'),
(27, 'Alison Gerlach IV', 'letha.abbott@hotmail.com', '$2y$12$OVgGhEVjTH1IOahNSSK3qODUOx50Aau.AYlI/jSBz4/wC1yM9w8MO', '5809282781', 'active', '2026-03-14 08:21:05', '2026-03-14 08:21:05'),
(28, 'Rollin Witting', 'kerluke.leatha@yahoo.com', '$2y$12$DhKmuPZUAnD2g6oz..p6uePNKcduJG5tls0C20Xclu0gkClMZeVZ6', '1515416555', 'active', '2026-03-14 08:21:05', '2026-03-14 08:21:05'),
(29, 'Nedra Champlin', 'reynolds.mathilde@barton.com', '$2y$12$/QH1Jc0.7YQAziH5lKI/3.ByabhlSgxmBs6lbUKBEJE17Lw.MfBAC', '2929992269', 'active', '2026-03-14 08:21:06', '2026-03-14 08:21:06'),
(30, 'Jaden Emmerich', 'martine07@gmail.com', '$2y$12$MS77xJ3gc.mOtdPsgeSpfuAoVMmd6jh4FywH/qHuOgEMUSKOUphT6', '3425068254', 'active', '2026-03-14 08:21:06', '2026-03-14 08:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slot_name` varchar(50) DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `slot_name`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Morning', '10:00:00', '12:00:00', 'active', '2026-03-17 05:56:01', '2026-03-17 06:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `admin_reply` text DEFAULT NULL,
  `status` enum('open','replied','closed') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_payments`
--
ALTER TABLE `advance_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advance_payments_appointment_id_foreign` (`appointment_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_slot_id_foreign` (`slot_id`),
  ADD KEY `appointments_client_id_foreign` (`client_id`);

--
-- Indexes for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_tasks_editor_id_foreign` (`editor_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_appointment_id_foreign` (`appointment_id`),
  ADD KEY `bookings_category_id_foreign` (`category_id`),
  ADD KEY `bookings_package_id_foreign` (`package_id`);

--
-- Indexes for table `catalogues`
--
ALTER TABLE `catalogues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalogues_category_id_foreign` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `editors`
--
ALTER TABLE `editors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `editors_email_unique` (`email`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `full_payments`
--
ALTER TABLE `full_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_payments_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_catalogue_id_foreign` (`catalogue_id`),
  ADD KEY `galleries_category_id_foreign` (`category_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_client_id_foreign` (`client_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_category_id_foreign` (`category_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photographers`
--
ALTER TABLE `photographers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photographers_email_unique` (`email`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_tickets_client_id_foreign` (`client_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance_payments`
--
ALTER TABLE `advance_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catalogues`
--
ALTER TABLE `catalogues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `editors`
--
ALTER TABLE `editors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `full_payments`
--
ALTER TABLE `full_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photographers`
--
ALTER TABLE `photographers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance_payments`
--
ALTER TABLE `advance_payments`
  ADD CONSTRAINT `advance_payments_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `appointments_slot_id_foreign` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`id`);

--
-- Constraints for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  ADD CONSTRAINT `assigned_tasks_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `editors` (`id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`),
  ADD CONSTRAINT `bookings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `bookings_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`);

--
-- Constraints for table `catalogues`
--
ALTER TABLE `catalogues`
  ADD CONSTRAINT `catalogues_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);

--
-- Constraints for table `full_payments`
--
ALTER TABLE `full_payments`
  ADD CONSTRAINT `full_payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_catalogue_id_foreign` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `galleries_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `support_tickets_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
