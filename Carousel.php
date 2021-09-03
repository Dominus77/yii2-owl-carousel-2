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

    /**
     * @var string
     */
    public $theme;

    /**
     * @var string
     */
    public $tag = 'div';

    /**
     * @var array the HTML attributes for the carousel container tag.
     */
    public $containerOptions = [];

    /**
     * @var string|array
     */
    public $items = '';

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var string
     */
    public $clientScript = '';

    private $_id;

    /**
     * Initializes the widget.
     * This renders the open tags needed by the carousel.
     */
    public function init()
    {
        parent::init();
        $this->_id = $this->getId();
        $this->containerOptions['id'] = $this->_id;
        $this->containerOptions['class'] = (isset($this->containerOptions['class']) && !empty($this->containerOptions['class'])) ?
            'owl-carousel owl-theme ' . $this->containerOptions['class'] : 'owl-carousel owl-theme';
        $this->theme = $this->theme ? $this->theme : self::THEME_DEFAULT;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (!empty($this->items)) {
            $this->registerAssets();
            echo Html::beginTag($this->tag, $this->containerOptions) . PHP_EOL;
            $this->renderItems();
            echo Html::endTag($this->tag) . PHP_EOL;
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
     * @return void
     */
    public function renderItems() {
        $items = $this->items;
        
        if(is_array($items)) {
            $items = implode(PHP_EOL, $items);
        }
        
        echo $items;
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
                var owl = $('#{$this->_id}');
                owl.owlCarousel({$options});
            ");
            $view->registerJs($script);
            $view->registerJs($this->clientScript);
        } else {
            $script = new JsExpression("
                $('#{$this->_id}').owlCarousel({$options});
            ");
            $view->registerJs($script);
        }
    }
}
