<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessTrip */

$this->title = 'Create Business Trip';
$this->params['breadcrumbs'][] = ['label' => 'Business Trips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$js = "
$(function () {
    $('.dynamicform_wrapper').on('afterInsert', function(e, item) {
         $( '.picker' ).each(function() {
            $( this ).datepicker({
            dateFormat : 'yy-mm-dd',
            onClose : function(dateText, inst) { 
                let secondFieldName = '-begin_date';                 
                let beginDate = new Date(dateText);

                //получение обласи изменения формы                
                let formScope = inst.id.substring(0, 14); 
                let fieldName = inst.id.substring(15); 
                
                //получение имени противоположной даты
                if(fieldName == 'begin_date'){
                    secondFieldName = '-end_date';
                }

                //получение противоположного значения даты 
                let secondFieldVal = $('input[id*=' + formScope + secondFieldName + ']').val();

                function isEmpty(str) {
                    if (str.trim() == ''){
                        return false;
                    }else{
                        return true;
                    }                                                            
                  }

                //если противоположное значение не пустое произвести вычесления
                if(isEmpty(secondFieldVal)){

                    let endDate = new Date(secondFieldVal); 
                    let beginDate2 = beginDate.getTime();
                    let endDate2 = endDate.getTime();
                    
                    if (endDate2 > beginDate2) {
                        let timeDiff = Math.abs(endDate2 - beginDate2);
                        let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                        // console.log(diffDays);
                        $('input[id*=' + formScope + '-date_count' + ']').val(diffDays);
                      }  else {
                        let timeDiff = Math.abs(beginDate2 - endDate2);
                        let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                        // console.log(diffDays); 
                        $('input[id*=' + formScope + '-date_count' + ']').val(diffDays);
                      } 
                }
            }, 
            language : 'ru'
          });
        });
    });
});       
";


$this->registerJs($js);
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?php // $form->field($modelCustomer, 'first_name')->textInput(['maxlength' => true]) 
            ?>
        </div>
        <div class="col-sm-6">
            <?php // $form->field($modelCustomer, 'last_name')->textInput(['maxlength' => true]) 
            ?>
        </div>
    </div>

    <div class="panel panel-default">

        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $models[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'full_name',
                    'user_post',
                    'company',
                    'begin_date',
                    'end_date',
                    'date_count',
                    'user_object',
                    'user_project',
                    'user_direction',
                    'trip_target',
                    'user_amount',
                    'user_total',
                    'status'
                ],
            ]); ?>

            <div class="container-items">
                <!-- widgetContainer -->
                <?php foreach ($models as $i => $model) : ?>
                    <div class="item panel panel-default">
                        <!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Запрос</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$model->isNewRecord) {
                                echo Html::activeHiddenInput($model, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]full_name")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]user_post")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]company")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]user_project")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div><!-- .row -->
                            <div class="row">
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]begin_date")->widget(\yii\jui\DatePicker::classname(), [
                                        'language' => 'ru',
                                        'dateFormat' => 'yyyy-MM-dd',
                                        'clientOptions' => [
                                            'onSelect' => new \yii\web\JsExpression("function(dateText, inst) { 
                                            let secondFieldName = '-begin_date';                 
                let beginDate = new Date(dateText);

                //получение обласи изменения формы                
                let formScope = inst.id.substring(0, 14); 
                let fieldName = inst.id.substring(15); 
                
                //получение имени противоположной даты
                if(fieldName == 'begin_date'){
                    secondFieldName = '-end_date';
                }

                //получение противоположного значения даты 
                let secondFieldVal = $('input[id*=' + formScope + secondFieldName + ']').val();

                function isEmpty(str) {
                    if (str.trim() == ''){
                        return false;
                    }else{
                        return true;
                    }                                                            
                  }

                //если противоположное значение не пустое произвести вычесления
                if(isEmpty(secondFieldVal)){

                    let endDate = new Date(secondFieldVal); 
                    let beginDate2 = beginDate.getTime();
                    let endDate2 = endDate.getTime();
                    
                    if (endDate2 > beginDate2) {
                        let timeDiff = Math.abs(endDate2 - beginDate2);
                        let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                        // console.log(diffDays);
                        $('input[id*=' + formScope + '-date_count' + ']').val(diffDays);
                      }  else {
                        let timeDiff = Math.abs(beginDate2 - endDate2);
                        let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                        // console.log(diffDays); 
                        $('input[id*=' + formScope + '-date_count' + ']').val(diffDays);
                      } 
                }
                                        }")
                                        ],
                                        'options' => ['class' => 'form-control picker', 'autocomplete' => 'off']
                                    ]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]end_date")->widget(\yii\jui\DatePicker::classname(), [
                                        'language' => 'ru',
                                        'dateFormat' => 'yyyy-MM-dd',
                                        'clientOptions' => [
                                            'onSelect' => new \yii\web\JsExpression("function(dateText, inst) { 
                                            let secondFieldName = '-begin_date';                 
                let beginDate = new Date(dateText);

                //получение обласи изменения формы                
                let formScope = inst.id.substring(0, 14); 
                let fieldName = inst.id.substring(15); 
                
                //получение имени противоположной даты
                if(fieldName == 'begin_date'){
                    secondFieldName = '-end_date';
                }

                //получение противоположного значения даты 
                let secondFieldVal = $('input[id*=' + formScope + secondFieldName + ']').val();

                function isEmpty(str) {
                    if (str.trim() == ''){
                        return false;
                    }else{
                        return true;
                    }                                                            
                  }

                //если противоположное значение не пустое произвести вычесления
                if(isEmpty(secondFieldVal)){

                    let endDate = new Date(secondFieldVal); 
                    let beginDate2 = beginDate.getTime();
                    let endDate2 = endDate.getTime();
                    
                    if (endDate2 > beginDate2) {
                        let timeDiff = Math.abs(endDate2 - beginDate2);
                        let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                        // console.log(diffDays);
                        $('input[id*=' + formScope + '-date_count' + ']').val(diffDays);
                      }  else {
                        let timeDiff = Math.abs(beginDate2 - endDate2);
                        let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                        // console.log(diffDays); 
                        $('input[id*=' + formScope + '-date_count' + ']').val(diffDays);
                      } 
                } 
                                        }")
                                        ],
                                        'options' => ['class' => 'form-control picker', 'autocomplete' => 'off']
                                    ]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]date_count")->textInput() ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]user_object")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div><!-- .row -->
                            <div class="row">
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]user_direction")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]trip_target")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]user_amount")->textInput([
                                        'maxlength' => true,
                                        'onchange'=>"
                                            let elementId = $(this).attr('id');
                                            let formScope = elementId.substring(0, 14); 
                                            let fieldName = elementId.substring(15);

                                            let dateCountVal = $('input[id*=' + formScope + '-date_count' + ']').val();

                                            function isEmpty(str) {
                                                if (str.trim() == ''){
                                                    return false;
                                                }else{
                                                    return true;
                                                }                                                            
                                              }

                                            //если поле количество дней не пустое произвести вычесления
                                            if(isEmpty(dateCountVal)){
                                                let dayCountInt = parseInt(dateCountVal);
                                                let amountVal = parseInt($(this).val());
                                                let result = dayCountInt * amountVal;
                                                $('input[id*=' + formScope + '-user_total' + ']').val(result);                                                
                                            }                                                                                     
                                        "
                                        ]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]user_total")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>