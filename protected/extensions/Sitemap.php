<?php 

class Sitemap  {

	protected $data = array();

	public function addData($more, $after = true)
	{
		if ( $after ) $this->data = array_merge( $this->data,$more);
		else $this->data = array_merge($more, $this->data);
	}
	public function renderXML()
	{
		header('Content-Type: application/xml');

		echo $this->generate();
		Yii::app()->end();
	}
	public function generate()
	{
		$xml='<?xml version="1.0" encoding="utf-8"?>
	 		<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	 		xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'.PHP_EOL;

		foreach ( $this->data as $link)
		{
			$xml .= '<url>'.PHP_EOL;
			$xml .= '<loc>'.$link['loc']. '</loc>'.PHP_EOL;
			if ( isset($link['priority']))$xml .= '<priority>'.$link['priority']. '</priority>'.PHP_EOL;
			if ( isset($link['changefreq']))$xml .= '<changefreq>'.$link['changefreq']. '</changefreq>'.PHP_EOL;
			if ( isset($link['lastmod']))$xml .= '<lastmod>'.$link['lastmod']. '</lastmod>'.PHP_EOL;
			if ( isset($link['image']))
			{
				$xml .= '<image:image>';
				$xml .= '<image:loc>' . $link['image']. '</image:loc>';
				$xml .= '</image:image>';
			}
			$xml .= '</url>'.PHP_EOL;
		}
		$xml .= '</urlset>'.PHP_EOL;
		return $xml;
	}
	public function getSitemapUrls($priority = 0.5)
	{

		$models = Product::model()->findAll();
	 	$data=array();

	    foreach($models as $model)
	    {
			
	    	$time  = strtotime($model->update_time);
    
               
	        	 $data[]=array(
	   
	                'loc'=>Yii::app()->createAbsoluteUrl(lcfirst('product').'/info',
	        	 array('id'=>$model->id,'title'=>$model->title)),
	            'changefreq'=>'daily',
	            'priority'=>$priority,
	            'lastmod'=>date('Y-m-d\TH:i:sP',$time),
	        );
	    }
	    $this->AddData ( $data);
	    return $data;
	}

	
	
}
?>