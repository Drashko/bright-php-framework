<?php
declare(strict_types=1);

namespace src\Utility;

class Paginator
{

    /** @var ?float */
    protected ?float $totalPages =  null;

    /** @var ?int */
    protected ?int $page = null;

    /** @var float */
    protected float $offset;







    private ?int $totalRecords = null;

    private ?int $recordsPerPage = null;

    /**
     * Class constructor
     *
     * @param integer $totalRecords Total number of records
     * @param integer $recordsPerPage Number of records on each page
     * @param int $page Current page
     *
     */
    public function __construct()//int $totalRecords, int $recordsPerPage, int $page
    {
        // Make sure the page number is within a valid range from 1 to the total number of pages
        //$this->totalPages = ceil($this->totalRecords / $this->recordsPerPage);
        //$data = [
           // 'options' => [
               /// 'default' => 1,
               // 'min_range' => 1,
               // 'max_range' => $this->totalPages
            //]
      //  ];
        //$this->page = filter_var($page, FILTER_VALIDATE_INT, $data);
        //$this->page = $page;
        // Calculate the starting record based on the page and number of records per page
        //$this->offset = $recordsPerPage * ($this->page - 1);
    }

    /**
     * Get the starting record within the SQL Query
     *
     * @return int
     */
    public function getOffset() : int
    {
        $this->offset = $this->recordsPerPage * ($this->page - 1);
        return (int) abs($this->offset);
    }

    /**
     * Gte the current page
     *
     * @return int
     */
    public function getPage() : int
    {
        return (int)$this->page;
    }

    /**
     * Get the total number of pages
     *
     * @return float|null
     */
    public function getTotalPages() : float | null
    {

        if(!empty($this->totalRecords)){
            $this->totalPages = ceil( $this->totalRecords / $this->recordsPerPage);
            return $this->totalPages;
        }
        return null;

    }

    public function setTotalRecords(int $totalRecords){
        $this->totalRecords = $totalRecords;
    }

    public function setRecordsPerPage(int $recordsPerPage){
        $this->recordsPerPage = $recordsPerPage;
    }

    public function setPage(int $page){
        $this->page = $page;
    }

    /**
     * // Make sure the page number is within a valid range from 1 to the total number of pages
        $this->totalPages = ceil($this->totalRecords / $this->recordsPerPage);
        $data = [
        'options' => [
        'default' => 1,
        'min_range' => 1,
        'max_range' => $this->totalPages
        ]
        ];
        //$this->page = filter_var($page, FILTER_VALIDATE_INT, $data);
        $this->page = $page;
        // Calculate the starting record based on the page and number of records per page
        $this->offset = $recordsPerPage * ($this->page - 1);
     */
}