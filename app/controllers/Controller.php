<?php


interface Controller
{
    public function handle(Request $request): Response;
    public function showForm();
    public function showHtml();

}