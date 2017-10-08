<?php

namespace dominus77\owlcarousel2;

use Yii;
use yii\base\Widget;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use dominus77\owlcarousel2\assets\OwlCarouselAsset;
use dominus77\owlcarousel2\assets\AnimateCssAsset;

/**
 * Class Carousel
 * @package dominus77\owlcarousel2
 */
class Carousel extends Widget
{
    const THEME_DEFAULT = 'default';
    const THEME_GREEN = 'green';

    public $theme;
    public $container = 'div';
    public $containerOptions = [
        'tag' => 'div',
        'options' => [
            'class' => 'owl-carousel owl-theme',
        ],
    ];
    public $items = '';
    public $clientOptions = [];
    public $clientScript = '';
    public $id;

    public function init()
    {
        parent::init();
        $this->id = $this->getId();
        $this->containerOptions['options'] = ArrayHelper::merge([
            'id' => $this->id,
        ], $this->containerOptions['options']);
        $this->theme = $this->theme ? $this->theme : self::THEME_DEFAULT;
    }

    public function run()
    {
        if (!empty($this->items)) {
            $this->registerAssets();
            echo Html::beginTag($this->containerOptions['tag'], $this->containerOptions['options']) . PHP_EOL;
            echo $this->items . PHP_EOL;
            echo Html::endTag($this->containerOptions['tag']) . PHP_EOL;
        }
    }

    /**
     * @return string
     */
    public function getOptions()
    {
        $options = ArrayHelper::merge([], $this->clientOptions);
        return json_encode($options);
    }

    /**
     * @return static
     */
    public function registerAssets()
    {
        $options = $this->getOptions();
        $view = $this->getView();
        OwlCarouselAsset::$theme = $this->theme;
        OwlCarouselAsset::register($view);

        if (isset($this->clientOptions['animateOut']) && (!empty($this->clientOptions['animateOut'])) ||
            (isset($this->clientOptions['animateIn']) && (!empty($this->clientOptions['animateIn'])))
        ) {
            AnimateCssAsset::register($view);
        }

        if (!empty($this->clientScript)) {
            $script = new JsExpression("
                var owl = $('#{$this->id}');
                owl.owlCarousel({$options});
            ");
            $view->registerJs($script);
            $view->registerJs($this->clientScript);
        } else {
            $script = new JsExpression("
                $('#{$this->id}').owlCarousel({$options});
            ");
            $view->registerJs($script);
        }
    }
}