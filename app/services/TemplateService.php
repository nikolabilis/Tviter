<?php

declare(strict_types = 1);

class TemplateService
{
    private $baseFile = '';

    public function __construct(string $baseFile)
    {
        $this->baseFile = getcwd() . '/' . $baseFile;
    }

    public function render(string $file, array $arguments = [0]): string
    {
        extract($arguments);
        ob_start();
        include ($this->baseFile . '/' . $file);
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
}