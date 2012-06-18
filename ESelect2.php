<?php 
/**
 * Wrapper for ivaynberg jQuery select2 (https://github.com/ivaynberg/select2)
 * 
 * @author Anggiajuang Patria <anggiaj@gmail.com>
 */
class ESelect2 extends CInputWidget
{
  /**
   * @var array select2 options
   */
  public $options=array();
  /**
   * @var array CHtml::dropDownList $data param
   */
  public $data=array();
  /**
   * @var integer Script position
   */
  public $scriptPosition=null;
  public function run()
  {
    list($this->name,$this->id)=$this->resolveNameId();
    if($this->hasModel())
    {
      echo CHtml::activeDropDownList($this->model,$this->attribute,$this->data,$this->htmlOptions);
    }
    else
    {
      $this->htmlOptions['id']=$this->id;
      echo CHtml::dropDownList($this->name,$this->value,$this->data,$this->htmlOptions);
    }
    
    $bu=Yii::app()->assetManager->publish(dirname(__FILE__).'/assets');
    $cs=Yii::app()->clientScript;
    $cs->registerCssFile($bu.'/select2.css');
    if($this->scriptPosition===null) $this->scriptPosition=$cs->coreScriptPosition;
    $cs->registerScriptFile($bu.'/select2.min.js',$this->scriptPosition);
    $options=$this->options?CJavaScript::encode($this->options):'';
    $cs->registerScript(__CLASS__.'#'.$this->id,"$('#{$this->id}').select2({$options});");
  }
}
