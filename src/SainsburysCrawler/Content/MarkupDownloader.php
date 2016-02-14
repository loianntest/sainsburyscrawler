<?php
namespace SainsburysCrawler\Content;


class MarkupDownloader implements MarkupProvider
{

    /**
     * @param FileSizeHolder $fileSizeHolder
     */
    public function __construct(FileSizeHolder $fileSizeHolder) {
        $this->fileSizeHolder = $fileSizeHolder;
    }

    /**
     * Get the markup from the source
     * @return string
     * @throws DocumentNotFoundException
     */
    public function getMarkup($source)
    {

        set_error_handler(
            create_function(
                '$severity, $message, $file, $line',
                'throw new SainsburysCrawler\Content\DocumentNotFoundException($file);'
            )
        );

        $markup = file_get_contents($source);

        restore_error_handler();

        if ($markup === false) {
            throw new DocumentNotFoundException($source);
        }

        $this->fileSizeHolder->storeFileSize($source, strlen($markup));
        return $markup;
    }
}