<?php
  use yii\helpers\Html;
  use yii\helpers\Url;

  $readmeUrl = "https://github.com/johankladder/yii2-app-advanced/blob/master/README.md";
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
            <h2>Backend</h2>
            <p>
              In an default situation the backend of the application can be
              visited by going to
              
              <?= Html::a('this', Url::to('/backend'), [
                'id' => "backendUrl"
                ]) ?>

              link. This is because of the symlink that is created in the frontend
              when executing <code> php init </code> before launching the
              application.
            </p>
        </div>
        <div class="col-lg-4">
            <h2>Deployment</h2>
            <p>
              Because this application is using Deployer, deployment is pretty
              easy now. When installing dependencies with composer, Deployer is
              also installed. To show available commands please run
              <code>
                php vendor/deployer/deployer/bin dep
              </code>
            </p>
            <p>
              For more deployment information, see the
               <?= Html::a('README.md', Url::to($readmeUrl)) ?> on Github.
            </p>
        </div>
    </div>

</div>
