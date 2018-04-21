<?php

namespace GmodStore\GMad;

class AddonMeta
{
    protected $steamID;
    protected $timestamp;
    protected $name;
    protected $description;
    protected $author;
    protected $version;

    /**
     * @return int
     */
    public function getSteamID()
    {
        return $this->steamID;
    }

    /**
     * @param int $steamID
     * @return AddonMeta
     */
    public function setSteamID($steamID)
    {
        $this->steamID = $steamID;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     * @return AddonMeta
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AddonMeta
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return AddonMeta
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return AddonMeta
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return AddonMeta
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }


}