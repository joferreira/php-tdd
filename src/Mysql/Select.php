<?php

namespace QueryBuilder\Mysql;

class Select
{
    private $table;
    private $fields = [];
    private $filters;

    public function table(string $table)
    {
        $this->table = $table;
        return $this;
    }

    public function fields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function filter(Filters $filters)
    {
        $this->filters = $filters->getSql();
        return $this;
    }

    public function getSql(): string
    {   
        $fields = '*';
        if (empty($this->fields) == false) {
            $fields = implode(', ', $this->fields);
        }

        $filters = '';
        if (empty($this->filters) == false) {
            $filters = ' '.$this->filters;
        }

        $query = 'SELECT %s FROM %s%s;';        
        return sprintf($query, $fields, $this->table, $filters);
    }
}