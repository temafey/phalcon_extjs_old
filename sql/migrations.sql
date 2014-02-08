--
-- Table structure for table `core_acl_access_list`
--

DROP TABLE IF EXISTS `core_acl_access_list`;
CREATE TABLE IF NOT EXISTS `core_acl_access_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(32) NOT NULL,
  `resource_id` varchar(32) NOT NULL,
  `access_id` varchar(32) NOT NULL,
  `allowed` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`role_id`,`resource_id`,`access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `core_acl_resources`
--

DROP TABLE IF EXISTS `core_acl_resources`;
CREATE TABLE IF NOT EXISTS `core_acl_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_acl_resources`
--

INSERT INTO `core_acl_resources` (`id`, `name`, `description`) VALUES
('1', 'admin_area', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_acl_resources_accesses`
--

DROP TABLE IF EXISTS `core_acl_resources_accesses`;
CREATE TABLE IF NOT EXISTS `core_acl_resources_accesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_id` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`resource_id`, `name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_acl_resources_accesses`
--

INSERT INTO `core_acl_resources_accesses` (`resource_id`, `name`) VALUES
('1', '*');

-- --------------------------------------------------------

--
-- Table structure for table `core_acl_roles`
--

DROP TABLE IF EXISTS `core_acl_roles`;
CREATE TABLE IF NOT EXISTS `core_acl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_acl_roles`
--

INSERT INTO `core_acl_roles` (`name`, `description`) VALUES
('admin', NULL),
('guest', NULL),
('user', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_acl_roles_inherits`
--

DROP TABLE IF EXISTS `core_acl_roles_inherits`;
CREATE TABLE IF NOT EXISTS `core_acl_roles_inherits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(32) NOT NULL,
  `role_inherit` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`role_id`,`role_inherit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `core_mvc_actions`
--

DROP TABLE IF EXISTS `core_mvc_actions`;
CREATE TABLE IF NOT EXISTS `core_mvc_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','not_active') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY (`controller_id`, `name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `core_mvc_controllers`
--

DROP TABLE IF EXISTS `core_mvc_controllers`;
CREATE TABLE IF NOT EXISTS `core_mvc_controllers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','not_active') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `core_mvc_modules`
--

DROP TABLE IF EXISTS `core_mvc_modules`;
CREATE TABLE IF NOT EXISTS `core_mvc_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` enum('active','not_active') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `core_menu`
--

DROP TABLE IF EXISTS `core_menu`;
CREATE TABLE IF NOT EXISTS `core_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Table structure for table `core_items`
--

DROP TABLE IF EXISTS `core_menu_items`;
CREATE TABLE IF NOT EXISTS `core_menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `label` varchar(100) NOT NULL,
  `desc` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(100) NOT NULL DEFAULT '',
  `module_id` varchar(200) NOT NULL,
  `controller_id` varchar(200) NOT NULL,
  `action_id` varchar(200) NOT NULL,
  `order` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('active','not_active') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
