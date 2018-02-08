<?php
namespace OCA\Spwm\Db;

use OCP\IDBConnection;

class Authentication {
	private $db;

	public function __construct(IDBConnection $db) {
		$this->db = $db;
	}

	/**
	 * @param  userId
	 * @return number of records with userId
	 */
	public function checkExists($userId) {
		$sql = 'SELECT COUNT(*) AS `count` FROM `*PREFIX*spwm_userkey` WHERE user_id = ?';
		$sqls = $this->db->prepare($sql);
		$sqls->bindParam(1, $userId);
		$sqls->execute();

		$row = $sqls->fetch();
		$sqls->closeCursor();
		return intval($row['count']);
	}
}