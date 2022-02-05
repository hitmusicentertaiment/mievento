<?php
use yii\bootstrap4\Modal;

/** @var \yii\web\View $this */
?>

<?php



Modal::begin([
    'id' => 'modalCreateUpdateCountry',
    'title' => 'Create state'
]);

echo '<div id="country-form-container"></div>';

Modal::end();

?>
