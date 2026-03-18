-- Verdant Database Dump (MySQL-compatible)
-- Generated from SQLite on 2026-03-18 15:35:24
-- Compatible with MariaDB 10.x / MySQL 5.7+
-- --------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','client') NOT NULL DEFAULT 'client',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `password_reset_tokens`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `sessions`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `cache`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `cache_locks`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `jobs`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `job_batches`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `failed_jobs`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `categories`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `products`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `favorites`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `favorites_user_product` (`user_id`, `product_id`),
  KEY `favorites_product_id_foreign` (`product_id`),
  CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `permissions`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`, `guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `roles`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`, `guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `model_has_permissions`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`, `model_type`),
  CONSTRAINT `mhp_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `model_has_roles`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`, `model_type`),
  CONSTRAINT `mhr_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `role_has_permissions`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`),
  KEY `rhp_role_id_foreign` (`role_id`),
  CONSTRAINT `rhp_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rhp_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `migrations`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Data for table `users`
-- --------------------------------------------------------

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES ('1', 'Youssef Boudouar', 'youssefboudouar771@gmail.com', '2026-02-05 14:12:32', '$2y$12$lJi.n2zUl1VG6H7DQUlYFuDwycZhN0Fq7FC7/1Vh6fyG1H1V9o2a.', 'cXMu4KFuc2SM30OHPry3s05px8UrzZa5k7zIiF8cIG6Rwzbefr4y4B9msi9I', '2026-02-05 14:12:32', '2026-02-05 14:12:32', 'admin');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES ('2', 'Colorado Young', 'vozoqoryr@mailinator.com', NULL, '$2y$12$3KIZwIoyT4fDkk1mP0ExAeYdUDp7kJ43s3LQYsW0kIxpwjcp7IkkS', NULL, '2026-02-05 14:44:25', '2026-02-05 14:44:25', 'client');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES ('3', 'Lana Espinoza', 'vejagof@client.com', NULL, '$2y$12$JfE7jRSkfSs2fpNOMEjM7uad3FH0HuGIyP7Z/jBLxrEqkh5dp3D9O', NULL, '2026-02-05 23:29:37', '2026-02-05 23:29:37', 'client');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES ('4', 'Youssef', 'youssefboudouar77@gmail.com', NULL, '$2y$12$pNENYPFJDUue85UC44x61e4ONeGEL96iKQmaMXQL9Klb5FaEd48FS', NULL, '2026-02-08 15:52:44', '2026-02-08 15:52:44', 'client');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES ('5', 'Quamar Wilson', 'dyxuvafo@mailinator.com', NULL, '$2y$12$Xxr33FrCJoUbpXYX0dA6KeEpUfnENWOu.du3EY1SR.ICev.r5X2uG', NULL, '2026-02-09 15:20:47', '2026-02-09 15:20:47', 'client');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES ('6', 'David Berry', 'vyseta@mailinator.com', NULL, '$2y$12$3Sd4AcDYN7pz221L.pPSw.GVfKroa2jUcRCDVTyBeT/QEU1UFiT3S', NULL, '2026-02-18 23:19:57', '2026-02-18 23:19:57', 'client');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES ('7', 'Yasser Mansour', 'yasser111@gmail.com', NULL, '$2y$12$fX9PW8Lcc/UJJLP0Wt5e3uIevM0hr0nbgZo0M716D3cuFue0EtOTi', NULL, '2026-02-19 21:53:15', '2026-02-19 21:53:15', 'client');

-- --------------------------------------------------------
-- Data for table `categories`
-- --------------------------------------------------------

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES ('1', 'Plantes', 'dsbjhbchxnxijcdnokwodkwpe', '2026-02-05 14:12:32', '2026-02-05 14:12:32');
INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES ('2', 'Graines', 'dsiudsffsdfcsdcsdccd', '2026-02-05 14:12:32', '2026-02-05 14:12:32');
INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES ('3', 'Outils', 'dsddddddddcxcxvxcvflpokdvpo', '2026-02-05 14:12:32', '2026-02-05 14:12:32');

