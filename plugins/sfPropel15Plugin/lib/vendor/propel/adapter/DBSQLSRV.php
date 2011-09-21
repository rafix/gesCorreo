<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

/**
 * This is used to connect to a MSSQL database using pdo_sqlsrv driver.
 *
 * @author     Benjamin Runnels
 * @version    $Revision$
 * @package    propel.runtime.adapter
 */
class DBSQLSRV extends DBMSSQL {
	/**
	 * @see        parent::initConnection()
	 */
	public function initConnection(PDO $con, array $settings) {
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	/**
	 * @see        parent::setCharset()
	 */
	public function setCharset(PDO $con, $charset) {
		switch (strtolower($charset)) {
		case 'utf-8':
			$con->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
			break;
		case 'system':
			$con->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_SYSTEM);
			break;
		default:
			throw new PropelException('only utf-8 or system encoding are supported by the pdo_sqlsrv driver');
		}
	}
}
