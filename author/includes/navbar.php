<nav id="sidebar" class="sidebar js-sidebar">
    <?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); ?>

    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.php">
            <h3 class=" text-light">Author Panel</h2>
        </a>

        <hr>
        <ul class="sidebar-nav">
            <li class="sidebar-item <?= $page == 'index.php' ? 'active' : '' ?>">
                <a class="sidebar-link" href="index.php">
                    <i class="fa-sharp fa-solid fa-sliders" style="color: #fafafa;"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <hr>
            <li class="sidebar-item <?= $page == 'books.php' || $page == 'book_edit.php'? 'active' : '' ?>">
                <a class="sidebar-link" href="books.php">
                    <i class="fa-solid fa-book" style="color: #ffffff;"></i> <span class="align-middle">Books</span>
                </a>
            </li>
            <li class="sidebar-item <?= $page == 'add_category.php' || $page == 'update_category.php' ? 'active' : '' ?>">
                <a class="sidebar-link" href="add_category.php">
                    <i class="fa-solid fa-book-medical" style="color: #ffffff;opacity:0.8"></i> <span class="align-middle">Category</span>
                </a>
            </li>
        </ul>

    </div>
</nav>