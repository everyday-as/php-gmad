<?php namespace HandsomeMatt\GMad;

use PhpBinaryReader\BinaryReader;

class AddonReader
{
    private $buffer;
    private $addon;

    public function __construct($stream)
    {
        $this->buffer = $stream;
        $this->addon = new Addon();
    }

    public function parse()
    {
        if ($this->buffer === null)
            throw new \Exception("No buffer");

        $reader = new BinaryReader($this->buffer);

        if ($reader->readString(4) !== "GMAD")
            throw new \Exception("Header mismatch");

        $file_format_version = $reader->readInt8();
        $this->addon->setSteamId($reader->readUInt64());
        $this->addon->setTimestamp($reader->readUInt64());

        if ($file_format_version > 1)
        {
            $content = $this->readNullString($reader);

            while($content !== '')
                $content = $this->readNullString($reader);
        }

        $this->addon->setName($this->readNullString($reader));
        $this->addon->setDescription($this->readNullString($reader));
        $this->addon->setAuthor($this->readNullString($reader));
        $this->addon->setVersion($reader->readInt32());

        $addon_file_index = [];
        $offset = 0;
        $file_number = 1;

        while($reader->readUInt32() != 0)
        {
            $index_entry = new IndexEntry();

            $index_entry->setPath($this->readNullString($reader));
            $index_entry->setSize($reader->readInt64());
            $index_entry->setCrc($reader->readUInt32());
            $index_entry->setOffset($offset);
            $index_entry->setFileNumber($file_number);

            $addon_file_index[$file_number] = $index_entry;

            $offset += $index_entry->getSize();
            $file_number++;
        }

        $this->addon->setFileIndex($addon_file_index);
        $this->addon->setFileBlockPosition($reader->getPosition());
    }

    /**
     * @param resource $buffer
     */
    public function setBuffer($buffer)
    {
        $this->buffer = $buffer;
    }

    /**
     * @return \HandsomeMatt\GMad\Addon
     */
    public function getAddon(): ?\HandsomeMatt\GMad\Addon
    {
        return $this->addon;
    }

    private function readNullString($reader)
    {
        $str = '';

        while(true)
        {
            if(!$reader->canReadBytes(1))
                break;

            $char = $reader->readInt8();

            if($char == "\0")
                break;

            $str = $str . chr($char);
        }

        return $str;
    }
}