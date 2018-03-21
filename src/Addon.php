<?php namespace GmodStore\GMad;

/**
 * Addon represents a GMod addon file archive.
 * @package GmodStore\GMad
 */
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
     * Gets the 64-bit SteamID of the owner of the addon.
     *
     * @return integer
     */
    public function getSteamId(): ?int
    {
        return $this->steam_id;
    }

    /**
     * Sets the 64-bit SteamID of the owner of the addon.
     *
     * @param integer $steam_id
     * @return Addon
     */
    public function setSteamId(int $steam_id): Addon
    {
        $this->steam_id = $steam_id;
        return $this;
    }

    /**
     * Gets the creation timestamp of the addon.
     *
     * @return integer
     */
    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    /**
     * Sets the creation timestamp of the addon.
     *
     * @param integer $timestamp
     * @return Addon
     */
    public function setTimestamp(int $timestamp): Addon
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * Gets the name of the addon.
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets the name of the addon.
     *
     * @param string $name
     * @return Addon
     */
    public function setName(string $name): Addon
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the description of the addon.
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets the description of the addon.
     *
     * @param string $description
     * @return Addon
     */
    public function setDescription(string $description): Addon
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets the author's signed name of the addon.
     *
     * @return string
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * Sets the author's signed name of the addon.
     *
     * @param string $author
     * @return Addon
     */
    public function setAuthor(string $author): Addon
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Gets the addon version integer.
     *
     * @return integer
     */
    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * Sets the addon version integer.
     *
     * @param int $version
     * @return Addon
     */
    public function setVersion(int $version): Addon
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Gets the file index, an array of IndexEntries that represent path, size, etc..
     *
     * @return array
     */
    public function getFileIndex(): array
    {
        return $this->file_index;
    }

    /**
     * Sets the file index, an array of IndexEntries that represent path, size, etc..
     *
     * @internal Used by the AddonReader
     * @param array $file_index
     * @return Addon
     */
    public function setFileIndex($file_index): Addon
    {
        $this->file_index = $file_index;
        return $this;
    }

    /**
     * Gets the file block position, this is where the file data starts in the archive
     *
     * @return integer
     */
    public function getFileBlockPosition()
    {
        return $this->file_block_position;
    }

    /**
     * Sets the file block position, where the file data starts in the archive.
     *
     * @internal Used by the AddonReader
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
