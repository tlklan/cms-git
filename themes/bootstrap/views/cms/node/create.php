<?php $this->breadcrumbs = array(
	Yii::t('CmsModule.core','Cms')=>array('admin/index'),
	Yii::t('CmsModule.core','Create node')
) ?>

<div class="node-create">

    <h1><?php echo Yii::t('CmsModule.core','Create node') ?></h1>

	<?php $form = $this->beginWidget('BootActiveForm',array(
		'id'=>'cmsCreateNodeForm',
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	)) ?>

		<fieldset class="form-node">

			<?php echo $form->textFieldRow($model,'name',array('hint'=>Yii::t('CmsModule.core','Node name cannot be changed after creation.'))) ?>

			<?php echo $form->dropDownListRow($model,'parentId',$model->getParentOptionTree()) ?>

		</fieldset>

		<div class="form-actions">
			<?php echo CHtml::htmlButton(Yii::t('CmsModule.core','Create'),array('class'=>'btn btn-primary')) ?>
		</div>

	<?php $this->endWidget() ?>

</div>