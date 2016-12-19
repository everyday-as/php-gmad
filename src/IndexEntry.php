<?php namespace HandsomeMatt\GMad;

class IndexEntry
{
    private $path;
    private $size;
    private $crc;
    private $offset;
    private $file_number;

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param integer $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return integer
     */
    public function getCrc()
    {
        return $this->crc;
    }

    /**
     * @param integer $crc
     */
    public function setCrc($crc)
    {
        $this->crc = $crc;
    }

    /**
     * @return integer
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param integer $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return integer
     */
    public function getFileNumber()
    {
        return $this->file_number;
    }

    /**
     * @param integer $file_number
     */
    public function setFileNumber($file_number)
    {
        $this->file_number = $file_number;
    }
}