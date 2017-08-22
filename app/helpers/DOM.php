<?php

class DOM{
  // $dom=new DOMDocument();
  public static function findAttribute($phpfile,$elementid,$attr)
	{
		$dom=new DOMDocument();
		$dom->loadHTML($phpfile);
        $element=$dom->getElementsById($elementid);
        $src=$element->getAttribute($attr);
        echo $src;
		
	}


}