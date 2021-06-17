<?php


namespace src\FileRead\Filter;


use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class ProductsFilter implements IReadFilter
{
    private array $columns  = [];
    private int $startRow = 0;
    private int $endRow = 0;

    public function __construct(array $columns,int $startRom, int $endRom){
        $this->columns = $columns;
        $this->startRow = $startRom;
        $this->endRow = $endRom;
    }
    public function readCell($column, $row, $worksheetName = '')
    {
        if($row >= $this->startRow && $row <= $this->endRow ){
            if (in_array($column,$this->columns)) {
                return true;
         }
        }
        return false;
    }
}