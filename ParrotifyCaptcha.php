<?php

class ParrotifyCaptcha extends CInputWidget
{
    public function init()
    {
    }

    public function run()
    {
        /**
         * $this->model and $this->attribute defined in CInputWidget
         */
        $fieldName = CHtml::activeName($this->model,$this->attribute);
        echo '<script src="http://api.parrotify.com/start.js" parrotifyCaptchaConfig="name:\''.$fieldName.'\' "></script>';
    }
}