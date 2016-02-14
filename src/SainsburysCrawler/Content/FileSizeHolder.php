<?php
namespace SainsburysCrawler\Content;
use SainsburysCrawler\Util\SizeFormatter;

/**
 * Storage for size of downloaded files
 *
 * Class FileSizeHolder
 * @package SainsburysCrawler\Content
 */
class FileSizeHolder implements FileSizeProvider
{
    /**
     * @var array
     */
    protected $fileSizes;

    /**
     * Initialize the file size storage
     */
    public function __construct() {
        $this->fileSizes = array();
    }

    /**
     * Store a file size
     * @param string $fileId
     * @param int $fileSize
     */
    public function storeFileSize($fileId, $fileSize) {
        $this->fileSizes[$fileId] = $fileSize;
    }

    /**
     * Get a file size of a fileid or give null back
     * @param string $fileId
     * @return int|null
     */
    public function getFileSize ($fileId) {
        if (isset($this->fileSizes[$fileId])) {
            return $this->fileSizes[$fileId];
        }
        return null;
    }
}