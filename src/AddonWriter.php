<?php namespace GmodStore\GMad;

use GmodStore\GMad\Exceptions\InvalidFileException;
use PhpBinaryReader\BinaryReader;

/**
 * Class AddonWriter
 * @package GmodStore\GMad
 */
class AddonWriter
{
    const FILE_FORMAT_VERSION = 3;

    protected $handle;

    /**
     * @var AddonMeta
     */
    protected $addon_meta;

    protected $files;

    public function __construct($handle)
    {
        $this->handle = $handle;
    }

    /**
     * Write the provided AddonMeta and files to the provided handle.
     * @throws \Exception
     */
    public function write()
    {
        if ($this->addon_meta == null)
            throw new \Exception("Addon meta not defined.");

        $this->writeMetaData();
        $this->writeFileMetaData();
        $this->writeFiles();
        $this->writeChecksum();
    }

    private function writeMetaData()
    {
        // pack our values into strings.
        $format_version = pack('C', self::FILE_FORMAT_VERSION);
        $steam_id = pack('Q', $this->addon_meta->getSteamID());
        $timestamp = pack('Q', $this->addon_meta->getTimestamp());
        $required_content = "\0";
        $name = $this->addon_meta->getName() . "\0";
        $description = $this->addon_meta->getDescription() . "\0";
        $author = $this->addon_meta->getAuthor() . "\0";
        $version = pack('L', $this->addon_meta->getVersion());

        // write it to the handle
        fwrite($this->handle, "GMAD", 4);
        fwrite($this->handle, $format_version, 1);
        fwrite($this->handle, $steam_id, 8);
        fwrite($this->handle, $timestamp, 8);
        fwrite($this->handle, $required_content, 1);
        fwrite($this->handle, $name);
        fwrite($this->handle, $description);
        fwrite($this->handle, $author);
        fwrite($this->handle, $version, 4);
    }

    private function writeFileMetaData()
    {
        $file_number = 1;

        foreach($this->files as $path => $file)
        {
            $file_length = strlen($file);
            $crc32 = hash('crc32', $file, true);

            $pnum = pack('L', $file_number);
            $ppath = strtolower($path) . "\0";
            $psize = pack('Q', $file_length);
            $pcrc32 = pack('L', $crc32);

            fwrite($this->handle, $pnum, 4);
            fwrite($this->handle, $ppath);
            fwrite($this->handle, $psize, 8);
            fwrite($this->handle, $pcrc32, 4);

            unset($file); // memory management
            $file_number++;
        }
    }

    private function writeFiles()
    {
        foreach($this->files as $path => $file)
        {
            fwrite($this->handle, $file);
        }
    }

    private function writeChecksum()
    {
        $eof = ftell($this->handle);
        fseek($this->handle, 0, SEEK_SET);

        $contents = fread($this->handle, $eof);
        $crc32 = hash('crc32', $contents, true);

        fwrite($this->handle, $crc32, 4);

        unset($contents); // memory management
    }

    /**
     * @return mixed
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param mixed $handle
     * @return AddonWriter
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
        return $this;
    }

    /**
     * @return AddonMeta
     */
    public function getAddonMeta()
    {
        return $this->addon_meta;
    }

    /**
     * @param AddonMeta $addon_meta
     * @return AddonWriter
     */
    public function setAddonMeta($addon_meta)
    {
        $this->addon_meta = $addon_meta;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param mixed $files
     */
    public function setFiles($files): void
    {
        $this->files = $files;
    }
}
