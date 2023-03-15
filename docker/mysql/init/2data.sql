SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
SET foreign_key_checks = 0;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `location`) VALUES
(1, 'Isaac Newton', 1),
(2, 'Oscar Wilde', 1),
(3, 'Charles Darwin', 1),
(4, 'Benjamin Franklin', 2),
(5, 'Luciano Pavarotti', 3);

--
-- Dumping data for table `buildings_departments`
--

INSERT INTO `buildings_departments` (`id`, `building_id`, `department_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 3, 5),
(6, 4, 1),
(7, 4, 4),
(8, 5, 1),
(9, 5, 4);

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'development'),
(2, 'accounting'),
(3, 'HR'),
(4, 'sales'),
(5, 'hq');

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `card_number`) VALUES
(1, 'Julius', 'Caesar', '142594708f3a5a3ac2980914a0fc954f');

--
-- Dumping data for table `employees_departments`
--

INSERT INTO `employees_departments` (`id`, `employee_id`, `department_id`) VALUES
(1, 1, 5),
(2, 1, 1);

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(1, 'UK'),
(2, 'USA'),
(3, 'ITALY');
COMMIT;

SET foreign_key_checks = 1;