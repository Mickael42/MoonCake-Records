-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Oct 12, 2019 at 08:10 AM
-- Server version: 10.3.13-MariaDB-1:10.3.13+maria~bionic
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moon-cake-records`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `is_order` tinyint(1) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `total_amount`, `is_order`, `user_id`) VALUES
(100, 12, 1, NULL),
(101, 10, 1, NULL),
(102, 12, 1, NULL),
(103, 22, 1, NULL),
(104, 10, 1, NULL),
(105, 10, 1, NULL),
(106, 10, 1, NULL),
(107, 12, 1, NULL),
(108, 12, 1, NULL),
(109, 10, 1, NULL),
(110, 10, 1, NULL),
(111, 10, 1, NULL),
(112, 10, 1, NULL),
(113, 10, 1, NULL),
(116, 631, 0, NULL),
(124, 10, 1, NULL),
(126, 532, 0, NULL),
(128, 80, 1, 12),
(130, 70, 1, 12),
(131, 99, 1, 12),
(139, 169, 1, NULL),
(140, 10, 1, NULL),
(141, 70, 1, NULL),
(142, 10, 1, NULL),
(144, 258726, 0, NULL),
(150, 186, 1, NULL),
(151, 50, 1, NULL),
(156, 799, 0, NULL),
(174, 195, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress_complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `first_name`, `last_name`, `phone`, `email`, `adress`, `adress_complement`, `city`, `country`, `zip_code`, `user_id`) VALUES
(20, 'Zia', 'Erickson', 951679182, 'qutajaj@mailinator.com', 'Et irure voluptatem sint ratione incidunt facilis quia', 'Aliquip deleniti iste veniam et culpa qui at in magna aliqua Doloremque explicabo Illum aliqua Dolor do fugiat', 'Animi quia iusto ut iste modi laudantium commodi et', 'Placeat qui mollit dolorem beatae aliquip sunt quis vitae ut nemo sint corporis obcaecati', 24211, 8),
(21, 'Justine', 'Booth', 123456789, 'muhym@mailinator.com', 'Esse consequuntur est quo ab id eius reprehenderit totam officia voluptate facere', 'Voluptate amet vel laboriosam consequatur Cumque omnis recusandae Natus', 'Animi enim aliqua Quo nulla vel quo consequat Officia sunt vero', 'Voluptates fuga Optio ipsam sequi et voluptate elit voluptas dolorem aliquam et corporis minim quo fugit qui sit ea quaerat', 61819, NULL),
(23, 'Sade', 'Black', 123456789, 'kozogaho@mailinator.com', 'Sed eos enim labore similique commodi voluptas sunt harum in placeat aperiam reprehenderit similique', 'Veritatis facere alias iusto voluptatem ea libero distinctio Placeat quis magni adipisci blanditiis officiis natus', 'Sit ex labore quia unde sed ut illo itaque ut est', 'Numquam omnis lorem commodi sed deserunt laborum dolor elit elit aut commodi ut alias ipsum dolorem et', 11619, NULL),
(24, 'Camilla', 'English', 996565655, 'poqe@mailinator.com', 'Est ullam sed aute reprehenderit sunt ratione quam molestiae temporibus est commodo', 'Quia voluptatibus ipsa aut excepteur ipsam error aut ipsam dolor amet possimus rerum tenetur explicabo Labore laboriosam maiores repellendus Sint', 'Minim aspernatur qui quibusdam vero esse aute quisquam velit', 'Et libero consequatur sed est enim soluta', 35850, NULL),
(25, 'Leigh', 'Leonard', 123456789, 'jamodovutu@mailinator.com', 'Expedita iure in cupiditate hic', 'Molestiae eius reprehenderit ut nulla vitae et vel nihil repudiandae enim cillum', 'Impedit earum tenetur odit qui laboriosam voluptate amet in hic ipsa', 'Commodo corporis sint labore quia dolore', 58567, 9),
(26, 'Xenos', 'Glenn', 123456789, 'misalapah@mailinator.net', 'Vel asperiores sed duis accusantium qui sunt', 'Ea molestias necessitatibus aspernatur numquam modi esse eius ut', 'Dolore aut exercitationem earum rerum inventore qui ut nisi corrupti qui ratione laboriosam assumenda', 'Ab eu rerum dolor dolor quas optio eos ea velit voluptatum quia ut unde', 97580, NULL),
(27, 'Robert', 'Hood', 123456789, 'nysopobep@mailinator.net', 'Libero aliqua Magna earum do aut sequi voluptatem', 'Excepteur et in fugiat voluptas aperiam do est quisquam voluptate consequatur dolorem et similique maiores eum magna magnam dolorem quod', 'A tempor laborum temporibus assumenda soluta', 'Quis nostrud dolore et nostrum consequatur totam culpa in vel exercitationem commodo beatae', 97384, NULL),
(28, 'Xyla', 'Delacruz', 951679182, 'zucybulewu@mailinator.net', 'Est incididunt quae quo sit totam ipsam', 'Vitae sit sint eaque saepe laudantium animi pariatur Vitae ullam aute et', 'Sit et Nam accusantium perferendis nostrud voluptatum sit sed eos delectus ullamco corrupti', 'Nihil doloremque amet facere et mollitia amet error', 61382, NULL),
(29, 'Pascale', 'Cervantes', 123456789, 'xamevu@mailinator.net', 'Eum quo aut dolor non tempore voluptatem Nam et adipisci fuga In corporis', 'Est saepe et qui iure', 'Qui dolor in rem necessitatibus optio quia rerum irure qui aut dicta autem autem qui ut magna voluptas mollitia', 'Quia animi voluptas atque deserunt voluptatem ab fugit a', 19482, NULL),
(30, 'Joe', 'Dassin', 951679182, 'tomiceh@mailinator.com', 'Aut voluptatem Aliquam dolorem porro est rerum omnis minim et expedita blanditiis magni cupidatat accusantium', 'Et est velit animi velit sunt adipisicing aut ex quis quo', 'Duis soluta aut id a non ut in error ad quae voluptas', 'Consequuntur qui sit voluptatem quis molestiae aliquip', 73956, NULL),
(31, 'Iola', 'Vance', 951679182, 'rihihy@mailinator.net', 'Repellendus At deserunt corrupti voluptate qui Nam voluptas consequatur quia reprehenderit', 'Excepteur maxime repellendus Minim fuga Laboriosam id culpa inventore vitae consequatur consectetur et sunt voluptatibus et nesciunt enim earum et', 'Voluptate voluptate facilis voluptatum repudiandae ipsum aliquip rerum nesciunt eligendi ut ut qui voluptatem Proident ut officia dolores', 'Nostrum soluta voluptatem amet qui veniam dolorem eum ad inventore et non maxime aut vitae laboris expedita eos voluptates enim', 92056, NULL),
(32, 'Rana', 'Craig', 951679182, 'tivej@mailinator.net', 'Fugit iusto voluptate labore exercitationem debitis duis', 'Quos dolorum alias est quam dolores ullamco nostrud voluptatem officia aliquam optio qui aute iste ea', 'Voluptas velit sed consectetur anim ipsum harum et esse dolore commodo vel dicta duis et ipsum esse reprehenderit qui', 'Totam molestiae dolor iusto quia et aliquam non inventore modi omnis quod adipisicing nihil eos provident nisi magni ut ullamco', 41612, NULL),
(33, 'Darrel', 'Luna', 951679182, 'cumu@mailinator.net', 'Rerum eu ut in est ut voluptatem odit', 'Dolor vero minus animi eum et pariatur Accusamus et suscipit', 'Iure velit eos quo dolore quibusdam reiciendis', 'Voluptates id ipsum cupiditate perferendis veniam est consequatur qui', 14458, NULL),
(34, 'Harper', 'Rasmussen', 951679182, 'naha@mailinator.com', 'Perspiciatis veniam et incidunt quia et enim', 'Id dolor quas dolorem esse esse ea consequuntur architecto rerum', 'Culpa in in molestiae cum', 'Deserunt omnis vero consequatur Pariatur Illum ut hic mollit nostrud adipisicing', 26159, NULL),
(35, 'Blossom', 'Steele', 951679182, 'hydifamab@mailinator.com', 'Atque eos cumque aliquam ratione neque deserunt', 'Harum sunt quis ea esse ipsum culpa qui exercitationem et cupidatat do cillum sint', 'Vel est illum consequatur nostrud voluptas omnis et aperiam ullamco dolorum magnam', 'Atque commodo minus exercitation optio lorem laborum magnam fugiat', 16288, NULL),
(36, 'Sybil', 'Aguilar', 1234567891, 'pativydanu@mailinator.com', 'Rerum et est nihil deleniti voluptatem aut voluptatum ea consequat Iure ut omnis quos natus magna atque', 'Aspernatur facere architecto voluptate velit delectus est sed dolorem in illo iusto sequi', 'Est voluptatem autem dolor voluptatem Vel ullamco qui ut aliquam qui cumque dolore vero', 'Sed molestiae veniam voluptate magni enim dicta fuga Irure dolores facere', 61765, NULL),
(38, 'Nathaniel', 'Reid', 123456789, 'teqoqe@mailinator.com', 'Reprehenderit asperiores totam consequatur nostrud ex vel id', 'Sed harum adipisicing omnis est commodo in consequatur lorem qui possimus eum autem ea voluptatem In sapiente eos do dolore', 'Et molestiae dolor magna odio aspernatur debitis dolor cillum', 'Beatae ut excepturi eum quae laboriosam in vero ut elit nihil fuga Velit qui labore qui ex', 52281, NULL),
(39, 'Juliet', 'Mercer', 951679182, 'safecigo@mailinator.com', 'Quam vel omnis architecto autem esse fugiat esse in quae fugiat', 'Irure iste nisi anim doloribus veniam', 'Sapiente libero perferendis eaque placeat', 'Molestiae quia officiis ipsam voluptate debitis eveniet consequatur omnis labore vel aliquip', 25963, NULL),
(40, 'Lyle', 'Blevins', 951679182, 'bobes@mailinator.net', 'Incididunt dolor veritatis voluptas dicta recusandae Possimus totam harum et vitae quibusdam', 'Eveniet iste iste rerum aut deserunt non doloribus ipsum nostrud pariatur Repellendus Vero perferendis dolor commodi ut', 'In neque culpa voluptas sint in iste', 'Id magni sunt consequatur voluptatem Quis qui natus sint dolorem id eos unde recusandae Vero aut quo minus', 52461, NULL),
(41, 'Melinda', 'Mcdowell', 951679182, 'vuki@mailinator.net', 'Consequatur fuga Consequat Quod odio esse iure lorem aliquam', 'Consequuntur tempor mollitia maxime laudantium rerum eligendi sit nostrum adipisci nemo ratione nisi deleniti', 'Excepturi laboris obcaecati ex minus reiciendis officia nobis facere duis tempora labore in incididunt eaque', 'In nostrum quibusdam nihil non sit magni eu voluptates iure vel nisi voluptates voluptas', 16448, NULL),
(42, 'Drake', 'Burks', 954545454, 'jywu@mailinator.com', 'Consectetur nihil ad laboris quam incidunt eligendi hic dolores et tenetur pariatur Ea ut et esse reiciendis', 'Voluptate enim labore hic nostrud dolores illum omnis molestias in tempor eos dignissimos', 'Voluptatem incididunt in aut sint voluptates ipsum est ad quis aliquip ullamco', 'JM', 43911, NULL),
(43, 'Provençal', 'Le Gaullois', 932454345, 'micka@gmail.com', 'Dolorem voluptas facilis tempore possimus in quia nesciunt non in illum nesciunt dolorem quasi perspiciatis est', 'Officiis animi aliquam est vero quas et assumenda et repellendus Hic porro ullam obcaecati necessitatibus commodo rerum omnis rerum', 'Eum et laboriosam vel minim explicabo Qui assumenda', 'IS', 20619, 12),
(46, 'Jeanne', 'La tourette', 953454343, 'jeanne@gmail.com', '6 rue de la tourette', NULL, 'Saint Héand', 'AQ', 42000, NULL),
(47, 'Melyssa', 'WIKi', 951232324, 'jeanne@gmail.com', 'Voluptatem ipsam eos adipisci commodo dolor consequatur Velit a amet debitis consequuntur tempora voluptatem nostrud nisi', 'Occaecat laborum Natus id sit tempore', 'Doloremque velit numquam corporis rem perferendis rem est sed facilis architecto error magna provident illo', 'AX', 91263, 13),
(48, 'Amery', 'Blankenship', 981679142, 'ciwyki@mailinator.net', 'In vel voluptatem ea quia suscipit a', 'Impedit hic vero recusandae Pariatur Doloribus', 'Ad amet debitis aut deserunt quibusdam ut sit qui recusandae Eum provident asperiores alias natus esse', 'PR', 28652, NULL),
(50, 'Howard', 'Rios', 951679180, 'jecukasa@mailinator.net', 'Ut est similique tempor non quo vitae cum ut', 'Et sequi nihil nesciunt labore iure ipsa et neque ex facere maiores eos fugit ad magna', 'Corrupti dolor accusamus amet vel', 'PA', 73768, NULL),
(51, 'vdddd', 'Turner', 1010101009, 'guro@mailinator.com', 'Et corporis voluptatem omnis veritatis sit sit et', 'Possimus nemo dolor sint libero magna ad voluptatem Dolorum nobis corporis quas dolore tempora eius est ut et lorem', 'Eveniet elit voluptatem autem enim culpa quis tempor quos consequatur irure doloremque qui', 'SM', 96057, NULL),
(53, 'Igor', 'Elliott', 1234567890, 'gogoros@mailinator.com', 'Voluptates nulla ut adipisci nulla commodo perferendis corrupti non et ipsum qui eiusmod', 'Voluptas sequi quis aliquam officia veniam consequat Amet perferendis dolor aut', 'Autem ad sunt necessitatibus temporibus dolores veniam obcaecati natus saepe adipisicing veniam et amet Nam aut odio', 'FO', 25150, NULL),
(54, 'Eden', 'Cruz', 1234567890, 'coca@mailinator.net', 'Tempore aute in odit velit amet reprehenderit Nam eum eu ea molestias incidunt reiciendis dolorum tempor nisi est animi eveniet', 'Odio consequuntur iste reprehenderit autem amet voluptate dolores delectus voluptas id animi at quas sunt et et', 'Magna ab a qui et non eos quia vero vel quod voluptate tempore et', 'YE', 54793, NULL),
(55, 'William', 'Holmes', 1234567887, 'huxyhiqaka@mailinator.com', 'Enim aut sint aliqua Hic mollitia sed tempora totam et est ad temporibus', 'Ipsum recusandae Repudiandae facere mollitia omnis reiciendis ea nemo necessitatibus maxime quam fugiat voluptas quis nostrud enim voluptas', 'Eu quo maiores iusto aut', 'SE', 52740, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Electro'),
(2, 'Soul'),
(3, 'Funk'),
(4, 'House'),
(5, 'Techno'),
(6, 'Reggae'),
(7, 'Hip-Hop'),
(8, 'Rock'),
(9, 'Classique');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190912074908', '2019-09-12 07:50:39'),
('20190912081931', '2019-09-12 08:19:42'),
('20190912082402', '2019-09-12 08:24:48'),
('20190912090237', '2019-09-12 09:02:50'),
('20190912090848', '2019-09-12 09:09:02'),
('20190912091640', '2019-09-12 09:16:47'),
('20190912091943', '2019-09-12 09:19:50'),
('20190912093424', '2019-09-12 09:34:31'),
('20190912130028', '2019-09-12 13:00:45'),
('20190915161323', '2019-09-15 16:13:49'),
('20190916154828', '2019-09-16 15:48:51'),
('20190916171215', '2019-09-16 17:12:36'),
('20190916201322', '2019-09-16 20:13:41'),
('20190919141152', '2019-09-19 14:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `cart_id`, `payment_method`, `order_date`, `status`, `total_amount`, `user_id`) VALUES
(9, 27, 100, 'unknow', '2019-09-17 10:06:15', 'unpaid', 12, NULL),
(10, 28, 101, 'unknow', '2019-09-17 12:01:16', 'unpaid', 10, NULL),
(11, 29, 102, 'unknow', '2019-09-17 12:04:04', 'unpaid', 12, NULL),
(12, 30, 103, 'unknow', '2019-09-17 12:11:28', 'unpaid', 22, NULL),
(13, 31, 104, 'unknow', '2019-09-17 12:20:26', 'unpaid', 10, NULL),
(14, 32, 105, 'unknow', '2019-09-17 12:24:47', 'unpaid', 10, NULL),
(15, 33, 106, 'unknow', '2019-09-17 12:27:28', 'unpaid', 10, NULL),
(16, 34, 107, 'unknow', '2019-09-17 12:29:22', 'unpaid', 12, NULL),
(17, 35, 108, 'unknow', '2019-09-17 12:31:01', 'unpaid', 12, NULL),
(18, 36, 109, 'unknow', '2019-09-17 12:37:26', 'unpaid', 10, NULL),
(20, 38, 110, 'unknow', '2019-09-17 12:54:58', 'unpaid', 10, NULL),
(21, 39, 111, 'unknow', '2019-09-17 14:34:04', 'unpaid', 10, NULL),
(22, 40, 112, 'unknow', '2019-09-17 15:11:51', 'unpaid', 10, NULL),
(23, 41, 113, 'unknow', '2019-09-17 15:51:59', 'unpaid', 10, NULL),
(24, 42, 124, 'unknow', '2019-09-19 11:21:53', 'unpaid', 10, NULL),
(25, 43, 128, 'unknow', '2019-09-19 13:57:59', 'unpaid', 80, NULL),
(26, 43, 130, 'unknow', '2019-09-19 14:34:45', 'unpaid', 70, 12),
(27, 43, 131, 'unknow', '2019-09-19 14:35:06', 'unpaid', 99, 12),
(28, 48, 139, 'unknow', '2019-09-28 15:34:28', 'unpaid', 169, NULL),
(30, 50, 140, 'unknow', '2019-09-28 15:50:16', 'unpaid', 10, NULL),
(31, 51, 141, 'unknow', '2019-09-28 16:31:09', 'unpaid', 70, NULL),
(33, 53, 142, 'unknow', '2019-09-28 16:37:51', 'unpaid', 10, NULL),
(34, 54, 150, 'unknow', '2019-09-29 09:04:25', 'unpaid', 186, NULL),
(35, 55, 151, 'unknow', '2019-09-29 09:12:36', 'unpaid', 50, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `vinyl_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `vinyl_id`, `cart_id`, `price`, `quantity`) VALUES
(246, 24, 174, 27, 3),
(249, 17, 174, 81, 27);

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `id` int(11) NOT NULL,
  `vinyl_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`id`, `vinyl_id`, `name`, `duration`, `position`) VALUES
(12, 16, 'Make Me Baby', 300, 'A1'),
(13, 16, 'Year Of The Dragon', 500, 'A2'),
(14, 16, 'Feelin Me', 600, 'B1'),
(15, 16, 'Don\'t Shower', 300, 'B2'),
(16, 17, 'The Score Lucky Loociano Mix', 545, 'A1'),
(17, 17, 'The Score Radio Edit', 354, 'A2'),
(18, 17, 'The Score Extended Version', 545, 'B1'),
(19, 17, 'The Score Boonanza Mix', 345, 'B2'),
(20, 18, 'Trust Is Key', 540, 'A1'),
(21, 18, 'Observe', 449, 'A2'),
(22, 18, 'Midnight In Peckham', 701, 'B1'),
(23, 18, 'Luxury Motivation', 548, 'B2'),
(24, 19, 'Like It Is', 555, 'A1'),
(25, 19, 'Nigerian Affair', 653, 'A2'),
(26, 19, 'Long Night Ahead', 712, 'B1'),
(27, 19, 'Pajama Stomp', 631, 'B2'),
(28, 20, 'Just Deep', 345, 'A1'),
(29, 20, '4U', 456, 'B1'),
(30, 20, 'Ambient', 567, 'B2'),
(31, 21, 'Symphony (Hurley\'s Symphonic Soul Mix)', 603, 'A1'),
(32, 21, 'Symphony (Original Symphony)', 410, 'A2'),
(33, 21, 'Symphony (Symphony In E Smoove)', 630, 'B1'),
(34, 21, 'Symphony (Maurice\'s Underground Movement)', 706, 'B2'),
(35, 22, 'The Genesis', 145, 'A1'),
(36, 22, 'N.Y. State Of Mind', 453, 'A2'),
(37, 22, 'Life\'s A Bitch', 330, 'A3'),
(38, 22, 'The World Is Yours', 450, 'A3'),
(39, 22, 'Halftime', 420, 'A5'),
(40, 22, 'Memory Lane (Sittin\' In Da Park)', 408, 'B1'),
(41, 22, 'One Love', 525, 'B2'),
(42, 22, 'One Time 4 Your Mind', 318, 'B3'),
(43, 22, 'Represent', 412, 'B4'),
(44, 22, 'It Ain\'t Hard To Tell', 322, 'B5'),
(45, 23, 'Rose Rouge', 656, 'A1'),
(46, 23, 'Montego Bay Spleen', 626, 'A2'),
(47, 23, 'So Flute', 828, 'B3'),
(48, 23, 'La Goutte D\'Or', 619, 'B4'),
(49, 23, 'Sure Thing', 620, 'C5'),
(50, 23, 'Ponts Des Arts', 726, 'C6'),
(51, 23, 'Latin Note', 555, 'D7'),
(52, 23, 'Land Of...', 747, 'D8'),
(53, 23, 'What You Think About...', 448, 'D9'),
(54, 24, 'You Got The Love (Erens Bootleg Mix)', 711, 'A'),
(55, 24, 'You Got The Love (Morning Time Mix)', 754, 'B'),
(56, 25, 'Love Comes At Ya', 532, 'A'),
(57, 25, 'The Sound Of Music', 533, 'Dayton'),
(58, 26, 'Domina (Maurizio Mix)', 1313, 'A'),
(59, 26, 'Solid Sleep (Jeff Mils)', 347, 'B1'),
(60, 26, 'Ten Four (Joey Beltram)', 454, 'B2'),
(61, 26, 'The Rhythm of Vision (Robert Hood)', 515, 'C1'),
(62, 26, 'Science Fiction (Daniel Bell)', 511, 'C2'),
(63, 26, 'Allerseelen (DJ Hell/ Jeff Mills remix)', 529, 'D1'),
(64, 26, 'Energizer (Blake Baxter)', 357, 'D2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `admin`, `user_name`) VALUES
(8, 'test@test.fr', '$2y$13$5Z1G3hCfJAtkFzFiXBCsbemCsltw5W3ZCrkN/07dVWH5a7xlLBNQq', 0, 'neqowy'),
(9, 'admin@mooncake.com', '$2y$13$vpn07UQM34uoBOMCHx34puxNpq/6w58yUpuBPE/8BiPxcLAVK36ka', 1, 'micka'),
(10, 'sojyquj@mailinator.net', '$2y$13$4eArP3DVghkH7y3F/a222OLSLvnyAnOlbjNrry6bfLUGginpLNHtK', 0, 'd'),
(11, 'mybyh@mailinator.net', '$2y$13$AtmRBmtemH8gz7FMYPO7HugBE2gH5IVeLesIqJZmJ9jVCR0QMgobq', 0, 'we'),
(12, 'micka@gmail.com', '$2y$13$0UlcVk7fy3sDYIyxxQTx.uApBHizEKKPyPfCHheCOGUygenL8sB.m', 0, 'mick'),
(13, 'jeanne@gmail.com', '$2y$13$GWRvuRdMPAuciNun95Cove1wVCdBg/fIvKwspsRY8Gyko3DMkYewG', 0, 'jeanne'),
(14, 'testPanier@gmail.com', '$2y$13$6M4aOQT/2/ZC.d6eFHo8Ge4HO0etXxNaMft3IbHi3Oi/hglKMWIi.', 0, 'sefunyripy');

-- --------------------------------------------------------

--
-- Table structure for table `vinyl`
--

CREATE TABLE `vinyl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artiste` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `media_condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sleeve_condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_stock` int(11) NOT NULL,
  `regular_price` int(11) NOT NULL,
  `reduce_price` int(11) DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vinyl`
