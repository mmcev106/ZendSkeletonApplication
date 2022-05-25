<?php
/**
 * Date: 2/2/2020
 * Time: 8:51 PM
 */

namespace App\Db;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;


class Connection
{
    private $db;

    /**
     * Connection constructor.
     * @param Adapter $db
     */
    public function __construct(Adapter $db)
    {
        $this->db = $db;
    }

    /**
     * @param $sql
     * @param $params
     * @return \Zend\Db\Adapter\Driver\StatementInterface
     */
    private function createStatement($sql, $params)
    {
        return $this->db->createStatement($sql, $params);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return ResultInterface|null
     */
    public function executeQuery($sql, $params)
    {
        $result = null;
        try {
            $stmt = $this->createStatement($sql, $params);
            /** @var  $preparedStmt */
            $stmt->prepare($sql);
            if ($stmt->isPrepared()) {
                /** @var ResultInterface $result */
                $result = $stmt->execute($params);
            }
            return $result;
        } catch (\Exception $e) {
            error_log($e->getMessage() . '
            ' . $e->getTraceAsString());
            if (($errors = sqlsrv_errors()) != null) {
                $debugMessage = $sql . "\r\n";
                foreach ($errors as $error) {
                    $debugMessage .= "SQLSTATE: " . $error['SQLSTATE'] . "\r\n";
                    $debugMessage .= "code: " . $error['code'] . "\r\n";
                    $debugMessage .= "message: " . $error['message'] . "\r\n";
                }
                if ($GLOBALS['print_debug_message']) {
                    error_log($debugMessage);
                }
            }
        }
    }

    /**
     * @return DbAdapter
     */
    public function getDb()
    {
        return $this->db;
    }

    function createConnection()
    {
        $serverName = "rniokc81943\sqlexpress"; //serverName\instanceName
// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
        $connectionInfo = array("Database" => "Data_Analytics");
        $conn = sqlsrv_connect($serverName, $connectionInfo);

        if ($conn) {
//        echo "Connection established.\r\n";
        } else {
            echo "Connection could not be established.<br />";
            die(print_r(sqlsrv_errors(), true));
        }
        return $conn;
    }



}