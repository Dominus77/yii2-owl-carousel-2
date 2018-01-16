# yii2-owl-carousel-2

[![Latest Stable Version](https://poser.pugx.org/dominus77/yii2-owl-carousel-2/v/stable)](https://packagist.org/packages/dominus77/yii2-owl-carousel-2)
[![License](https://poser.pugx.org/dominus77/yii2-owl-carousel-2/license)](https://github.com/Dominus77/yii2-owl-carousel-2/blob/master/LICENSE.md)
[![Total Downloads](https://poser.pugx.org/dominus77/yii2-owl-carousel-2/downloads)](https://packagist.org/packages/dominus77/yii2-owl-carousel-2)

Renders a [Owl Carousel 2](https://owlcarousel2.github.io/OwlCarousel2/) widget for Yii2.


## Installation
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require dominus77/yii2-owl-carousel-2 "*"
```

or add

```
"dominus77/yii2-owl-carousel-2": "*"
```

to the require section of your `composer.json` file.


## Usage
Once the extension is installed, simply use it in your code by  :

## Basic
Variant 1:
```php
<?= \dominus77\owlcarousel2\Carousel::widget([
    'items' => $this->render('@dominus77/owlcarousel2/example/_items'), // example
    //'theme' => \dominus77\owlcarousel2\Carousel::THEME_GREEN, // THEME_DEFAULT, THEME_GREEN
    //'tag' => 'div', // container tag name, default div
    //'containerOptions' => [/* ... */], // container html options
    'clientOptions' => [
        'loop' => true,
        'margin' => 10,
        'nav' => true,
        'responsive' => [
            0 => [
                'items' => 1,
            ],
            600 => [
                'items' => 3,
            ],
            1000 => [
                'items' => 5,
            ],
        ],
    ],
]); ?>
```
Items
```
<div class="item"><h4>1</h4></div>
<div class="item"><h4>2</h4></div>
<div class="item"><h4>3</h4></div>
<div class="item"><h4>4</h4></div>
<div class="item"><h4>5</h4></div>
<div class="item"><h4>6</h4></div>
<div class="item"><h4>7</h4></div>
<div class="item"><h4>8</h4></div>
<div class="item"><h4>9</h4></div>
<div class="item"><h4>10</h4></div>
<div class="item"><h4>11</h4></div>
<div class="item"><h4>12</h4></div>
```

Variant 2, Wrap Carousel:

```
<?php \dominus77\owlcarousel2\WrapCarousel::begin([
    //'theme' => \dominus77\owlcarousel2\Carousel::THEME_GREEN, // THEME_DEFAULT, THEME_GREEN
    //'tag' => 'div', // container tag name, default div
    //'containerOptions' => [/* ... */], // container html options
    'clientOptions' => [
        'loop' => true,
        'margin' => 10,
        'nav' => true,
        'responsive' => [
            0 => [
                'items' => 1,
            ],
            600 => [
                'items' => 3,
            ],
            1000 => [
                'items' => 5,
            ],
        ],
    ],
]); ?>

    <!-- begin Items -->
    <div class="item"><h4>1</h4></div>
    <div class="item"><h4>2</h4></div>
    <div class="item"><h4>3</h4></div>
    <div class="item"><h4>4</h4></div>
    <div class="item"><h4>5</h4></div>
    <div class="item"><h4>6</h4></div>
    <div class="item"><h4>7</h4></div>
    <div class="item"><h4>8</h4></div>
    <div class="item"><h4>9</h4></div>
    <div class="item"><h4>10</h4></div>
    <div class="item"><h4>11</h4></div>
    <div class="item"><h4>12</h4></div>
    <!-- end Items -->

<?php \dominus77\owlcarousel2\WrapCarousel::end() ?>
```

## Responsive
```
<?= \dominus77\owlcarousel2\Carousel::widget([
    'items' => $this->render('@dominus77/owlcarousel2/example/_items'), // example
    'clientOptions' => [
        'loop' => true,
        'margin' => 10,
        'responsiveClass' => true,
        'responsive' => [
            0 => [
                'items' => 1,
                'nav' => true,
            ],
            600 => [
                'items' => 3,
                'nav' => false,
            ],
            1000 => [
                'items' => 5,
                'nav' => true,
                'loop' => false,
            ],
        ],
    ],
]); ?>
```

## Animate
```
<?= \dominus77\owlcarousel2\Carousel::widget([
    'items' => $this->render('@dominus77/owlcarousel2/example/_items'), // example
    'clientOptions' => [
        'animateOut' => 'slideOutDown',
        'animateIn' => 'flipInX',
        'items' => 1,
        'margin' => 30,
        'stagePadding' => 30,
        'smartSpeed' => 450,
    ],
]); ?>
```

## Autoplay
```
<?= \dominus77\owlcarousel2\Carousel::widget([
    'items' => $this->render('@dominus77/owlcarousel2/example/_items'), // example
    'clientOptions' => [
        'items' => 4,
        'loop' => true,
        'margin' => 10,
        'autoplay' => true,
        'autoplayTimeout' => 1000,
        'autoplayHoverPause' => true,
    ],
    'clientScript' => new \yii\web\JsExpression("
        $('.play').on('click',function(){
            owl.trigger('play.owl.autoplay',[1000])
        })
        $('.stop').on('click',function(){
            owl.trigger('stop.owl.autoplay')
        })
    "),
]); ?>
<hr>
<a class="btn btn-primary play">Play</a>
<a class="btn btn-primary stop">Stop</a>
```

## Demo
Pleas, check the [Demos](https://owlcarousel2.github.io/OwlCarousel2/demos/demos.html)

## More Information
Please, check the [Owl Carousel 2](https://owlcarousel2.github.io/OwlCarousel2/)

## License
The BSD License (BSD). Please see [License File](https://github.com/Dominus77/yii2-owl-carousel-2/blob/master/LICENSE.md) for more information.
