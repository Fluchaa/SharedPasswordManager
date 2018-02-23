<?php
/**
 * @copyright Copyright (c) 2018 niTEC GesbR https://nitec.at
 * @author Michael Flucher <michael.flucher@nitec.at>
 *
 * Permission is hereby granted to 
 *
 * all our Customers
 *
 * obtaining a copy of this software and associated documentation files (the "Software"), 
 * to deal in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge or publish this Software. 
 *
 * Noone is permitted to use or sell parts of the Software or the whole Software 
 * without the written permission of niTEC GesbR. 
 */

namespace OCA\Spwm\Db;

use OCP\IDBConnection;
use OCP\AppFramework\Db\Mapper;

use OCA\Spwm\Utility\Utils;

class CategoryMapper extends Mapper {
	private $utils;

	public function __construct(IDBConnection $db, Utils $utils) {
		parent::__construct($db, 'spwm_category');
		$this->utils = $utils;
	}

	/**
	 * Get Category Entity
	 * @throws DoesNotExistException if no entry is found
	 * @throws MultipleObjectsReturnedException if more than one result
	 * @param  $categoryId
	 * @return Category
	 */
	public function find($categoryId) {
		$sql = 'SELECT * FROM `*PREFIX*spwm_category` WHERE `category_id` = ?';
		return $this->findEntity($sql, [$categoryId]);
	}

	/**
	 * Get Category Entity
	 * @throws DoesNotExistException if no entry is found
	 * @throws MultipleObjectsReturnedException if more than one result
	 * @param  $name
	 * @return Category
	 */
	public function findName($name) {
		$sql = 'SELECT * FROM `*PREFIX*spwm_category` WHERE `name` = ?';
		return $this->findEntity($sql, [$name]);
	}

	/**
	 * Create Category Entity
	 * @param  $name
	 * @return Category inserted Entity        
	 */
	public function create($name) {
		$category = new Category();
		$category->setName($name);
		return parent::insert($category);
	}

	/**
	 * get all categories
	 * @return Category[]
	 */
	public function getCategories() {
		$sql = 'SELECT * FROM `*PREFIX*spwm_category`';
		return $this->findEntities($sql);
	}
}