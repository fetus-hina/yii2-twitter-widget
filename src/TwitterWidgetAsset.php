<?php
/**
 * @copyright Copyright (C) 2015 AIZAWA Hina
 * @license https://github.com/fetus-hina/stat.ink/blob/master/LICENSE MIT
 * @author AIZAWA Hina <hina@bouhime.com>
 */

namespace jp3cki\yii2\twitter\widget;

use yii\web\AssetBundle;

class TwitterWidgetAsset extends AssetBundle
{
    public $baseUrl = '//platform.twitter.com/';
    public $js = [
        'widgets.js',
    ];
    public $jsOptions = [
        'async' => 'async',
    ];
}
