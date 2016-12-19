<?php namespace HandsomeMatt\GMad;

class Addon
{
    private $timestamp;
    private $steam_id;
    private $name;
    private $description;
    private $author;
    private $version;
    private $file_index;
    private $file_block_position;

    /**
     * @return integer
     */
    public function getSteamId(): ?int
    {
        return $this->steam_id;
    }

    /**
     * @param integer $steam_id
     */
    public function setSteamId(int $steam_id)
    {
        $this->steam_id = $steam_id;
    }

    /**
     * @return integer
     */
    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    /**
     * @param integer $timestamp
     */
    public function setTimestamp(int $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    /**
     * @return integer
     */
    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * @param integer $version
     */
    public function setVersion(int $version)
    {
        $this->version = $version;
    }

    /**
     * @return array
     */
    public function getFileIndex()
    {
        return $this->file_index;
    }

    /**
     * @param array $file_index
     */
    public function setFileIndex($file_index)
    {
        $this->file_index = $file_index;
    }

    /**
     * @return integer
     */
    public function getFileBlockPosition()
    {
        return $this->file_block_position;
    }

    /**
     * @param integer $file_block_position
     */
    public function setFileBlockPosition($file_block_position)
    {
        $this->file_block_position = $file_block_position;
    }
}
