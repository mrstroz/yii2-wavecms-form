<?php

use mrstroz\wavecms\components\helpers\FormHelper;
use mrstroz\wavecms\components\helpers\WavecmsForm;
use mrstroz\wavecms\components\widgets\TabsWidget;
use mrstroz\wavecms\components\widgets\TabWidget;
use yii\bootstrap\Html;

?>

<?php $form = WavecmsForm::begin(); ?>

<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'contact']); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms/base/main', 'General')]); ?>

<div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'name'); ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'company'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'email'); ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'phone'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php echo $form->field($model, 'subject'); ?>
        <?php echo $form->field($model, 'text')->textarea([
            'rows' => 6
        ]); ?>
    </div>
</div>

<?php TabWidget::end(); ?>


<?php TabsWidget::end(); ?>
<?php FormHelper::saveButton() ?>
<?php WavecmsForm::end(); ?>
