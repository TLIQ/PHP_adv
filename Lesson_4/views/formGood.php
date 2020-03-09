<?php
    /**
     * @var $good \App\models\Good;
     * @var $action string
     */
?>
<form method="post" action="<?= $action; ?>">
    <input type="text" name="name" value="<?= $good->getName() ?>" placeholder="name">
    <input type="text" name="info" value="<?= $good->getInfo() ?>" placeholder="info">
    <input type="text" name="price" value="<?= $good->getPrice() ?>" placeholder="price">
    <input type="submit">
</form>