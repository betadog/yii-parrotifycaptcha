<?php

class ParrotifyCaptcha extends CInputWidget
{
    /**
     * color for captcha controls, format like CSS, but without '#'
     * ex: '45EF00'
     * @var null
     */
    public $color = null;

    /**
     * encoding output html
     * possible encoding: 'WINDOWS-1251' or 'KOI8-R' or 'UTF-8'(default encoding)
     * @var null
     */
    public $encoding = null;

    
    public function init()
    {
    }

    public function run()
    {
        /**
         * $this->model and $this->attribute defined in CInputWidget
         */
        $config = array();
        if ($this->encoding)
            $config['encoding'] = strtoupper($this->encoding);

        if ($this->color)
            $config['color'] = strtoupper($this->color);

        if ($this->attribute)
            $config['name'] = CHtml::activeName($this->model,$this->attribute);

        $config = CJSON::encode($config);
        $config = substr($config,1,-1);

        echo '<script src="http://api.reklamper.com/start.js" captchaConfig=\''.$config.'\'></script>';
    }
}