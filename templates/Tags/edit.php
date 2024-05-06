<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 * @var string[]|\Cake\Collection\CollectionInterface $bookmarks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'Eliminar', $tag->id],
                ['confirm' => __('¿Estás seguro de que quieres borrar # {0}?', $tag->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Lista Tags'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tags form content">
            <?= $this->Form->create($tag) ?>
            <fieldset>
                <legend><?= __('Editar Tag') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('color');
                    echo $this->Form->control('bookmarks._ids', ['options' => $bookmarks]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
