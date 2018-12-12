<?php

namespace Brick\Db\Bulk;

/**
 * Deletes rows from a database table in bulk.
 */
class BulkDeleter extends BulkOperator
{
    /**
     * @inheritdoc
     */
    protected function getQuery($numRecords)
    {
        $parts = [];

        foreach ($this->fields as $field) {
            $parts[] = $field . ' = ?';
        }

        $where = '(' . implode(' AND ', $parts) . ')';

        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;
        $query .= str_repeat(' OR ' . $where, $numRecords - 1);

        return $query;
    }
}
