<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';

$loggedInUser = $this->getRequest()->getSession()->read('Auth.User');
?>

<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>">
                <!--Agregando el logo de la UPDS-->
                <img src="<?= $this->Url->webroot('img/logotipo.png') ?>" alt="Logotipo" style="height: 50px; width: auto;">
            </a>
        </div>

        <div class="top-nav-links">
            <a target="_blank" rel="noopener" href="https://book.cakephp.org/4/">Documentacion</a>
            <a target="_blank" rel="noopener" href="https://api.cakephp.org/">API</a>
        </div>
        <!--Muestra el Usuario logeado-->
        <?php if ($loggedInUser) : ?>
            <div class="user-info">
                <span><?= h($loggedInUser['email']) ?></span>
                <?php if (!empty($loggedInUser['path_img'])) : ?>
                    <img src="<?= $this->Html->webroot('img/img_users/' . $loggedInUser['path_img']) ?>" alt="Foto de perfil">
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?> <!-- Muestra Mensaje de Error -->
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>