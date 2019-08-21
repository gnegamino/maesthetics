DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`password`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `auth` VALUES ('$2y$10$J3bgRNatjaIGJB/nY79tB.82Rbq7.FDilO/f5bGGXPyu1yCgN/xXC');

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `module` varchar(100) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `content` VALUES ('about','<p><span style=\"color:#f1c40f\">M Aesthetics Clinic</span>&nbsp;is a world class facility which offer various products and procedures designed to enhance one&#39;s beauty and fulfill one&#39;s fantasy of magnificence. Procedures offered include Facials, Drips and Lasers. We are equipped with brandnew, state of the art machines that produce exceptional results. Our center also houses an Operating Theater designed to accommodate all aesthetic surgeries. Patients can rest in our Recovery Room after each surgery.</p>\n\n<p>Our Surgeon is a member of the Philippine Association of Plastic, Reconstructive and Aesthetic Surgeons (PAPRAS), the only society recognized by the Philippine Medical Association. This recognition assures you the best results.</p>\n\n<p>We are located in the heart of Quezon City&#39;s business district with ample parking and valet service. Easy access to public transporation is also available. We can also arrange accomodation, recreation and transportation for patients.</p>\n');

CREATE TABLE `gallery` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `path` varchar(500) DEFAULT '',
  `description` varchar(1024) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `module` tinyint(5) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ix_path` (`path`),
  KEY `ix_parent_id` (`parent_id`),
  KEY `ix_module` (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `services` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `ix_name` (`name`(767))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `services_featured` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `services_id` bigint(20) DEFAULT '0',
  `title` varchar(512) DEFAULT '',
  `description` mediumtext,
  PRIMARY KEY (`id`),
  KEY `ix_services_id` (`services_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `services_all` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `services_id` bigint(20) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `name` varchar(512) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `ix_name` (`name`),
  KEY `ix_parent_id` (`parent_id`),
  KEY `ix_service_id` (`services_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
