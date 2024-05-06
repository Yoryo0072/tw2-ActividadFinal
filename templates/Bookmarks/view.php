<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bookmark $bookmark
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Html->link(__('Editar Bookmark'), ['action' => 'edit', $bookmark->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Eliminar Bookmark'), ['action' => 'delete', $bookmark->id], ['confirm' => __('¿Estás seguro de que quieres borrar # {0}?', $bookmark->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Lista Bookmarks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nuevo Bookmark'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookmarks view content">
            <h3><?= h($bookmark->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $bookmark->has('user') ? $this->Html->link($bookmark->user->email, ['controller' => 'Users', 'action' => 'view', $bookmark->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($bookmark->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($bookmark->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($bookmark->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($bookmark->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($bookmark->description)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Url') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($bookmark->url)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Tags') ?></h4>
                <?php if (!empty($bookmark->tags)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Color') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($bookmark->tags as $tags) : ?>
                        <tr>
                            <td><?= h($tags->id) ?></td>
                            <td><?= h($tags->title) ?></td>
                            <td><?= h($tags->color) ?></td>
                            <td><?= h($tags->created) ?></td>
                            <td><?= h($tags->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('¿Estás seguro de que quieres borrar # {0}?', $tags->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
