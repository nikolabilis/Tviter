<?php

include_once 'Response.php';

class AttachmentResponse implements Response
{
    private $filename;
    public function __construct(string $filename)
    {
        $this->filename=$filename;
    }

    public function send(): void
    {
        header('Content-Type: text/html');
        header('Content-Length: ' . filesize($this->filename));
        header('Content-Disposition: attachment; filename="transformirani.html"');
        readfile($this->filename);
        unlink('transformirani.html');
    }
}