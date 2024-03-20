-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 07:21 AM
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
-- Database: `bookly`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `user_id`, `name`, `price`, `image`, `pid`) VALUES
(65, 11, 'Realizee', 0, 'aa.jpg', 31),
(66, 11, 'Living in the Light', 0, 'a.jpg', 32),
(67, 11, 'The Letter', 0, 'the-letter-bradley-pearce-obooko.jpg', 40),
(68, 8, 'Realizee', 0, 'aa.jpg', 31),
(69, 14, 'Realizee', 0, 'aa.jpg', 31),
(70, 13, 'Resisting Happiness', 0, 'aa.jpg', 31);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_id` int(15) NOT NULL,
  `description` varchar(600) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `isbn` int(30) NOT NULL,
  `category_id` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `shows` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `author_id`, `description`, `publisher`, `isbn`, `category_id`, `cover`, `file`, `shows`, `status`) VALUES
(31, 'Resisting Happiness', 'author', 3, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit in consequatur reprehenderit harum sequi laudantium alias voluptatum, nobis ab ad aliquam quos tempora ex reiciendis.                                                                                            ', 'Akash Publication', 2147483647, 1, 'aa.jpg', 'Resisting Happiness.pdf', 0, 1),
(32, 'Living in the Light', 'author', 3, 'Living in the Light: A guide to personal transformation                                                                                                                        ', 'Akash Publication', 2147483647, 1, 'a.jpg', 'a.pdf', 1, 1),
(40, 'The Letter', 'Bradley Pearce', 1, 'From Capri to Timbuktu the adventure picks up where The Ring leaves off. With the discovery of an ancient parchment. Buried for some two thousand years in some far away desolate land. The final words of a condemned man. Beseeching reconciliation between J', 'Bradley Pearce Pub', 2147483647, 1, 'the-letter-bradley-pearce-obooko.jpg', 'the-letter-bradley-pearce-obooko.pdf', 1, 1),
(41, 'The Gilgamesh Project Book V Cuba', 'John Francis Kinsella', 1, 'Arkady Demitriev had been a young boy when the Soviet Union had been dissolved by Mikhail Gorbachev and had just enrolled as a student at Moscow State University when Vladimir Putin was elected president of the Russian Federation.\r\n\r\nDemitriev was far rem', 'Banksterbooks', 2147483647, 1, 'the-gilgamesh-project-book.jpg', 'the-gilgamesh-project-book-v-cuba-obooko.pdf', 1, 1),
(42, 'The Legacy of Solomon', 'John Francis Kinsella', 1, 'From Capri to Timbuktu the adventure picks up where The Ring leaves off. With the discovery of an ancient parchment. Buried for some two thousand years in some far away desolate land. The final words of a condemned man. Beseeching reconciliation between J                                                                                ', 'Banksterbooks', 2147483647, 1, 'the-legacy-of-solomon-kinsella.jpg', 'the-legacy-of-solomon-obooko.pdf', 1, 1),
(43, 'Natural Born Proud', 'S. R. Martin Jr.', 1, 'A young man from Monterey and his younger brother go on their first deer hunt with their minister father and his friends. The setting is 1950s northern California, in country where, from the right height, one can see Mt. Shasta in one direction, Mt. Lassen in the other', 'All USU Press Publications', 2147483647, 34, 'natural-born-proud-black.jpg', 'natural-born-proud-black-fiction-obooko.pdf', 1, 1),
(44, 'The Legacy of Solomon', 'dasds', 3, 'xyz                                        ', 'Banksterbooks', 2147483647, 30, 'the-legacy-of-solomon-kinsella.jpg', 'the-legacy-of-solomon-obooko.pdf', 1, 1),
(46, 'Sophie, Rice and Fish', 'author', 3, 'He quits his job, stuffs a few clothes and some personal items into an old navy duffel bag, sends all of his other possessions to the bin or the charity shop and books a one-way ticket to Portugal.                    ', 'OBOOKO Publication', 2147483647, 39, 'sophie-rice-fish-mark-hill.jpg', 'Sophie-Rice-Fish-obooko-trav0078.pdf', 1, 1),
(47, 'Mike Australia', 'Mike Dixon', 1, 'Some call it the world is smallest continent. Others say it is the world is largest island. Either way, Australia is BIG. The distance from Perth to Cairns is about 3,500 km (2,000 miles), which is roughly the same as Gibraltar to St Petersburg, Vancouver to New Orleans or Tokyo to Hanoi.', 'Pavan Publication', 2147483647, 39, 'mikes-australia-travel-mike-dixon.jpg', 'MikesAustralia-obooko-trav0072.pdf', 1, 1),
(48, 'Better Ways to Stay Healthy in Asian Tropics', 'Bryan Walker and Kalpana Patel', 1, 'Better Ways to Stay Healthy in Asian Tropics - with special reference to Sri Lanka.\r\nThe advice in this booklet is written with particular reference to Sri Lanka but will help visitors to anywhere in the Asian tropics to stay healthy by adhering to simple guidelines.\r\nHumanitarian organisations may like to add this booklet to the briefing pack of those planning a visit to tropical Asia to optimise the efficiency of their teams.', 'OBOOKO Publication', 2147483647, 39, 'healthy-in-asian-tropics-walker.jpg', 'AsianTropics-obooko-trav0076.pdf', 1, 1),
(49, 'Picking Up The Pieces: The Caldar Chronicles Book Eight', 'Floyde Leong', 1, 'Rondal Caldar was was officially dead - so he did been sent to Earth to help him stay dead.\r\n\r\nKeeping quiet while living a simple life back home was the plan, but circumstances on Earth threaten to expose him to the wrath of the Council of Elders if he can not keep his nose clean.', 'OBOOKO Publication', 2147483647, 30, 'picking-up-the-pieces-cd8ca5928bdf2376583476a6c203a463.jpg', 'picking-up-the-pieces-obooko.pdf', 1, 1),
(50, 'An Unfortunate Decision: The Caldar Chronicles Book Seven', 'Floyde Leong', 1, 'Lord Rondal Caldar, the Commonwealth Emperor is First Sword, discovered a new alien species that had been monitoring and interfering with human activities for their own protection...', 'OBOOKO Publication', 2147483647, 30, 'an-unfortunate-decision-ef72bf03efb28a5ad3c4d1aec47a9c58.jpg', 'an-unfortunate-decision-obooko.pdf', 1, 1),
(51, 'The End of The Road: The Caldar Chronicles Book Six', 'Floyde Leong', 1, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit in consequatur reprehenderit harum sequi laudantium alias voluptatum, nobis ab ad aliquam quos tempora ex reiciendis.', 'OBOOKO Publication', 2147483647, 30, 'the-end-of-the-road-384e238417f935b6da7c0d583367b08d.jpg', 'the-end-of-the-road-obooko.pdf', 1, 1),
(52, 'Unhide The Past: The Caldar Chronicles Book Five', 'Floyde Leong', 1, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit in consequatur reprehenderit harum sequi laudantium alias voluptatum, nobis ab ad aliquam quos tempora ex reiciendis.', 'OBOOKO Publication', 2147483647, 30, 'unhide-the-past-44608483af015a17beee136fa0a03c29.jpg', 'unhide-the-past-obooko.pdf', 1, 1),
(53, 'Britannia', 'Letitia Coyne', 1, 'Lucius, Luc, is commander of an auxiliary cavalry unit of Legio XX, Valeria Victrix. The son of a Caledonian mercenary who joined Rome, he and his four brothers are renowned soldiers of great ability and bravery. At 25 he has served ten years, is looking at another fifteen, and has had enough of killing.', 'OBOOKO Publication', 2147483647, 37, 'britannia-coyne.jpg', 'BRITANNIA-obooko_rom0077.pdf', 1, 1),
(54, 'Silly Little Sisters', 'Anne Hauden', 1, 'An old, impecunious nobleman lives with his family in his shambles of a country castle, and to make good his failed finances, means to marry off his eldest daughter to a wealthy but disreputable rake – who, on visiting to meet his intended, immediately exercises his roving eye. The trouble is, he also comes with a loaded past that reflects very luridly on his present and has a cynical family of his own.', 'OBOOKO Publication', 2147483647, 37, 'silly-little-sisters-historical-obooko-ebook-21a1f87d5765d85f2b7872fca2be5661.jpg', 'silly-little-sisters-hauden-obooko.pdf', 1, 1),
(55, 'Leftovers', 'John C Nash', 1, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit in consequatur reprehenderit harum sequi laudantium alias voluptatum, nobis ab ad aliquam quos tempora ex reiciendis.', 'OBOOKO Publication', 2147483647, 37, 'leftovers-nash-ebook-294e4833047c60f87ba2f6113093c934.jpg', 'leftovers-nash-obooko.pdf', 1, 1),
(56, 'Myself a Phoenix', 'John C Nash', 1, 'You could say I was reborn with a bang. That bang was the explosion of a parachute mine in a street not too far from the British Museum, which also got hit that night. ...', 'OBOOKO Publication', 2147483647, 37, 'myself-a-phoenix-john-nash-obooko-ebook-e6de72088c9ef871104fc574551734f4.jpg', 'myself-a-phoenix-john-nash-obooko.pdf', 1, 1),
(57, 'Tales of Murder, Mystery & Suspense Vol 1', 'Will Lankstead', 1, 'A Collection of eight short stories about Murder, Mystery and Suspense. Such titles include: Small Talk, Little Jimmy Slater, Nice Work if you can get it!, Sara, the Underpass.', 'OBOOKO Publication', 2147483647, 32, 'tales-mystery-suspense-lankstead.jpg', 'TalesofMMS1-obooko-shortc0076.pdf', 1, 1),
(58, 'The Bell Rock Mystery', 'Neil Wesson', 1, 'In this mystery novel, a female Police Constable is sorting through archives at modern day New Scotland Yard in England, when she finds comes across a series of case notes, the facts of which were never made public ...', 'OBOOKO Publication', 2147483647, 32, 'bellrock-wesson.jpg', 'BellRock-obooko-thr0030.pdf', 1, 1),
(59, 'Marley Was Dead: A Christmas Carol Mystery', 'Lenny Everson', 1, 'Recently retired, he now has the time to search through a cold and grimy mid-Victorian London in search of the truth. First, he must establish that the death was no accident. Then, starting with Ebenezer Scrooge, he checks out suspects.', 'OBOOKO Publication', 2147483647, 32, 'marley-was-dead-everson.jpg', 'Marley-Was-Dead-obooko-per0058.pdf', 1, 1),
(60, 'Resident Skeptic -- RELIGION', 'James R Cowles', 1, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit in consequatur reprehenderit harum sequi laudantium alias voluptatum, nobis ab ad aliquam quos tempora ex reiciendis.', 'OBOOKO Publication', 2147483647, 32, 'resident-skeptic-religion-5f0199036347277b6e016cc5652fb50d.jpg', 'resident-skeptic-religion-cowles-obooko.pdf', 1, 1),
(61, 'A Deeper Look', 'David Butterworth', 1, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit in consequatur reprehenderit harum sequi laudantium alias voluptatum, nobis ab ad aliquam quos tempora ex reiciendis.', 'OBOOKO Publication', 2147483647, 32, 'lbo-series-a-deeper-look-obooko-8204b21e970d40722f62e7d5b30bb38b.jpg', 'lbo-series-a-deeper-look-obooko.pdf', 1, 1),
(62, 'Demo', 'author', 3, 'Demo                    ', 'Demo', 12233333, 44, 'lbo-series-a-deeper-look-obooko-8204b21e970d40722f62e7d5b30bb38b.jpg', 'lbo-series-a-deeper-look-obooko.pdf', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `editor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `editor`) VALUES
(1, 'Action & Adventure', 'author'),
(30, 'Fiction', 'admin'),
(31, 'Non-Fiction', 'admin'),
(32, 'Mystery', 'admin'),
(33, 'Romance', 'admin'),
(34, 'Biography', 'admin'),
(35, 'Science', 'admin'),
(36, 'Fantasy', 'admin'),
(37, 'History', 'admin'),
(38, 'Horror', 'admin'),
(39, 'Travel', 'admin'),
(40, 'Poetry', 'admin'),
(41, 'Business', 'admin'),
(42, 'Self-help', 'admin'),
(43, 'Religion', 'admin'),
(44, 'Art', 'admin'),
(45, 'Cookbooks', 'admin'),
(46, 'Sports', 'admin'),
(47, 'Psychology', 'admin'),
(48, 'Philosophy', 'admin'),
(49, 'Childrens', 'admin'),
(50, 'Novel', 'author '),
(51, 'Sci-fi', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` int(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` int(10) NOT NULL,
  `expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `email`, `code`, `expire`) VALUES
(1, 'maganmoji0505@gmail.com', 82258, 0),
(2, 'maganmoji0505@gmail.com', 40181, 0),
(3, 'maganmoji0505@gmail.com', 90684, 0),
(4, 'maganmoji0505@gmail.com', 30468, 0),
(5, 'maganmoji0505@gmail.com', 60908, 0),
(6, 'maganmoji0505@gmail.com', 73817, 0),
(7, 'maganmoji0505@gmail.com', 76711, 0),
(8, 'maganmoji0505@gmail.com', 30516, 1682230146),
(9, 'maganmoji0505@gmail.com', 67959, 1682239895),
(10, 'maganmoji0505@gmail.com', 96484, 1682240148),
(11, 'maganmoji0505@gmail.com', 78282, 1682249046),
(12, 'maganmoji0505@gmail.com', 42266, 1682435163),
(13, 'maganmoji0505@gmail.com', 52806, 1682435264),
(14, 'maganmoji0505@gmail.com', 42265, 1682435634),
(15, 'maganmoji0505@gmail.com', 17605, 1682436258),
(16, 'maganmoji0505@gmail.com', 93583, 1682436466),
(17, 'dhdiyora1512@gmail.com', 51757, 1682606355),
(18, 'dhdiyora1512@gmail.com', 32221, 1682606452),
(19, 'dhdiyora1512@gmail.com', 37258, 1682606562),
(20, 'myownspace1512@gmail.com', 34845, 1682663212),
(21, 'myownspace1512@gmail.com', 78349, 1682664009),
(22, 'myownspace1512@gmail.com', 71758, 1682664015);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(11, 0, 'Emerson Tran', 'gyxymi@mailinator.com', '1234567890', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, vitae pariatur ipsam repellat quos, eveniet vero voluptas tempore ipsa saepe, placeat excepturi sapiente atque molestias!'),
(12, 1, 'Kelsey Jacobs', 'mesygu@mailinator.com', '1234567890', 'Est pjkjkldsjksd ushdjdshas jdgj gs');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `id` int(11) NOT NULL,
  `userName` tinytext NOT NULL,
  `userReview` tinytext NOT NULL,
  `userMessage` longtext NOT NULL,
  `dateReviewed` tinytext NOT NULL,
  `pid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `userName`, `userReview`, `userMessage`, `dateReviewed`, `pid`) VALUES
