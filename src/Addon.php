<?php namespace GmodStore\GMad;

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
     * @return Addon
     */
    public function setSteamId(int $steam_id): Addon
    {
        $this->steam_id = $steam_id;
        return $this;
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
     * @return Addon
     */
    public function setTimestamp(int $timestamp): Addon
    {
        $this->timestamp = $timestamp;
        return $this;
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
     * @return Addon
     */
    public function setName(string $name): Addon
    {
        $this->name = $name;
        return $this;
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
     * @return Addon
     */
    public function setDescription(string $description): Addon
    {
        $this->description = $description;
        return $this;
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
     * @return Addon
     */
    public function setAuthor(string $author): Addon
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return integer
     */
    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return Addon
     */
    public function setVersion(int $version): Addon
    {
        $this->version = $version;
        return $this;
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
     * @return Addon
     */
    public function setFileIndex($file_index): Addon
    {
        $this->file_index = $file_index;
        return $this;
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
     * @return Addon
     */
    public function setFileBlockPosition($file_block_position): Addon
    {
        $this->file_block_position = $file_block_position;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Addon ' . $this->getName() . ' by ' . $this->getAuthor();
    }
}
