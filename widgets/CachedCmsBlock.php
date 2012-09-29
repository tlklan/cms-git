<?php

Yii::import('cms.widgets.CmsBlock');

/**
 * Cachable CmsBlock widget. It automatically cached the widget fragment 
 * either for the set duration or until the content table has been changed. It 
 * also keeps different cached copies for administrators and normal users to 
 * prevent the update button from being displayed to visitors.
 *
 * @author Sam Stenvall <sam@supportersplace.com>
 */
class CachedCmsBlock extends CmsBlock
{

	/**
	 * @var int the cache duration. Defaults to one hour (86400 seconds).
	 */
	public $duration = 86400;

	/**
	 * Runs the widget 
	 */
	public function run()
	{
		$cacheDependency = new CdbModifiedDependency('cms_content');
		$website = WebSite::model()->findCurrent();

		if ($this->beginCache($this->name.'_'.$website->id, array(
			'duration'=>$this->duration,
			'dependency'=>$cacheDependency,
			'varyByExpression'=>'Yii::app()->cms->checkAccess()'
		)))
		{
			parent::run();

			$this->endCache();
		}
	}

}