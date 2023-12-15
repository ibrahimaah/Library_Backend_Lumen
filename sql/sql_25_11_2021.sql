/* Delete reviews table then apply the following statement */

ALTER TABLE `ratings` ADD `review` VARCHAR(1024) NULL DEFAULT '' AFTER `rating`;