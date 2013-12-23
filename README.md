yii-parrotifycaptcha
====================

Try out [demonstration](http://parrotify.com/demo).

### How install captcha widget in your project ###
Extract files from archive to folder: `ext.parrotifyCaptcha`


In model declare attribute and add validation rules:
```php
class Comments extends CActiveRecord
{
    public $parrotifyCaptcha;
    
    public function rules()
    {
        return array_merge( parent::rules(), array(
            array('parrotifyCaptcha','required',),
            array('parrotifyCaptcha','ext.parrotifyCaptcha.ParrotifyCaptchaValidator',
                // custom error message:
                'message' => 'Validation code is incorrect',
            ),
        ));
    }
    
    // other functions
}
```

in view file show widget:
```php

<?php 
    // summon widget
    $this->widget(
        'ext.parrotifyCaptcha.ParrotifyCaptcha', 
        array( 
            'model' => $model, 
            'attribute' => 'parrotifyCaptcha', // its attribute name
        )
    );
    
    //and error message
    echo CHtml::error($model,'parrotifyCaptcha');
?>

```

### Install via composer ###

Add package to `composer.json`:
```
"parrotify/yii-parrotifycaptcha": "dev-master"
```

Add `vendor` alias into `/index.php`:
```php
...
$vendorPath = ABSOLUTE_PATH_TO_COMPOSER.'/vendor');
Yii::setPathOfAlias('vendor', $vendorPath);
...
```

In model declare attribute and add validation rules:
```php
array('parrotifyCaptcha','vendor.parrotify.yii-parrotifycaptcha.ParrotifyCaptchaValidator',
    // custom error message:
    'message' => 'Validation code is incorrect',
),
```

in view file show widget:
```php
<?php 
    // summon widget
    $this->widget(
        'vendor.parrotify.yii-parrotifycaptcha.ParrotifyCaptcha', 
        array( 
            'model' => $model, 
            'attribute' => 'parrotifyCaptcha', // its attribute name
        )
    );
    
    //and error message
    echo CHtml::error($model,'parrotifyCaptcha');
?>
```