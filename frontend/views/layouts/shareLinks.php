<?php
use ijackua\sharelinks\ShareLinks;
use \yii\helpers\Html;

/**
 * @var yii\base\View $this
 */

?>

<div class="socialShareBlock">
    <?=
    Html::a('<i class="fa fa-facebook-official"></i>', $this->context->shareUrl(ShareLinks::SOCIAL_FACEBOOK),
        ['title' => 'Share to Facebook', 'class' => 'share-fb']) ?>
    <?=
    Html::a('<i class="fa fa-twitter"></i>', $this->context->shareUrl(ShareLinks::SOCIAL_TWITTER),
        ['title' => 'Share to Twitter', 'class' => 'share-twitter']) ?>
    <?=
    Html::a('<i class="fa fa-google-plus"></i>', $this->context->shareUrl(ShareLinks::SOCIAL_GPLUS),
        ['title' => 'Share to Google Plus', 'class' => 'share-g-plus']) ?>
    <?=
    Html::a('<i class="fa fa-vk"></i>', $this->context->shareUrl(ShareLinks::SOCIAL_VKONTAKTE),
        ['title' => 'Share to Vkontakte', 'class' => 'share-vk']) ?>
</div>