<?php $this->breadcrumbs = array(
	Yii::t('CmsModule.core','Cms')=>array('admin/index'),
	Yii::t('CmsModule.core','Nodes'),
) ?>

<div class="node-index">

	<h1><?php echo Yii::t('CmsModule.core','Nodes'); ?></h1>

	<p><?php echo CHtml::link('<i class="icon-file"></i> '.Yii::t('CmsModule.core','Create a new node'),array('node/create'),array('class'=>'btn')) ?></p>

	<?php 
	
	// Extend the page size
	$dataProvider = $model->search();
	$dataProvider->pagination = array(
		'pageSize'=>50,
	);
	
	$this->widget('bootstrap.widgets.BootGridView',array(
		'dataProvider'=>$dataProvider,
		'columns'=>array(
			'id',
			'name',
			array(
				'name'=>'parentId',
				'value'=>'$data->parent !== null ? $data->parent->name : ""',
			),
			array(
				'class'=>'BootButtonColumn',
				'viewButtonUrl'=>'Yii::app()->cms->createUrl($data->name)',
			),
		),
	)) ?>

</div>