--

INSERT INTO `vinyl` (`id`, `name`, `artiste`, `label`, `cat_num`, `format`, `country`, `year`, `media_condition`, `sleeve_condition`, `quantity_stock`, `regular_price`, `reduce_price`, `cover`, `description`, `genre_id`) VALUES
(16, 'Pipa Traxxx Vol. 1', 'B-Squit', 'Pipa Records', 'PIPA001', '12\"', 'HU', 2017, 'Mint', 'Mint', 20, 10, 8, 'assets/img/Covers/pipa-5d9cdeb906753.jpeg', NULL, 4),
(17, 'The Score', 'Boons', 'Virgin Records Ltd', 'none', '12\", 45 RPM, Maxi-Single, Promo', 'GB', 2000, 'Très bien (VG+)', 'Très bien (VG+)', 20, 5, 3, 'assets/img/Covers/boons-5d9ce1d85fb19.jpeg', NULL, 1),
(18, 'Midnight In Peckham', 'Chaos In The CBD', 'Rhythm Section International', 'RS008', '12\", 33 ⅓ RPM, EP', 'GB', 2015, 'Mint', 'Mint', 10, 15, NULL, 'assets/img/Covers/chaosincbd-5d9ce23229dba.jpeg', NULL, 4),
(19, 'Disco Volante EP', 'COEO', 'Razor N Tape Reserve', 'RNTR015', '12\", 33 ⅓ RPM, EP, Green', 'US', 2016, 'Mint', 'Mint', 5, 15, 10, 'assets/img/Covers/coeo-5d9ce2e0e5d81.jpeg', 'Un must have pour tous les fans de house !', 4),
(20, 'Just Deep', 'Deep Walker', 'Noise Records (5)', 'NOISE 747-10', '12\"', 'BE', 1994, 'Bien (VG)', 'Bien (G)', 3, 5, NULL, 'assets/img/Covers/deepwalker-5d9ce43660488.jpeg', NULL, 4),
(21, 'Symphony', 'Donell Rush', 'ID Records', '658797 6', '12\", 33 ⅓ RPM, Single', 'GB', 1992, 'Très bien (VG+)', 'Bien (G)', 6, 5, 3, 'assets/img/Covers/donellrush-5d9ce4f12dc09.jpeg', NULL, 4),
(22, 'Illmatic', 'Nas', 'Get On Down', 'GET 51297 LP', '12\", LP, Album', 'US', 1994, 'Excellent (M)', 'Excellent (M)', 2, 25, 22, 'assets/img/Covers/nas-5d9ce5f559043.jpeg', NULL, 7),
(23, 'Tourist', 'St Germain', 'Parlophone', '5099963622010', '2 × Vinyl, 12\", Album, Reissue, Remastered, 180gram, Gatefold', 'FR', 2001, 'Excellent (M)', 'Excellent (M)', 10, 29, NULL, 'assets/img/Covers/stgermain-5d9ce732d8f5f.jpeg', NULL, 1),
(24, 'You Got The Love (Erens Bootleg Mix)', 'The Source Featuring Candi Staton', 'ZYX Records', 'ZYX 6468-12', '12\", 45 RPM', 'DE', 1990, 'Bien (VG)', 'Bien (VG)', 3, 9, NULL, 'assets/img/Covers/love-5d9ce8e769db7.jpeg', NULL, 1),
(25, 'Love Comes At Ya / The Sound Of Music', 'Melba Moore / Dayton ‎', 'Dance Classics', 'MM 711', '12\", 33 ⅓ RPM, Unofficial Release', 'US', 1983, 'Bien (VG)', 'Bien (VG)', 1, 80, NULL, 'assets/img/Covers/lovecomesatya-5d9ce9ba78882.jpeg', NULL, 3),
(26, 'Tresor III Compilation', 'Various', 'Tresor', 'Tresor 97', '2 × Vinyl, 12\", Compilation', 'DE', 2000, 'Bien (VG)', 'Bien (G)', 5, 15, 10, 'assets/img/Covers/tresor-5d9ceb2dc175f.jpeg', NULL, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BA388B7A76ED395` (`user_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C7440455A76ED395` (`user_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E52FFDEE1AD5CDBF` (`cart_id`),
  ADD KEY `IDX_E52FFDEE19EB6921` (`client_id`),
  ADD KEY `IDX_E52FFDEEA76ED395` (`user_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2530ADE63FFFF645` (`vinyl_id`),
  ADD KEY `IDX_2530ADE61AD5CDBF` (`cart_id`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D6E3F8A63FFFF645` (`vinyl_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vinyl`
--
ALTER TABLE `vinyl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E2E531D4296D31F` (`genre_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vinyl`
--
ALTER TABLE `vinyl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_C7440455A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_E52FFDEE19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_E52FFDEE1AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_E52FFDEEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `FK_2530ADE61AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_2530ADE63FFFF645` FOREIGN KEY (`vinyl_id`) REFERENCES `vinyl` (`id`);

--
-- Constraints for table `track`
--
ALTER TABLE `track`
  ADD CONSTRAINT `FK_D6E3F8A63FFFF645` FOREIGN KEY (`vinyl_id`) REFERENCES `vinyl` (`id`);

--
-- Constraints for table `vinyl`
--
ALTER TABLE `vinyl`
  ADD CONSTRAINT `FK_E2E531D4296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
