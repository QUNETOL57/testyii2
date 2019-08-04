<?php
use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <div class="container">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">ROUTEAM</a>
                    </div>
                     <ul class="nav navbar-nav">
                        <li><?= Html::a('Главная', ['lib/index']) ?></li>
                        <li><?= Html::a('Авторы', ['authors/index']) ?></li>
                        <li><?= Html::a('Книги', ['books/index']) ?></li>
                     </ul>
                </div>
            </nav>  

            <?= $content ?>

        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
