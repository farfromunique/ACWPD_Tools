<?php

namespace ACWPD\Tools;

/**
 * Provides tools to check the response of a Database Connection
 */
class DbErrorChecker {
	/**
	 * (Static) Throw a desciptive error or return data
	 * 
	 * Requires that your PDOStatement $stmt be ready to execute 
	 * (any parameters that need to be bound must already be bound)
	 * or an exception will be thrown by PDO
	 *
	 * @param PDO $db An active Database connection
	 * @param PDOStatement $stmt A prepared statement from PDO that is ready to go
	 * @return string
	 * @throws Exception
	 **/
	static public function CheckPrepared(\PDO $db, \PDOStatement $stmt) : array {
		$NoError = '00000';
		$res = $stmt->execute();
		$err = $stmt->errorInfo();
		if ($res === false) {
			if ($err[0] !== $NoError) {
				throw new \Exception('Database returned an error: ' . $err[0] . ' (' . $err[1] . ') with message: ' . $err[2], 1);
			}
			throw new \Exception('Statement failed to execute', 1);
		}
		return $stmt->fetch();
	}
}
