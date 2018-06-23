<?php

include_once 'Response.php';

class EmptyResponse implements Response
{
  public function send(): void
  {
  }
}