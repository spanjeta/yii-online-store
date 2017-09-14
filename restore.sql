-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `ha_logins`
-- -------------------------------------------
DROP TABLE IF EXISTS `ha_logins`;
CREATE TABLE IF NOT EXISTS `ha_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `loginProvider` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `loginProviderIdentifier` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loginProvider_2` (`loginProvider`,`loginProviderIdentifier`),
  KEY `loginProvider` (`loginProvider`),
  KEY `loginProviderIdentifier` (`loginProviderIdentifier`),
  KEY `userId` (`userId`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_address`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_address`;
CREATE TABLE IF NOT EXISTS `tbl_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulding_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_add` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suburb` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` int(11) DEFAULT NULL,
  `_state` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bulding_name1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_add1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suburb1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode1` int(11) DEFAULT NULL,
  `_state1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ph_no` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) NOT NULL DEFAULT '1',
  `type_id` int(11) NOT NULL DEFAULT '1',
  `is_same` int(11) NOT NULL DEFAULT '0',
  `cart_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fk_address_user` (`create_user_id`),
  CONSTRAINT `fk_address_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_auth_session`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_auth_session`;
CREATE TABLE IF NOT EXISTS `tbl_auth_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_code` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `device_token` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_session_create_user` (`create_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_cart`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `device_id` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_id` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `amount` float(11,2) NOT NULL DEFAULT '0.00',
  `postage_id` int(11) DEFAULT NULL,
  `postage_charge` float(11,2) NOT NULL DEFAULT '0.00',
  `coupon_id` int(11) DEFAULT NULL,
  `coupon_amount` float(11,2) NOT NULL DEFAULT '0.00',
  `create_user_id` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_shop_id` (`shop_id`),
  CONSTRAINT `fk_cart_shop_id` FOREIGN KEY (`shop_id`) REFERENCES `tbl_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_cart_item`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_cart_item`;
CREATE TABLE IF NOT EXISTS `tbl_cart_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `var_product_id` int(11) NOT NULL,
  `amount` float(11,2) NOT NULL DEFAULT '0.00',
  `size_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `state_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_item_product_id` (`product_id`),
  CONSTRAINT `fk_cart_item_product_id` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_category`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `image_file` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `language_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_no` int(11) NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_create_user` (`create_user_id`),
  CONSTRAINT `fk_category_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_color`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_color`;
CREATE TABLE IF NOT EXISTS `tbl_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `color_code` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_color_create_user` (`create_user_id`),
  CONSTRAINT `fk_color_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_comment`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_comment`;
CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `state_id` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_create_user` (`create_user_id`),
  CONSTRAINT `fk_comment_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_company`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_company`;
CREATE TABLE IF NOT EXISTS `tbl_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `shop_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shop_code` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `shop_type` int(11) NOT NULL DEFAULT '1',
  `shop_slogan` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_shop` text COLLATE utf8_unicode_ci,
  `admin_first_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_company_position` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_contact` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web_address` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_file` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo_file` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terms` text COLLATE utf8_unicode_ci,
  `delivery_info` text COLLATE utf8_unicode_ci,
  `fax` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abn` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acn` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_no` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `is_featured` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_company_user` (`create_user_id`),
  KEY `id` (`id`),
  CONSTRAINT `fk_company_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_notification`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_notification`;
CREATE TABLE IF NOT EXISTS `tbl_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notification_create_user` (`create_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_order`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_user_id` int(11) NOT NULL,
  `ship_address_id` int(11) NOT NULL,
  `bil_address_id` int(11) NOT NULL,
  `amount` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_email` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_no` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paid` int(11) NOT NULL DEFAULT '0',
  `payment_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `ship_time` datetime NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_create_user` (`create_user_id`),
  KEY `fk_order_ship_address_id` (`ship_address_id`),
  KEY `fk_order_bill_address_id` (`bil_address_id`),
  CONSTRAINT `fk_order_bill_address_id` FOREIGN KEY (`bil_address_id`) REFERENCES `tbl_user_address` (`id`),
  CONSTRAINT `fk_order_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  CONSTRAINT `fk_order_ship_address_id` FOREIGN KEY (`ship_address_id`) REFERENCES `tbl_user_address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_order_item`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_order_item`;
CREATE TABLE IF NOT EXISTS `tbl_order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `create_user_id` int(11) NOT NULL,
  `sku` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `ship_time` datetime NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_item_create_user` (`create_user_id`),
  KEY `fk_order_item_order_id` (`order_id`),
  CONSTRAINT `fk_order_item_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  CONSTRAINT `fk_order_item_order_id` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_page`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_page`;
CREATE TABLE IF NOT EXISTS `tbl_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT '1',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_flat_user` (`create_user_id`),
  CONSTRAINT `user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_payment`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_payment`;
CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payer_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `rec_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `cart_id` int(11) NOT NULL,
  `amount` float(11,2) NOT NULL,
  `amount_type` int(11) NOT NULL DEFAULT '1',
  `content` text COLLATE utf8_unicode_ci,
  `type_id` int(11) NOT NULL DEFAULT '1',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `shop_id` int(11) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `order_no` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_user` (`create_user_id`),
  CONSTRAINT `fk_payment_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_payment_setting`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_payment_setting`;
CREATE TABLE IF NOT EXISTS `tbl_payment_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paypal` tinyint(1) NOT NULL DEFAULT '1',
  `cart` tinyint(1) NOT NULL DEFAULT '0',
  `bank_deposit` tinyint(1) NOT NULL DEFAULT '0',
  `cash_pickup` tinyint(1) NOT NULL DEFAULT '0',
  `cash_delivery` tinyint(1) NOT NULL DEFAULT '0',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `type_id` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_setting_create_user` (`create_user_id`),
  CONSTRAINT `fk_payment_setting_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_paypal_info`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_paypal_info`;
CREATE TABLE IF NOT EXISTS `tbl_paypal_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit_card_no` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '1',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_paypal_create_user` (`create_user_id`),
  CONSTRAINT `fk_paypal_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_postage`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_postage`;
CREATE TABLE IF NOT EXISTS `tbl_postage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `first_item_cost` int(11) DEFAULT NULL,
  `additional_item_cost` int(11) DEFAULT NULL,
  `custom_price` int(11) DEFAULT NULL,
  `state_id` int(11) NOT NULL DEFAULT '1',
  `type_id` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_postage_create_user` (`create_user_id`),
  CONSTRAINT `fk_postage_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_product`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `range` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edition` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hide_public` tinyint(4) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  `large_description` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `related_items` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_file` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_file` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `size_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `is_sale` int(11) NOT NULL DEFAULT '0',
  `feature_site` int(11) NOT NULL DEFAULT '0',
  `is_featured` int(11) NOT NULL,
  `postage_id` int(11) DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT '1',
  `warranty_id` int(11) DEFAULT NULL,
  `quantity` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_price` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `t_price` float(10,2) NOT NULL,
  `is_discount` int(11) NOT NULL DEFAULT '0',
  `tax` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_amount` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_create_user` (`create_user_id`),
  KEY `fk_product_category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_product_image`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_product_image`;
CREATE TABLE IF NOT EXISTS `tbl_product_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `order_no` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_image_create_user` (`create_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_review`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_review`;
CREATE TABLE IF NOT EXISTS `tbl_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reply` text COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `star_count` int(11) NOT NULL DEFAULT '1',
  `image_file` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_review_create_user` (`create_user_id`),
  KEY `fk_review_store_id` (`shop_id`),
  CONSTRAINT `fk_review_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  CONSTRAINT `fk_review_store_id` FOREIGN KEY (`shop_id`) REFERENCES `tbl_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_size`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_size`;
CREATE TABLE IF NOT EXISTS `tbl_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_size_create_user` (`create_user_id`),
  CONSTRAINT `fk_size_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_slider_image`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_slider_image`;
CREATE TABLE IF NOT EXISTS `tbl_slider_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slider_image` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '1',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `order_no` int(11) NOT NULL DEFAULT '1',
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_slider_image_create_user` (`create_user_id`),
  KEY `slider_image` (`slider_image`(255)),
  CONSTRAINT `fk_slider_image_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_user`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ph_no` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `password` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '0',
  `about_me` text COLLATE utf8_unicode_ci,
  `image_file` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tos` tinyint(1) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '3',
  `state_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `last_visit_time` datetime DEFAULT NULL,
  `last_action_time` datetime DEFAULT NULL,
  `last_password_change` datetime DEFAULT NULL,
  `activation_key` varchar(512) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `login_error_count` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fk_user_role` (`role_id`),
  CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `tbl_user_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_user_address`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_user_address`;
CREATE TABLE IF NOT EXISTS `tbl_user_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulding_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_add` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shop_location` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suburb` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` int(11) DEFAULT NULL,
  `_state` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bulding_name1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_add1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suburb1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode1` int(11) DEFAULT NULL,
  `_state1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `long` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) NOT NULL DEFAULT '1',
  `is_same` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fk_user_address_user` (`create_user_id`),
  CONSTRAINT `fk_user_address_user` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_user_role`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_user_role`;
CREATE TABLE IF NOT EXISTS `tbl_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_wish_list`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_wish_list`;
CREATE TABLE IF NOT EXISTS `tbl_wish_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT 'product=0,emp=1,deal=2,store=3,blog=4',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_wish_list` (`create_user_id`),
  CONSTRAINT `tbl_wish_list` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE DATA tbl_user
-- -------------------------------------------
INSERT INTO `tbl_user` (`id`,`username`,`email`,`first_name`,`middle_name`,`last_name`,`ph_no`,`date_of_birth`,`password`,`gender`,`about_me`,`image_file`,`language`,`currency`,`tos`,`role_id`,`state_id`,`type_id`,`last_visit_time`,`last_action_time`,`last_password_change`,`activation_key`,`login_error_count`,`create_time`) VALUES
('1','admin','admin@toxsl.in','rajesh','admin','hsafdgh','9874563210','0000-00-00','sha256:1000:7PP3cEUu2axZYKz8NvYPtxXlBSZRrXd8:Yqml7D5H++sC4MkLh5rvr32CNZozEf6x','2','','','en','','0','1','1','0','2016-05-02 10:20:58','0000-00-00 00:00:00','0000-00-00 00:00:00','','0','2014-02-08 19:30:46');



-- -------------------------------------------
-- TABLE DATA tbl_user_role
-- -------------------------------------------
INSERT INTO `tbl_user_role` (`id`,`title`,`description`) VALUES
('1','Admin','');
INSERT INTO `tbl_user_role` (`id`,`title`,`description`) VALUES
('2','Business User','');
INSERT INTO `tbl_user_role` (`id`,`title`,`description`) VALUES
('3','User','');



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
