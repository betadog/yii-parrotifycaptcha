<?php

class ParrotifyCaptchaValidator extends CValidator
{
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
        $c = curl_init("http://api.parrotify.com/validate");
        curl_setopt_array($c, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
        ));
        /**
         * $result == 0 - when captcha code incorrect
         * $result == 1 - when captcha code correct
         */
        $result = curl_exec($c);

        if ($result == 0) {
            $message = $this->message !== null
                ? $this->message
                : 'The verification code is incorrect';
            $this->addError($object, $attribute, $message);
        }
    }
}