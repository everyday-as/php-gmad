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
        $required_content = pack('C', 0);
        $name = pack('Z', $this->addon_meta->getName());
        $description = pack('Z', $this->addon_meta->getDescription());
        $author = pack('Z', $this->addon_meta->getAuthor());
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
        $files = [];
        $nFiles = count($files);

        for ($i = 0; $i < $nFiles; $i++) {
            $file = $files[$i];

            $path = pack('Z', $file->path);
            $size = pack('Q', $file->size);
            $crc = pack('L', $file->crc);

            // iFileNum (starts at 1)

            /*unsigned int	iCRC = File::CRC( strFolder + *f );
			long long		iSize = File::Size( strFolder + *f );
			iFileNum++;
			buffer.WriteType( ( unsigned int ) iFileNum );					// File number (4)
			buffer.WriteString( String::GetLower( *f ) );					// File name (all lower case!) (n)
			buffer.WriteType( ( long long ) iSize );						// File size (8)
			buffer.WriteType( ( unsigned int ) iCRC );						// File CRC (4)*/

        }
    }

    private function writeFiles()
    {
        $files = [];
        $nFiles = count($files);

        for ($i = 0; $i < $nFiles; $i++) {
            $file = $files[$i];

            fwrite($this->handle, $file);
        }
    }

    private function writeChecksum()
    {
        // unsigned int AddonCRC = Hasher::CRC32::Easy( buffer.GetBase(), buffer.GetWritten() );
        // buffer.WriteType( AddonCRC );
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


}