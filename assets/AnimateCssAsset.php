<?php

namespace dominus77\owlcarousel2\assets;

use yii\web\AssetBundle;

/**
 * Class AnimateCssAsset
 * @package dominus77\owlcarousel2\assets
 */
class AnimateCssAsset extends AssetBundle
{
    public $sourcePath = '@vendor/daneden/animate.css';
    public $css = [];

    public function init()
    {
        $min = YII_ENV_DEV ? '' : '.min';
        $this->css[] = 'animate' . $min . '.css';
    }
}