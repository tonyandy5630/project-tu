<div class="row my-3">
    <div class="col">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item <?= (int)$page === 1 ? 'disabled' : '' ?>">
                    <a class="page-link">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $pageCount; $i++) {
                ?>
                    <li class="page-item" aria-current="page">
                        <a class="page-link <?= (int)$page === $i ? 'active' : '' ?>" href="product?page=<?= $i ?>"><?php echo $i ?>
                        </a>
                    </li>
                <?php
                }
                ?>

                <li class="page-item">
                    <a class="page-link <?= (int)$page === (int)$pageCount ? 'disabled' : '' ?>" href="product?page=<?= (int)$page + 1 ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>