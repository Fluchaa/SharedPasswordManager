<?php
namespace OCA\Spwm\Db;

use OCP\IDBConnection;

class Authentication {
	private $db;

	public function __construct(IDBConnection $db) {
		$this->db = $db;
	}

	/**
	 * @param  $userId
	 * @return number of records with userId
	 */
	public function checkExists($userId) {
		$sql = 'SELECT COUNT(*) AS `count` FROM `*PREFIX*spwm_userkey` WHERE user_id = ?';
		$sqls = $this->db->prepare($sql);
		$params = array($userId);
		$sqls->execute($params);

		$row = $sqls->fetch();
		$sqls->closeCursor();
		return intval($row['count']);
	}

	/**
	 * @UseSession
	 * 
	 * @param  $userId   
	 * @param  $password the login password plain text
	 * @return number of entrys with matching hash
	 */
	public function unlock($userId, $password) {
		/* TODO: Gather Pepper from Config, Salt from DB and hash with Cryptolib */
		/* TODO: Set Session spwm_hash */
		return 0;
	}
}