<?php

namespace Application\Model\Repository;

use App\Model\Repository\AbstractRepository;
use Application\Model\Entity\GitDataEntity;

class GitApiRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->setEntityClassName(GitDataEntity::class);
    }

    public function insertData($data)
    {
        parent::insert($data);
    }

    public function getData()
    {
        $query = <<<SQL
SELECT * FROM GITDATA
SQL;
        return $this->executeQuery($query);
    }

    public function clearDataTable()
    {
        $query = <<<SQL
DELETE FROM GITDATA
SQL;
        $this->executeQuery($query);

    }

}