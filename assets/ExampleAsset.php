<?php

namespace dominus77\owlcarousel2\assets;

use yii\web\AssetBundle;

/**
 * Class ExampleAsset
 * @package dominus77\owlcarousel2\assets
 */
class ExampleAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = __DIR__ . '/css';
        $this->css = ['example.css'];
    }
}