(18, 'Bright', '4', 'this is ok', 'Monday, July 6, 2020', 31),
(19, 'Linda', '5', 'this is amazing!', 'Monday, July 6, 2020', 32),
(20, 'John', '2', 'this is bad!', 'Monday, July 6, 2020', 32),
(21, 'sasa', '3', 'asdsdds', 'Sunday, April 16, 2023', 40),
(22, 'admin', '3', 'asddasdas', 'Sunday, April 16, 2023', 40),
(23, 'Lenore Turner', '3', 'iuioaud', 'Monday, April 17, 2023', 0),
(24, 'magan', '3', 'good', 'Friday, April 28, 2023', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `status` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `status`) VALUES
(1, 'admin', 'info.bookly1512@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 1),
(2, 'admin2', 'admin@gmail.com', 'admin', 'admin', 1),
(3, 'author', 'author@gmail.com', 'f64cd8e32f5ac7553c150bd05d6f2252bb73f68d', 'author', 1),
(8, 'Fulton Lancaster', 'muzy@mailinator.com', 'user', 'user', 1),
(10, 'dharmesh', 'sojije4913@cmeinbox.com', 'user', 'user', 1),
(11, 'Marcia Castro', 'caxuzeji@mailinator.com', 'user', 'user', 1),
(12, 'Lenore Turner', 'gedidot@mailinator.com', 'user', 'user', 1),
(13, 'magan', 'myownspace1512@gmail.com', '12dea96fec20593566ab75692c9949596833adc9', 'user', 1),
(14, 'admin', 'dhdiyora1512@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