-- --------------------------------------------------------
-- Data for table `products`
-- --------------------------------------------------------

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('1', '2026-02-05 14:12:32', '2026-02-05 23:08:22', 'Basilic', 'Plante aromatique parfaite pour la cuisine', '5.99', 'https://images.unsplash.com/photo-1726241966213-3eb9a93722f9?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '4', '1');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('2', '2026-02-05 14:12:32', '2026-02-05 14:14:40', 'Lavande', 'Belle plante violette très parfumée', '8.5', 'https://images.unsplash.com/photo-1565011523534-747a8601f10a?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '15', '1');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('3', '2026-02-05 14:12:32', '2026-02-05 14:15:33', 'Tomate Cerise', 'Plant de tomates cerises bio', '12', 'https://img.freepik.com/photos-gratuite/vue-laterale-femme-plantant-tomates-dans-sol_23-2148850832.jpg?semt=ais_hybrid&w=740&q=80', '10', '1');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('4', '2026-02-05 14:12:32', '2026-02-05 14:16:13', 'Monstera Deliciosa', 'Large tropical plant with iconic split leaves. Perfect for bright, indirect light.', '45.99', 'https://plantsandplants.store/cdn/shop/files/PXL_20240121_083833848_1024x1024@2x.jpg?v=1706438647', '15', '1');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('5', '2026-02-05 14:12:32', '2026-02-05 14:16:48', 'Fiddle Leaf Fig', 'Stunning statement plant with large violin-shaped leaves.', '65', 'https://d3gkbidvk2xej.cloudfront.net/images/products/feda972b-ba57-4627-b47f-745e49d7989c/s/fiddle-leaf-fig-tree-xxl.jpeg', '8', '1');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('6', '2026-02-05 14:12:32', '2026-02-05 14:17:22', 'Snake Plant', 'Nearly indestructible plant perfect for beginners. Great air purifier.', '28.5', 'https://images.unsplash.com/photo-1687552212914-03a30c82053c?q=80&w=715&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '25', '1');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('7', '2026-02-05 14:12:32', '2026-02-05 14:17:59', 'Pothos Golden', 'Fast-growing trailing plant with heart-shaped leaves.', '22', 'https://bloomscape.com/wp-content/uploads/2022/10/bloomscape_xs-golden-pothos-opp_xs_angle2-scaled.jpg?ver=955408', '30', '1');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('8', '2026-02-05 14:12:32', '2026-02-05 14:18:48', 'Peace Lily', 'Elegant plant with white flowers. Thrives in low to medium light.', '35', 'https://costafarms.com/cdn/shop/files/1500x1500-Spathinweavebasket10inch_750x.jpg?v=1712158085', '12', '1');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('9', '2026-02-05 14:12:32', '2026-02-05 14:19:18', 'Rubber Plant', 'Bold plant with glossy burgundy leaves. Easy care.', '38.99', 'https://images.unsplash.com/photo-1669392597221-bbfd4b6e13ff?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '10', '1');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('13', '2026-02-05 14:12:32', '2026-02-05 14:20:03', 'Graines de Tournesol', 'Graines bio pour cultiver de beaux tournesols', '3.5', 'https://media.sudouest.fr/5773427/1000x625/shutterstock-1903211632.jpg', '50', '2');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('14', '2026-02-05 14:12:32', '2026-02-05 14:21:13', 'Graines de Carottes', 'Graines de carottes biologiques', '2.99', 'https://lepotagerpermacole.fr/wp-content/uploads/2020/09/10-metre-carottes-scaled.jpg', '40', '2');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('15', '2026-02-05 14:12:32', '2026-02-05 14:22:16', 'Graines de Radis', 'Graines de radis à croissance rapide', '2.5', 'https://koro.imgix.net/media/61/fc/7b/1662747059/SPROSS_004-06.jpg?w=3000&auto=format,compress&fit=max&cs=srgb', '35', '2');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('17', '2026-02-05 14:12:32', '2026-02-05 14:24:20', 'Basil Seeds - Sweet Genovese', 'Classic Italian basil. 200+ seeds. Perfect for pesto.', '3.5', 'https://wildroseheritageseed.com/cdn/shop/products/s145558776392258095_p108_i7_w2560_1024x1024.jpeg?v=1674218482', '150', '2');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('18', '2026-02-05 14:12:32', '2026-02-05 14:25:08', 'Sunflower Seeds - Mammoth', 'Giant sunflower variety growing up to 12 feet tall.', '4.99', 'https://greatlakesstapleseeds.com/cdn/shop/products/2018-03-23_Sunflower--Mammoth_Type_Seed.jpg?v=1601858248&width=1946', '80', '2');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('21', '2026-02-05 14:12:32', '2026-02-05 14:26:04', 'Wildflower Seed Mix', 'Diverse blend of 20+ native wildflower species.', '8.99', 'https://www.shepherdseeds.co.uk/wp-content/uploads/2021/10/Low-growing-Wildflower-Seed-100.png', '75', '2');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('24', '2026-02-05 14:12:32', '2026-02-05 14:26:43', 'Pelle de Jardin', 'Pelle ergonomique en acier inoxydable', '25', 'https://media.adeo.com/mkp/77e7d9a641d44ef72a3f9f84fb0fc659/media.jpeg', '12', '3');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('25', '2026-02-05 14:12:32', '2026-02-05 14:27:13', 'Arrosoir 5L', 'Arrosoir écologique en plastique recyclé', '18.5', 'https://m.media-amazon.com/images/I/71dvLsSUFcL._UF894,1000_QL80_.jpg', '8', '3');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('26', '2026-02-05 14:12:32', '2026-02-05 14:27:44', 'Gants de Jardinage', 'Gants résistants et confortables', '9.99', 'https://media.proidee.ch/pimg/770x/23/770x_236161a_0823.jpg', '25', '3');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('27', '2026-02-05 14:12:32', '2026-02-05 14:29:32', 'Râteau', 'Râteau léger pour entretenir votre jardin', '15', 'https://m.media-amazon.com/images/I/713WquWoFCL._UF1000,1000_QL80_.jpg', '10', '3');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('28', '2026-02-05 14:12:32', '2026-02-05 14:30:07', 'Stainless Steel Garden Trowel', 'Professional-grade trowel with ergonomic handle.', '24.99', 'https://www.mytoolshed.co.uk/artwork/produsage/SJ-5160ST-A1-Spear-Jackson-Versatility-Garden-Trowel.jpg?w=1000&h=1000', '40', '3');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_url`, `stock`, `category_id`) VALUES ('29', '2026-02-05 14:12:32', '2026-02-05 14:30:46', 'Pruning Shears - Bypass', 'Sharp carbon steel blades for clean cuts.', '32', 'https://cdn11.bigcommerce.com/s-fs1e9gadbj/images/stencil/1280x1280/products/152/408/bypasspruner1411__81096.1733253728.jpg?c=1', '25', '3');

-- --------------------------------------------------------
-- Data for table `favorites`
-- --------------------------------------------------------

INSERT INTO `favorites` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES ('8', '6', '1', NULL, NULL);
INSERT INTO `favorites` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES ('9', '7', '6', NULL, NULL);
INSERT INTO `favorites` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES ('10', '7', '25', NULL, NULL);
INSERT INTO `favorites` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES ('11', '7', '13', NULL, NULL);

-- --------------------------------------------------------
-- Data for table `permissions`
-- --------------------------------------------------------

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('1', 'view products', 'web', '2026-02-10 15:35:50', '2026-02-10 15:35:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('2', 'create products', 'web', '2026-02-10 15:35:50', '2026-02-10 15:35:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('3', 'edit products', 'web', '2026-02-10 15:35:50', '2026-02-10 15:35:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('4', 'delete products', 'web', '2026-02-10 15:35:50', '2026-02-10 15:35:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('5', 'view users', 'web', '2026-02-10 15:35:50', '2026-02-10 15:35:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('6', 'create users', 'web', '2026-02-10 15:35:50', '2026-02-10 15:35:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('7', 'edit users', 'web', '2026-02-10 15:35:50', '2026-02-10 15:35:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('8', 'delete users', 'web', '2026-02-10 15:35:50', '2026-02-10 15:35:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('9', 'manage favorites', 'web', '2026-02-10 15:35:50', '2026-02-10 15:35:50');

-- --------------------------------------------------------
-- Data for table `roles`
-- --------------------------------------------------------

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('1', 'admin', 'web', '2026-02-10 15:35:50', '2026-02-10 15:35:50');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('2', 'client', 'web', '2026-02-10 15:35:50', '2026-02-10 15:35:50');

-- --------------------------------------------------------
-- Data for table `model_has_roles`
-- --------------------------------------------------------

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('1', 'App\Models\User', '1');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('2', 'App\Models\User', '2');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('2', 'App\Models\User', '3');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('2', 'App\Models\User', '4');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('2', 'App\Models\User', '5');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('2', 'App\Models\User', '6');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('2', 'App\Models\User', '7');

-- --------------------------------------------------------
-- Data for table `role_has_permissions`
-- --------------------------------------------------------

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('1', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('9', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('1', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('2', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('3', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('4', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('5', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('6', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('7', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('8', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('9', '1');

-- --------------------------------------------------------
-- Data for table `migrations`
-- --------------------------------------------------------

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '0001_01_01_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '0001_01_01_000001_create_cache_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '0001_01_01_000002_create_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2026_01_26_091857_create_categories_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2026_01_26_091857_create_products_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2026_02_02_113234_add_role_to_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2026_02_04_232054_create_favorites_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2026_02_10_134722_create_permission_tables', '2');

SET FOREIGN_KEY_CHECKS = 1;
