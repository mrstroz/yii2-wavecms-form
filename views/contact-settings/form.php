<?php

use dosamigos\switchinput\SwitchBox;
use mrstroz\wavecms\components\helpers\FormHelper;
use mrstroz\wavecms\components\helpers\WavecmsForm;
use mrstroz\wavecms\components\widgets\CKEditorWidget;
use mrstroz\wavecms\components\widgets\TabsWidget;
use mrstroz\wavecms\components\widgets\TabWidget;
use yii\bootstrap\Html;

?>

<?php $form = WavecmsForm::begin(); ?>
<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'contact']); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms/base/main', 'General')]); ?>

<?php echo $form->field($model, 'send_email')->widget(SwitchBox::className(), [
    'options' => [
        'label' => false
    ],
    'clientOptions' => [
        'onColor' => 'success',
    ]
]); ?>

<div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'from_email'); ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'from_name'); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php echo $form->field($model, 'recipient')->hint(Yii::t('wavecms/form/main', 'Separate by comma')); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <?php echo $form->field($model, 'subject'); ?>
        <?php echo $form->field($model, 'text')->widget(CKEditorWidget::className()) ?>
    </div>
    <div class="col-md-2">
        <b><?php echo Yii::t('wavecms/form/main', 'Tags'); ?>:</b><br/>
        <table class="table table-bordered table-striped">
            <tr>
                <td>{created_at}</td>
            </tr>
            <tr>
                <td>{name}</td>
            </tr>
            <tr>
                <td>{company}</td>
            </tr>
            <tr>
                <td>{email}</td>
            </tr>
            <tr>
                <td>{phone}</td>
            </tr>
            <tr>
                <td>{subject}</td>
            </tr>
            <tr>
                <td>{text}</td>
            </tr>
        </table>
    </div>
</div>

<?php TabWidget::end(); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms/form/main', 'Thanks text')]); ?>

<?php echo $form->field($model, 'thanks_text')->widget(CKEditorWidget::className()) ?>

<?php TabWidget::end(); ?>


<?php TabsWidget::end(); ?>
<?php FormHelper::saveButton() ?>
<?php WavecmsForm::end(); ?>
