<?php
/**
 * @copyright Copyright (C) 2015 AIZAWA Hina
 * @license https://github.com/fetus-hina/yii2-twitter-widget/blob/master/LICENSE MIT
 * @author AIZAWA Hina <hina@bouhime.com>
 */

namespace jp3cki\yii2\twitter\widget;

use yii\base\Widget;
use yii\helpers\Html;

class TweetButton extends Widget
{
    // See https://dev.twitter.com/web/tweet-button/web-intent
    public $text;
    public $url;
    public $hashtags;
    public $via;
    public $related;
    public $inReplyTo;

    // See https://dev.twitter.com/web/tweet-button
    public $size;

    // DO NOT TOUCH if you ain't a specialist.
    public $baseUrl;
    public $baseText;

    public function init()
    {
        $this->baseUrl = 'https://twitter.com/intent/tweet';
        $this->baseText = 'Tweet';
        return parent::init();
    }

    public function run()
    {
        TwitterWidgetAsset::register($this->view);

        $options = [ 'class' => 'twitter-share-button' ];
        if ($this->size === 'large') {
            $options['data-size'] = $this->size;
        }

        return Html::a(
            $this->baseText,
            $this->buildUrl(),
            $options
        );
    }

    protected function buildUrl()
    {
        $params = [];
        $keys = [ 'text', 'url', 'hashtags', 'via', 'related', 'inReplyTo' ];
        foreach ($keys as $key) {
            if ($this->$key !== null && $this->$key !== '') {
                // convert (like: inReplyTo => in-reply-to)
                $paramKey = preg_replace_callback(
                    '/[[:upper:]]/',
                    function ($m) {
                        return '-' . strtolower($m[0]);
                    },
                    $key
                );
                $params[$paramKey] = (is_array($this->$key))
                    ? implode(',', $this->$key)
                    : (string)$this->$key;
            }
        }
        return sprintf(
            '%s%s%s',
            $this->baseUrl,
            strpos($this->baseUrl, '?') !== false ? '&' : '?',
            http_build_query($params, '', '&')
        );
    }
}
