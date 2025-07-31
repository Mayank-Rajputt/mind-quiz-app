-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 29, 2025 at 08:59 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_app_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `icon_svg` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quiz_id` int NOT NULL,
  `question_text` text NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `correct_answer` int NOT NULL COMMENT 'Stores the correct option number (1-4)',
  `hint` text,
  PRIMARY KEY (`id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`, `option1`, `option2`, `option3`, `option4`, `correct_answer`, `hint`) VALUES
(1, 1, 'What is the capital of France?', 'Berlin', 'Madrid', 'Paris', 'Rome', 3, 'This city is famous for the Eiffel Tower.'),
(2, 1, 'Which planet is known as the Red Planet?', 'Earth', 'Mars', 'Jupiter', 'Saturn', 2, 'It is the fourth planet from the Sun.'),
(3, 1, 'Who wrote the play \"Romeo and Juliet\"?', 'Charles Dickens', 'J.K. Rowling', 'William Shakespeare', 'Mark Twain', 3, 'The author is from Stratford-upon-Avon.'),
(4, 1, 'What is the largest ocean on Earth?', 'Atlantic Ocean', 'Indian Ocean', 'Arctic Ocean', 'Pacific Ocean', 4, 'It is the largest and deepest of the world\'s five oceans.'),
(5, 1, 'What is the chemical symbol for the element Gold?', 'Ag', 'Au', 'G', 'Go', 2, 'Its symbol comes from the Latin word \'aurum\'.'),
(6, 1, 'What is the hardest natural substance on Earth?', 'Gold', 'Iron', 'Diamond', 'Platinum', 3, 'It is a form of carbon and is used in jewelry.'),
(7, 1, 'How many continents are there in the world?', '5', '6', '7', '8', 3, 'The number includes Asia, Africa, North America, South America, Antarctica, Europe, and Australia.'),
(8, 1, 'Which country is home to the kangaroo?', 'South Africa', 'India', 'Australia', 'Mexico', 3, 'This country is also a continent.'),
(9, 1, 'What is the tallest mountain in the world?', 'K2', 'Mount Everest', 'Kangchenjunga', 'Lhotse', 2, 'It is located in the Himalayas mountain range.'),
(10, 1, 'Who painted the Mona Lisa?', 'Vincent van Gogh', 'Pablo Picasso', 'Leonardo da Vinci', 'Claude Monet', 3, 'He was an Italian Renaissance artist and inventor.'),
(11, 1, 'What is the main ingredient in guacamole?', 'Tomato', 'Avocado', 'Onion', 'Lime', 2, 'It is a green, pear-shaped fruit.'),
(12, 1, 'Which is the longest river in the world?', 'Amazon River', 'Nile River', 'Yangtze River', 'Mississippi River', 2, 'It flows through northeastern Africa.'),
(13, 1, 'In which country would you find the Great Pyramid of Giza?', 'Greece', 'Mexico', 'Egypt', 'Peru', 3, 'This country is in the northeast corner of Africa.'),
(14, 1, 'What is the currency of Japan?', 'Yuan', 'Won', 'Yen', 'Baht', 3, 'It is the official currency of the Land of the Rising Sun.'),
(15, 1, 'What is the most spoken language in the world?', 'English', 'Spanish', 'Mandarin Chinese', 'Hindi', 3, 'It is the most common native language, spoken by over 1.1 billion people.'),
(16, 1, 'Who discovered penicillin?', 'Marie Curie', 'Alexander Fleming', 'Isaac Newton', 'Albert Einstein', 2, 'His discovery came from a moldy petri dish in 1928.'),
(17, 1, 'What is the capital of Canada?', 'Toronto', 'Vancouver', 'Montreal', 'Ottawa', 4, 'This city is the capital, but not the largest city by population.'),
(18, 1, 'Which element does \"O\" represent on the periodic table?', 'Oxygen', 'Gold', 'Osmium', 'Oganesson', 1, 'This gas makes up about 21% of the Earth\'s atmosphere.'),
(19, 1, 'What is the name of the galaxy that contains our Solar System?', 'Andromeda', 'Triangulum', 'Whirlpool', 'Milky Way', 4, 'Our solar system resides in one of its spiral arms.'),
(20, 1, 'How many sides does a hexagon have?', '5', '6', '7', '8', 2, 'It has two more sides than a square.'),
(21, 1, 'Which famous scientist developed the theory of relativity?', 'Isaac Newton', 'Galileo Galilei', 'Albert Einstein', 'Nikola Tesla', 3, 'His famous equation is E=mc².'),
(22, 1, 'What is the largest bone in the human body?', 'Femur', 'Humerus', 'Tibia', 'Fibula', 1, 'It is the thigh bone.'),
(23, 1, 'Which of these is a primary color?', 'Green', 'Orange', 'Blue', 'Purple', 3, 'Red and Yellow are also primary colors.'),
(24, 1, 'In what year did the Titanic sink?', '1905', '1912', '1918', '1923', 2, 'The ship hit an iceberg in the North Atlantic Ocean.'),
(25, 1, 'What is the capital of Australia?', 'Sydney', 'Melbourne', 'Canberra', 'Perth', 3, 'This city was specifically built to be the capital.'),
(26, 1, 'Which country is known as the Land of the Rising Sun?', 'China', 'Japan', 'South Korea', 'Thailand', 2, 'Its name in Japanese is \"Nippon\" or \"Nihon\".'),
(27, 1, 'What is the smallest prime number?', '0', '1', '2', '3', 3, 'It is the only even prime number.'),
(28, 1, 'Who was the first person to walk on the moon?', 'Buzz Aldrin', 'Yuri Gagarin', 'Michael Collins', 'Neil Armstrong', 4, 'His famous first words were, \"That\'s one small step for man...\"'),
(29, 1, 'What does \"www\" stand for in a website browser?', 'World Wide Web', 'World Web Wide', 'Web World Wide', 'Wide World Web', 1, 'It was invented by Tim Berners-Lee.'),
(30, 1, 'How many hearts does an octopus have?', '1', '2', '3', '4', 3, 'One heart pumps blood through the body, the other two pump it through the gills.'),
(31, 1, 'What is the main gas found in the air we breathe?', 'Oxygen', 'Hydrogen', 'Nitrogen', 'Carbon Dioxide', 3, 'It makes up about 78% of the air we breathe.'),
(32, 1, 'Which artist cut off his own ear?', 'Pablo Picasso', 'Claude Monet', 'Salvador Dalí', 'Vincent van Gogh', 4, 'He was a Dutch Post-Impressionist painter.'),
(33, 1, 'What is the largest country in the world by area?', 'Canada', 'China', 'USA', 'Russia', 4, 'It spans 11 time zones.'),
(34, 1, 'Which instrument is used to measure temperature?', 'Barometer', 'Thermometer', 'Hygrometer', 'Anemometer', 2, 'It measures heat or cold.'),
(35, 1, 'What is the capital of Italy?', 'Venice', 'Florence', 'Rome', 'Milan', 3, 'The Colosseum is a famous landmark in this city.'),
(36, 1, 'What is the chemical formula for water?', 'H2O', 'CO2', 'O2', 'NaCl', 1, 'It consists of two hydrogen atoms and one oxygen atom.'),
(37, 1, 'Who is the author of the Harry Potter series?', 'J.R.R. Tolkien', 'George R.R. Martin', 'J.K. Rowling', 'Suzanne Collins', 3, 'The book series is about a young wizard.'),
(38, 1, 'What is the name of the world\'s largest desert?', 'Gobi Desert', 'Arabian Desert', 'Sahara Desert', 'Antarctic Polar Desert', 4, 'It is the coldest, driest, and highest desert in the world.'),
(39, 1, 'Which of the following is a mammal?', 'Shark', 'Crocodile', 'Dolphin', 'Penguin', 3, 'This marine animal is known for its intelligence and whistles.'),
(40, 1, 'What is the speed of light?', '300,000 km/s', '150,000 km/s', '500,000 km/s', '1,000,000 km/s', 1, 'It is approximately 299,792 kilometers per second.'),
(41, 1, 'How many planets are in our solar system?', '7', '8', '9', '10', 2, 'The count includes Mercury, Venus, Earth, Mars, Jupiter, Saturn, Uranus, and Neptune.'),
(42, 1, 'What is the capital of Spain?', 'Barcelona', 'Lisbon', 'Madrid', 'Seville', 3, 'This city is the capital of Spain.'),
(43, 1, 'What is the most abundant metal in the Earth\'s crust?', 'Iron', 'Aluminum', 'Copper', 'Gold', 2, 'Its chemical symbol is Al.'),
(44, 1, 'Who invented the telephone?', 'Thomas Edison', 'Nikola Tesla', 'Alexander Graham Bell', 'Guglielmo Marconi', 3, 'His invention revolutionized long-distance communication.'),
(45, 1, 'What is the main component of the sun?', 'Oxygen', 'Hydrogen', 'Helium', 'Carbon', 2, 'The second most abundant element in the sun is Helium.'),
(46, 1, 'What is the capital of the United Kingdom?', 'Manchester', 'Liverpool', 'Edinburgh', 'London', 4, 'This city is located on the River Thames.'),
(47, 1, 'Which of these is not a fruit?', 'Tomato', 'Cucumber', 'Avocado', 'Rhubarb', 4, 'It is a perennial vegetable often used in desserts like pie.'),
(48, 1, 'What is the study of earthquakes called?', 'Seismology', 'Geology', 'Volcanology', 'Meteorology', 1, 'The Richter scale is used to measure the magnitude of these events.'),
(49, 1, 'Which is the only continent to lie in all four hemispheres?', 'Asia', 'Australia', 'Africa', 'Antarctica', 3, 'This continent is crossed by the equator and the prime meridian.'),
(50, 1, 'What is the capital of Germany?', 'Munich', 'Hamburg', 'Berlin', 'Frankfurt', 3, 'The Brandenburg Gate is a famous landmark in this city.'),
(51, 1, 'In which sport would you perform a slam dunk?', 'Soccer', 'Baseball', 'Basketball', 'Tennis', 3, 'This sport involves hoops and a ball.'),
(52, 1, 'What is a group of lions called?', 'A pack', 'A herd', 'A pride', 'A flock', 3, 'This term is used for a family of lions.'),
(53, 1, 'What is the boiling point of water at sea level?', '90°C', '100°C', '110°C', '120°C', 2, 'It is 212 degrees Fahrenheit.'),
(54, 1, 'Which country gifted the Statue of Liberty to the USA?', 'United Kingdom', 'Germany', 'France', 'Spain', 3, 'This country also gifted the Marquis de Lafayette.'),
(55, 1, 'What is the square root of 144?', '10', '11', '12', '13', 3, 'The number multiplied by itself equals 144.'),
(56, 1, 'Who was the first President of the United States?', 'Thomas Jefferson', 'Abraham Lincoln', 'John Adams', 'George Washington', 4, 'He was the commander-in-chief of the Continental Army.'),
(57, 1, 'What is the capital of Brazil?', 'Rio de Janeiro', 'São Paulo', 'Brasília', 'Salvador', 3, 'This planned city became the capital in 1960.'),
(58, 1, 'Which language is spoken in Brazil?', 'Spanish', 'Portuguese', 'Brazilian', 'English', 2, 'It is the official language of Portugal as well.'),
(59, 1, 'What is the name of the longest bone in the arm?', 'Radius', 'Ulna', 'Humerus', 'Clavicle', 3, 'It is the bone of the upper arm.'),
(60, 1, 'Which planet is closest to the sun?', 'Venus', 'Mars', 'Mercury', 'Earth', 3, 'It is the smallest planet in our solar system.'),
(61, 1, 'What is the national animal of India?', 'Lion', 'Tiger', 'Elephant', 'Peacock', 2, 'This large cat is known for its stripes.'),
(62, 1, 'What is the currency of the United Kingdom?', 'Euro', 'Dollar', 'Pound Sterling', 'Franc', 3, 'Its symbol is £.'),
(63, 1, 'What is the largest organ in the human body?', 'Liver', 'Brain', 'Heart', 'Skin', 4, 'It is the body\'s outer protective layer.'),
(64, 1, 'Which of these is a type of cloud?', 'Stratus', 'Status', 'Statue', 'Strait', 1, 'These are low-level, layered clouds.'),
(65, 1, 'Who wrote \"The Great Gatsby\"?', 'F. Scott Fitzgerald', 'Ernest Hemingway', 'William Faulkner', 'John Steinbeck', 1, 'The novel is set in the Roaring Twenties on Long Island.'),
(66, 1, 'What is the capital of Russia?', 'Saint Petersburg', 'Kazan', 'Novosibirsk', 'Moscow', 4, 'The Kremlin and Red Square are located here.'),
(67, 1, 'What is the process by which plants make their own food called?', 'Respiration', 'Photosynthesis', 'Transpiration', 'Germination', 2, 'Plants use sunlight, water, and carbon dioxide for this process.'),
(68, 1, 'Which ocean is the smallest in the world?', 'Pacific Ocean', 'Atlantic Ocean', 'Indian Ocean', 'Arctic Ocean', 4, 'It is located around the North Pole.'),
(69, 1, 'What is the capital of China?', 'Shanghai', 'Hong Kong', 'Beijing', 'Tianjin', 3, 'The Forbidden City is a famous landmark here.'),
(70, 1, 'How many strings does a standard violin have?', '4', '5', '6', '7', 1, 'It is a string instrument, typically with G, D, A, and E strings.'),
(71, 1, 'What is the main language spoken in Egypt?', 'English', 'French', 'Arabic', 'Egyptian', 3, 'This language is spoken across North Africa and the Middle East.'),
(72, 1, 'Who is known as the father of the computer?', 'Alan Turing', 'Charles Babbage', 'Tim Berners-Lee', 'Steve Jobs', 2, 'He designed the Analytical Engine, a mechanical general-purpose computer.'),
(73, 1, 'What is the capital of Argentina?', 'Santiago', 'Lima', 'Bogotá', 'Buenos Aires', 4, 'This city is famous for Tango dancing.'),
(74, 1, 'Which of these is a gas at room temperature?', 'Mercury', 'Bromine', 'Chlorine', 'Iodine', 3, 'This element is a halogen and is used for disinfection.'),
(75, 1, 'What is the world\'s most populous country?', 'India', 'United States', 'Indonesia', 'China', 1, 'This country currently has the largest population, recently surpassing the other.'),
(76, 1, 'What is the name of the sea between Europe and Africa?', 'Black Sea', 'Red Sea', 'Mediterranean Sea', 'Caribbean Sea', 3, 'It connects the Atlantic Ocean to the west and the Indian Ocean to the southeast.'),
(77, 1, 'Which famous ship sank on its maiden voyage in 1912?', 'Lusitania', 'Britannic', 'Titanic', 'Olympic', 3, 'The movie starring Leonardo DiCaprio and Kate Winslet is based on this event.'),
(78, 1, 'What is the capital of South Korea?', 'Busan', 'Incheon', 'Seoul', 'Daegu', 3, 'This city is the capital of the country known for K-Pop.'),
(79, 1, 'Which of the following is not a primary color?', 'Red', 'Yellow', 'Green', 'Blue', 3, 'This color is a mix of two primary colors.'),
(80, 1, 'What is the largest island in the world?', 'Greenland', 'New Guinea', 'Borneo', 'Madagascar', 1, 'It is an autonomous territory of Denmark.'),
(81, 1, 'What is the name of the force that pulls objects towards the Earth?', 'Magnetism', 'Friction', 'Gravity', 'Inertia', 3, 'This force was famously described by Isaac Newton.'),
(82, 1, 'What is the capital of Mexico?', 'Guadalajara', 'Tijuana', 'Mexico City', 'Cancún', 3, 'It is the capital of the country south of the USA.'),
(83, 1, 'What is the chemical symbol for Silver?', 'Si', 'Sv', 'Ag', 'Au', 3, 'Its symbol comes from the Latin word \'argentum\'.'),
(84, 1, 'What is the capital of New Zealand?', 'Auckland', 'Christchurch', 'Wellington', 'Queenstown', 3, 'This city is nicknamed \"The Windy City\", though not for its weather.'),
(85, 1, 'How many players are on a soccer team on the field?', '9', '10', '11', '12', 3, 'The sport is also known as football in most of the world.'),
(86, 1, 'What is the capital of Egypt?', 'Alexandria', 'Giza', 'Cairo', 'Luxor', 3, 'The Great Sphinx of Giza is located near this city.'),
(87, 1, 'Which is the largest moon in the Solar System?', 'Titan', 'Ganymede', 'Europa', 'Callisto', 2, 'It is one of Jupiter\'s moons.'),
(88, 1, 'What is the currency of South Africa?', 'Naira', 'Cedi', 'Shilling', 'Rand', 4, 'This currency is used in the country at the southern tip of Africa.'),
(89, 1, 'What is the capital of Thailand?', 'Phuket', 'Chiang Mai', 'Pattaya', 'Bangkok', 4, 'This city is known for its vibrant street life and ornate shrines.'),
(90, 1, 'Which of the following is a renewable source of energy?', 'Coal', 'Natural Gas', 'Solar Power', 'Petroleum', 3, 'This energy comes from the sun.'),
(91, 1, 'What is the capital of Turkey?', 'Istanbul', 'Ankara', 'Izmir', 'Bursa', 2, 'This city is the capital, while the other is the largest city.'),
(92, 1, 'What is the study of stars and planets called?', 'Astrology', 'Astronomy', 'Geology', 'Biology', 2, 'It is the scientific study of celestial objects.'),
(93, 1, 'Who painted the ceiling of the Sistine Chapel?', 'Raphael', 'Donatello', 'Leonardo da Vinci', 'Michelangelo', 4, 'He was an Italian sculptor, painter, architect and poet of the High Renaissance.'),
(94, 1, 'What is the main ingredient in bread?', 'Sugar', 'Yeast', 'Flour', 'Butter', 3, 'It is the primary ingredient in most baked goods.'),
(95, 1, 'Which country is famous for its tulips and windmills?', 'Belgium', 'Germany', 'Netherlands', 'Denmark', 3, 'This European country is famous for its canals and cheese.'),
(96, 1, 'What is the capital of Greece?', 'Thessaloniki', 'Patras', 'Heraklion', 'Athens', 4, 'The Parthenon is located on the Acropolis in this city.'),
(97, 1, 'What is the most common blood type in humans?', 'A+', 'B-', 'AB+', 'O+', 4, 'It is often called the \"universal donor\" blood type.'),
(98, 1, 'Which animal is known as the \"King of the Jungle\"?', 'Tiger', 'Lion', 'Bear', 'Wolf', 2, 'This large cat is a social animal, unlike most other felines.'),
(99, 1, 'How many colors are in a rainbow?', '5', '6', '7', '8', 3, 'The colors are often remembered by the acronym ROYGBIV.'),
(100, 1, 'What is the capital of Ireland?', 'Cork', 'Galway', 'Limerick', 'Dublin', 4, 'This city is the capital of the Republic of Ireland.'),
(101, 1, 'What is the main function of the kidneys?', 'Pump blood', 'Filter blood and produce urine', 'Digest food', 'Control the body\'s metabolism', 2, 'These organs are part of the urinary system.'),
(102, 1, 'Which of these is a continent?', 'Greenland', 'Siberia', 'Europe', 'Arabia', 3, 'It is one of the seven major landmasses on Earth.');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `description`, `category_id`) VALUES
(1, 'General Knowledge 101', 'A comprehensive test of your general knowledge. Let\'s see what you\'ve got!', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `score` int NOT NULL,
  `total_questions` int NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
