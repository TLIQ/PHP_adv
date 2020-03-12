<?php /**@var \App\models\Good $good */?>

<h2><?= $good->getName() ?></h2>
<p>Информация: <?= $good->getInfo() ?></p>

<a href="/?c=good&a=update&id=<?= $good->getId()?>">Редактировать</a>
