<?php

class View extends Fuel\Core\View
{

    protected $file;

    public function __construct($file = null, $data = null, $filter = null)
    {
        // set file
        $this->file = $file;
        // return parent construct
        return parent::__construct($file, $data, $filter);
    }

    public function file()
    {
        return $this->file;
    }


} 