<?php
class Blogs extends DPortlet
{
 
  protected function renderContent()
  {
    echo 'Blogs Content';
  }
 
  protected function getTitle()
  {
    return 'Blogs';
  }
 
  protected function getClassName()
  {
    return __CLASS__;
  }
}
?>