CREATE DATABASE blogApi;
CREATE TABLE IF NOT EXISTS `post`(
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` varchar(100) COLLATE utf8_spanish_ci not NULL,
    `status` enum('draft','published')COLLATE utf8_spanish_ci not NULL DEFAULT 'draft' ,
    `content` text COLLATE utf8_spanish_ci not NULL,
    `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET= utf8 COLLATE utf8_spanish_ci; 