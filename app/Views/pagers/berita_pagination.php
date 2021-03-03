<div class="pagination" aria-label="<?= lang('Pager.pageNavigation') ?>">
        <?php if ($pager->hasPreviousPage()) : ?>
            <a href="<?= $pager->getFirst() ?>" class="prevposts-link" aria-label="<?= lang('Pager.first') ?>"><i class="fas fa-caret-left"></i><span><?= lang('Pager.first') ?></span></a>
            <a href="<?= $pager->getPreviousPage() ?>" class="nextposts-link" aria-label="<?= lang('Pager.previous') ?>"><span><?= lang('Pager.previous') ?></span><i class="fas fa-caret-right"></i></a>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <a href="<?= $link['uri'] ?>" <?= $link['active'] ? 'class="current-page"' : '' ?>>
                <?= $link['title'] ?>
            </a>
        <?php endforeach ?>

        <?php if ($pager->hasNextPage()) : ?>
            <a href="<?= $pager->getNextPage() ?>" class="nextposts-link" aria-label="<?= lang('Pager.next') ?>"><span><?= lang('Pager.next') ?></span><i class="fas fa-caret-right"></i></a>
            <a href="<?= $pager->getLast() ?>" class="prevposts-link" aria-label="<?= lang('Pager.last') ?>"><i class="fas fa-caret-left"></i><span><?= lang('Pager.last') ?></span></a>
        <?php endif ?>
</div>