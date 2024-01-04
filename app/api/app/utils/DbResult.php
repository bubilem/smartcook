<?php
class DbResult
{

    private mysqli_result $result;

    public function __construct(mysqli_result $result)
    {
        $this->result = $result;
    }

    public function numRows(): int
    {
        return $this->result->num_rows;
    }

    public function numFields(): int
    {
        return $this->result->field_count;
    }

    public function fetchAll(): array
    {
        return $this->result->fetch_all(MYSQLI_ASSOC);
    }

}