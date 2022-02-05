<?php
use yii\bootstrap4\Modal;

/** @var \yii\web\View $this */
?>

<?php



Modal::begin([
    'id' => 'modalCreateUpdateService',
    'title' => 'Create service'
]);

echo '<div id="service-form-container"></div>';

Modal::end();

?>
