<?php

namespace dominus77\owlcarousel2\assets;

use yii\web\AssetBundle;

/**
 * Class OwlCarouselAsset
 * @package dominus77\owlcarousel2\assets
 */
class OwlCarouselAsset extends AssetBundle
{
    /**
     * @var string
     */
    public static $theme = 'default';

    /**
     * @var string
     */
    public $sourcePath = '@bower/owl-carousel2/dist';

    /**
     * @var array
     */
    public $css = [];

    /**
     * @var array
     */
    public $js = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $min = YII_ENV_DEV ? '' : '.min';
        $this->css[] = 'assets/owl.carousel' . $min . '.css';
        $this->css[] = 'assets/owl.theme.' . self::$theme . $min . '.css';

        $this->js[] = 'owl.carousel' . $min . '.js';
    }

    /**
     * @var array
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
