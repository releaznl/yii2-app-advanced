<?php
  use yii\helpers\Html;
?>

<div class="jumbotron">
    <h1>Welcome to the custom guide!</h1>
</div>

<div class="body-content">

    <div class="row">
        <div class="col-lg-4">
            <h2>Shared resources loading:</h2>
            <p>
              This image (<?= Html::img('uploads/download.png') ?>) is loaded
              from shared resources. That means that it is rendered from the
              shared folder in development in the root and from the shared folder
              in the parent when in production. These defaults are set in the
              <code>'environments/index.php'</code> file.
            </p>
            <p>
              It is possible to let deployer sync up those folders. Please check
              the example. When enabled, this functionality is automatically
              called when deploying.
            </p>
        </div>
        <div class="col-lg-4">
            <h2>Heading</h2>
            <p></p>

        </div>
        <div class="col-lg-4">
            <h2>Heading</h2>

            <p></p>

        </div>
    </div>

</div>
