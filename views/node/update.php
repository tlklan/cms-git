<?php $this->breadcrumbs = array(
	Yii::t('CmsModule.core', 'Cms')=>array('/cms'),
	Yii::t('CmsModule.core', 'Nodes')=>array('/cms/node'),
	ucfirst($model->name),
) ?>

<div class="node-update">

    <h1><?php echo Yii::t('CmsModule.core','Update :name',array(':name'=>ucfirst($model->name))) ?></h1>

	<?php $form = $this->beginWidget('TbActiveForm',array(
		'id'=>'cmsUpdateNodeForm',
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	)) ?>

		<fieldset class="form-node">

			<?php echo $form->uneditableRow($model,'name') ?>
			<?php echo $form->dropDownListRow($model,'parentId',$model->getParentOptionTree()) ?>
			<?php echo $form->radioButtonListInlineRow($model,'level',$model->getLevelOptions()) ?>
			<?php echo $form->checkBoxRow($model,'published') ?>

		</fieldset>

		<?php $tabs = array();
		foreach ($translations as $locale => $content) {
			$language = Yii::app()->cms->languages[$locale];
			$tabs[] = array('label'=>$language, 'content'=>$this->renderPartial('_form',array(
				'model'=>$content,
				'form'=>$form,
				'node'=>$model,
				'language'=>$language,
			), true), 'active'=>$locale == Yii::app()->language);
		} ?>
		
		<?php $this->widget('bootstrap.widgets.TbTabs',array(
			'tabs'=>$tabs,
		)); ?>
	
		<fieldset class="form-attachments">

			<legend><?php echo Yii::t('CmsModule.core', 'Attachments') ?></legend>

			<?php $this->widget('bootstrap.widgets.TbGridView',array(
				'id'=>'attachments_'.$model->id,
				'dataProvider'=>$model->getAttachments(),
				'template'=>'{items} {pager}',
				'emptyText'=>Yii::t('CmsModule.core', 'No attachments found.'),
				'showTableOnEmpty'=>false,
				'columns'=>array(
					array(
						'name'=>'id',
						'header'=>'#',
						'value'=>'$data->id',
					),
					array(
						'header'=>Yii::t('CmsModule.core', 'URL'),
						'value'=>'$data->resolveName()',
						'sortable'=>false,
					),
					array(
						'header'=>Yii::t('CmsModule.core', 'Tag'),
						'value'=>'$data->renderTag()',
						'sortable'=>false,
					),
					array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=>'{delete}',
						'buttons'=>array(
							'delete'=>array(
								'url'=>'Yii::app()->controller->createUrl("deleteAttachment", array("id"=>$data->id))',
							),
						),
					),
				),
			)) ?>

			<?php echo $form->fileFieldRow($model, 'attachment') ?>

		</fieldset>

		<div class="form-actions row">
			<div class="pull-left">
				<?php echo CHtml::htmlButton(Yii::t('CmsModule.core','Save'),array(
					'class'=>'btn btn-primary',
					'type'=>'submit',
				)) ?>
			</div>
			<div class="pull-right">
				<?php echo CHtml::link(Yii::t('CmsModule.core','Delete'),array('delete','id'=>$model->id),array(
					'class'=>'btn',
					'confirm'=>Yii::t('CmsModule.core','Are you sure you want to delete this node?'),
				)) ?>
			</div>
		</div>

	<?php $this->endWidget() ?>

</div>
