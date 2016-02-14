<?php
namespace SainsburysCrawler\Content;

/**
 * Interface FileSizeProvider
 * @package SainsburysCrawler\Content
 */
interface FileSizeProvider
{
    /**
     * Provide the size of a download file
     * @param $fileId
     * @return mixed
     */
    public function getFileSize($fileId);
}