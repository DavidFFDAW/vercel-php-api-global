<?php

class Field
{
    private $dbName;
    private $apiName;
    private $required;
    private $type;

    public function __construct(string $dbName, string $apiName, bool $required, string $type)
    {
        $this->dbName = trim($dbName);
        $this->apiName = trim($apiName);
        $this->required = $required;
        $this->type = trim($type);
    }

    public function getDbName()
    {
        return $this->dbName;
    }

    public function getAPIName()
    {
        return $this->apiName;
    }

    public function isRequired()
    {
        return $this->required;
    }

    public function isID()
    {
        return (bool) ($this->dbName === "id");
    }

    public function getType()
    {
        return $this->type;
    }
}
