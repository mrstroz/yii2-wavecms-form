<?php

use dosamigos\switchinput\SwitchBox;
use mrstroz\wavecms\components\helpers\FormHelper;
use mrstroz\wavecms\components\helpers\WavecmsForm;
use mrstroz\wavecms\components\widgets\CKEditorWidget;
use mrstroz\wavecms\components\widgets\TabsWidget;
use mrstroz\wavecms\components\widgets\TabWidget;
use mrstroz\wavecms\form\models\Form;
use yii\bootstrap\Html;

?>

<?php $form = WavecmsForm::begin(); ?>
<?php TabsWidget::begin(); ?>

<?= Html::activeHiddenInput($model, 'type', ['value' => 'contact']); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms_form/main', 'Admin email')]); ?>

<?= $form->field($model, 'send_email')->widget(SwitchBox::class, [
    'options' => [
        'label' => false
    ],
    'clientOptions' => [
        'onColor' => 'success',
    ]
]); ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'from_email'); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'from_name'); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'recipient')->hint(Yii::t('wavecms_form/main', 'Separate by comma')); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <?= $form->field($model, 'subject'); ?>
        <?= $form->field($model, 'text')->widget(CKEditorWidget::class) ?>
    </div>
    <div class="col-md-3">
        <b><?= Yii::t('wavecms_form/main', 'Tags'); ?>:</b>
        <hr />
        <table class="table table-bordered table-striped">
            <tr>
                <th><?= Yii::t('wavecms_form/main', 'Table'); ?></th>
                <td>{table}</td>
            </tr>
            <?php
            $formModel = Yii::createObject(Form::class);
            ?>
            <?php foreach ($formModel->attributes as $key => $attribute): ?>
                <tr>
                    <th><?= $formModel->getAttributeLabel($key); ?></th>
                    <td>{<?= $key; ?>}</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php TabWidget::end(); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms_form/main', 'User email')]); ?>

<?= $form->field($model, 'user_send_email')->widget(SwitchBox::class, [
    'options' => [
        'label' => false
    ],
    'clientOptions' => [
        'onColor' => 'success',
    ]
]); ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'user_from_email'); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'user_from_name'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <?= $form->field($model, 'user_subject'); ?>
        <?= $form->field($model, 'user_text')->widget(CKEditorWidget::class) ?>
    </div>
    <div class="col-md-3">
        <b><?= Yii::t('wavecms_form/main', 'Tags'); ?>:</b>
        <hr />
        <table class="table table-bordered table-striped">
            <?php
            $formModel = Yii::createObject(Form::class);
            ?>
            <?php foreach ($formModel->attributes as $key => $attribute): ?>
                <tr>
                    <th><?= $formModel->getAttributeLabel($key); ?></th>
                    <td>{<?= $key; ?>}</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php TabWidget::end(); ?>


<?php TabWidget::begin(['heading' => Yii::t('wavecms_form/main', 'Thanks text')]); ?>

<?= $form->field($model, 'thanks_text')->widget(CKEditorWidget::class) ?>

<?php TabWidget::end(); ?>


<?php TabsWidget::end(); ?>
<?php FormHelper::saveButton() ?>
<?php WavecmsForm::end(); ?>
