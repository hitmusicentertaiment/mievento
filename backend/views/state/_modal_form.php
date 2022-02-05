<?php
use yii\bootstrap4\Modal;

/** @var \yii\web\View $this */
?>

<?php



Modal::begin([
    'id' => 'modalCreateUpdateState',
    'title' => 'Create state'
]);

echo '<div id="state-form-container"></div>';

Modal::end();

?>
