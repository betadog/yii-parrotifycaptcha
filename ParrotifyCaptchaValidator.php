<?php

class ParrotifyCaptchaValidator extends CValidator
{
    protected $_url = 'http://api.reklamper.com/validate';

    /**
     * @param $object - instanceof CModel
     * @param $attribute
     */
    protected function validateAttribute($object, $attribute)
    {
        $cookie = Yii::app()->request->cookies["_cpathca"];
        $data = array(
            'captcha[value]' => $object->$attribute,
            'captcha[key]'   => $cookie ? $cookie->value : null,
        );


        /**
         * $result == 0 - when captcha code incorrect
         * $result == 1 - when captcha code correct
         */
        $result = $this->_getResult($data);

        if ($result == 0) {
            $message = $this->message !== null
                ? $this->message
                : 'The verification code is incorrect';
            $this->addError($object, $attribute, $message);
        }
    }


    protected function _getResult($data)
    {
        $data = http_build_query($data);
        return extension_loaded('curl')
            ? $this->_resultCurl($data)
            : $this->_resultFopen($data);
    }
    protected function _resultCurl($data)
    {
        $c = curl_init($this->_url);
        curl_setopt_array($c, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
        ));
        return curl_exec($c);
    }
    protected function _resultFopen($data)
    {
        $options = array(
            'http'=> array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $data,
            ),
        );
        $context = stream_context_create($options);
        $fp = fopen($this->_url, 'rb', false, $context);
        $result = stream_get_contents($fp);
        fclose($fp);
        return $result;
    }
}