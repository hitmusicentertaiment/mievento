<?php
use yii\bootstrap4\Modal;

/** @var \yii\web\View $this */
?>

<?php



Modal::begin([
    'id' => 'modalCreateUpdateCity',
    'title' => 'Create city'
]);

echo '<div id="city-form-container"></div>';

Modal::end();

?>
