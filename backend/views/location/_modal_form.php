<?php
use yii\bootstrap4\Modal;

/** @var \yii\web\View $this */
?>

<?php



Modal::begin([
    'id' => 'modalCreateUpdateLocation',
    'title' => 'Create location'
]);

echo '<div id="location-form-container"></div>';

Modal::end();

?>
