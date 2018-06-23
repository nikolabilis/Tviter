<?php


class Request
{
    private $method;
    private $get;
    private $post;
    private $files;

    public function __construct(string $method, array $get, array $post, array $files)
    {
        $this->method=$method;
        $this->files=$files;
        $this->get=$get;
        $this->post=$post;
    }



    public function getMethod()
    {
        return $this->method;
    }


    public function getFiles(): array
    {
        return $this->files;
    }

    public function getPost(): array
    {
        return $this->post;
    }

    public function getGet(): array
    {
        return $this->get;
    }

}