ALTER TABLE `orders` ADD `paid_amount` VARCHAR(255) NULL DEFAULT NULL AFTER `payment_status`, ADD `response` LONGTEXT NULL DEFAULT NULL AFTER `paid_amount`;
ALTER TABLE `orders` ADD `currency` VARCHAR(255) NULL DEFAULT NULL AFTER `payment_status`;
ALTER TABLE `orders` ADD `api_payment_status` VARCHAR(255) NULL DEFAULT NULL AFTER `payment_status`;

ALTER TABLE general_settings
ADD COLUMN account_name VARCHAR(255) DEFAULT NULL,
ADD COLUMN bsb VARCHAR(255) DEFAULT NULL,
ADD COLUMN account_number VARCHAR(255) DEFAULT NULL,
ADD COLUMN bank_name VARCHAR(255) DEFAULT NULL,
ADD COLUMN swift_code VARCHAR(255) DEFAULT NULL,
ADD COLUMN bank_details_status ENUM('show', 'hide') DEFAULT 'show';
