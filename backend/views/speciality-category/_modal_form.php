<?php
use yii\bootstrap4\Modal;

/** @var \yii\web\View $this */
?>

<?php



Modal::begin([
    'id' => 'modalCreateUpdateSpCategory',
    'title' => 'Create Speciality Category'
]);

echo '<div id="spcategory-form-container"></div>';

Modal::end();

?>
