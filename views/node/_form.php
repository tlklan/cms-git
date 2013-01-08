<fieldset class="form-content">

    <?php echo $form->textFieldRow($model,'['.$model->locale.']heading',array('class'=>'span8')) ?>

    <div class="clearfix">
        <?php echo $form->labelEx($model,'['.$model->locale.']body') ?>
        <?php $this->widget('cms.widgets.markitup.CmsMarkItUp',array(
            'model'=>$model,
            'attribute'=>'['.$model->locale.']body',
            'set'=>'html',
			'htmlOptions'=>array('class'=>'span8', 'style'=>'min-height: 350px;')
        )) ?>
        <?php echo $form->error($model,'['.$model->locale.']body') ?>
		<div class="tags well">
			<?php $this->renderPartial('cms.views.node._tags'); ?>
		</div>
    </div>

	<?php echo $form->textAreaRow($model,'['.$model->locale.']css',array('class'=>'span8','rows'=>6)) ?>

</fieldset>

<?php if ($node->level === CmsNode::LEVEL_PAGE): ?>

	<fieldset class="form-page-settings">

		<legend><?php echo Yii::t('CmsModule.core','Page settings') ?></legend>

		<?php echo $form->textFieldRow($model,'['.$model->locale.']url',array('class'=>'span8')) ?>
		<?php echo $form->textFieldRow($model,'['.$model->locale.']pageTitle',array('class'=>'span8')) ?>
		<?php echo $form->textFieldRow($model,'['.$model->locale.']breadcrumb',array('class'=>'span8')) ?>
		<?php echo $form->textFieldRow($model,'['.$model->locale.']metaTitle',array('class'=>'span8')) ?>
		<?php echo $form->textAreaRow($model,'['.$model->locale.']metaDescription',array('class'=>'span8','rows'=>3)) ?>
		<?php echo $form->textFieldRow($model,'['.$model->locale.']metaKeywords',array('class'=>'span8')) ?>

		<p><?php echo CHtml::link(Yii::t('CmsModule.core','View page'), $node->getUrl(), array('class'=>'btn')); ?></p>

	</fieldset>

<?php endif; ?>