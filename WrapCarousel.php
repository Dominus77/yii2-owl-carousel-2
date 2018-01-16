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
 * Class CarouselWrap
 * @package dominus77\owlcarousel2
 */
class WrapCarousel extends Widget
{
    const THEME_DEFAULT = 'default';
    const THEME_GREEN = 'green';

    /**
     * @var string
     */
    public $theme;

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var string
     */
    public $clientScript = '';

    /**
     * @var string
     */
    public $content = '';

    /**
     * @var string
     */
    public $tag = 'div';

    /**
     * @var array the HTML attributes for the carousel container tag.
     */
    public $containerOptions = [];

    /**
     * @var boolean whether to hide the carousel when the body content is empty. Defaults to true.
     */
    public $hideOnEmpty = true;

    private $_beginTag;
    private $_id;

    /**
     * Initializes the widget.
     * This renders the open tags needed by the carousel.
     */
    public function init()
    {
        $this->_id = $this->getId();
        $this->containerOptions['id'] = $this->_id;
        $this->containerOptions['class'] = (isset($this->containerOptions['class']) && !empty($this->containerOptions['class'])) ?
            'owl-carousel owl-theme ' . $this->containerOptions['class'] : 'owl-carousel owl-theme';
        $this->theme = $this->theme ? $this->theme : self::THEME_DEFAULT;

        ob_start();
        ob_implicit_flush(false);
        echo Html::beginTag($this->tag, $this->containerOptions) . PHP_EOL;
        $this->_beginTag = ob_get_contents();
        ob_clean();
    }

    /**
     * Renders the items of the carousel.
     */
    public function run()
    {
        echo $this->renderContent();
        $content = ob_get_clean();
        if ($this->hideOnEmpty && trim($content) === '')
            return;
        $this->registerAssets();
        echo $this->_beginTag . PHP_EOL;
        echo $content . PHP_EOL;
        echo Html::endTag($this->tag) . PHP_EOL;
    }

    /**
     * Renders the items of the carousel.
     */
    protected function renderContent()
    {
        return $this->content;
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
