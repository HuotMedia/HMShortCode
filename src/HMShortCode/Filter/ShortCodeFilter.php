<?php
namespace HMShortCode\Filter;

use Zend\View\HelperPluginManager;

use Zend\Mvc\Service\ViewHelperManagerFactory;

use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\ServiceManager\ServiceLocatorAwareInterface;


use Zend\Filter\AbstractFilter;

class ShortCodeFilter extends AbstractFilter implements ServiceLocatorAwareInterface
{
	protected $serviceLocator;
	public function filter($value)
	{
		$matches = Null;
		preg_match('/[{]{2}.+\[{0,1}.*\]{0,1}[}]{2}/',$value, $matches);
		foreach($matches as $match)
		{
			$value = str_replace($match, $this->convertMatchToHelper($match), $value);
		}
		
		$filtered = $value;
		return $filtered;
	}
	
	protected function convertMatchToHelper($match)
	{
		$find = array("{{","}}");
		$replace = array("");
		$match = str_replace($find, $replace, $match);
		$parts = explode("[",$match);
		$helper = trim($parts[0]);
		$data = substr_replace($parts[1],"",-1);
		$view = $this->serviceLocator->get('ViewRenderer');
		
		ob_start();
			//echo $view->customHTML(array('title'=>'Custom Content Widgets!', 'content'=>'<p>This is some content in page content yo!</p>'));
			echo $view->{$helper}($data);
		$converted = ob_get_clean();
		return $converted;
	}
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
	{
		$this->serviceLocator = $serviceLocator;
	}
	
	public function getServiceLocator()
	{
		return $this->serviceLocator;
	}
	
}