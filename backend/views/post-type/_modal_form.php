<?php
use yii\bootstrap4\Modal;

/** @var \yii\web\View $this */
?>

<?php



Modal::begin([
    'id' => 'modalCreateUpdatePostType',
    'title' => 'Create post type'
]);

echo '<div id="post-type-form-container"></div>';

Modal::end();

?>
