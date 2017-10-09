<?php

namespace dominus77\owlcarousel2\assets;

use yii\web\AssetBundle;

/**
 * Class OwlCarouselAsset
 * @package dominus77\owlcarousel2\assets
 */
class OwlCarouselAsset extends AssetBundle
{
    public static $theme = 'default';
    public $sourcePath = '@bower/owlcarousel2/dist';

    public $css = [];
    public $js = [];

    public function init()
    {
        $min = YII_ENV_DEV ? '' : '.min';
        $this->css[] = 'assets/owl.carousel' . $min . '.css';
        $this->css[] = 'assets/owl.theme.' . self::$theme . $min . '.css';

        $this->js[] = 'owl.carousel' . $min . '.js';
    }

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}