<?php

namespace App\Model\Entity;

abstract class AbstractEntity
{

    private $table;
    private $fields = [];
    private $repositoryName;

    abstract public function getMetadata();

    public function preSaveHook(){}
    public function postFetchHook(){}

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $columnName
     * @param string $dataType
     * @param string|null $alias
     * @param bool $identifier
     */
    public function setField($columnName, $dataType = 'string', $alias = null, $identifier = false)
    {
        $this->fields[$columnName] = [
            'propertyName' => $alias??$columnName,
            'type' => $dataType,
            'alias' => $alias??$columnName,
            'identifier' => $identifier,
        ];
        return $this;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     * @return AbstractEntity
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRepositoryName()
    {
        return $this->repositoryName;
    }

    /**
     * @param mixed $repositoryName
     * @return AbstractEntity
     */
    public function setRepositoryName($repositoryName)
    {
        $this->repositoryName = $repositoryName;
        return $this;
    }




}