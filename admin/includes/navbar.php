<nav id="sidebar" class="sidebar js-sidebar">

    <?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); ?>
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.php">
            <h3 class=" text-light">Admin Panel</h2>
        </a>

        <hr>
        <ul class="sidebar-nav" id="list">
            <li class="sidebar-item <?= $page == 'index.php' ? 'active' : '' ?>">
                <a class="sidebar-link" href="index.php">
                    <i class="fa-sharp fa-solid fa-sliders" style="color: #fafafa;"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <hr>
            <li class="sidebar-item <?= $page == 'books.php' || $page == 'book_edit.php' ? 'active' : '' ?>">
                <a class="sidebar-link" href="books.php">
                    <i class="fa-solid fa-book" style="color: #ffffff;"></i> <span class="align-middle">Books</span>
                </a>
            </li>
            <li class="sidebar-item <?= $page == 'add_category.php' ? 'active' : '' ?>">
                <a class="sidebar-link" href="add_category.php">
                    <i class="fa-solid fa-book-medical" style="color: #ffffff;opacity:0.8"></i> <span class="align-middle">Category</span>
                </a>
            </li>
            <li class="sidebar-item <?= $page == 'user.php' || $page == 'authors.php' || $page == 'update_user.php' || $page == 'update_author.php'? 'active' : '' ?>">
                <a class="sidebar-link" id="toggle">
                    <i class="fa-solid fa-user" style="color: #ffffff;"></i> <span class="align-middle">Users</span>
                </a>
            </li>
            <li class="sidebar-item <?= $page == 'user.php' || $page == 'update_user.php' ? 'active' : '' ?>" id="collapseExample1">
                <a class="sidebar-link <?= $page == 'user.php' ? 'active' : '' ?>" href="user.php">
                    <span class="align-middle">User</span>
                </a>
                
            </li>
            <li class="sidebar-item <?= $page == 'authors.php' || $page == 'update_author.php' ? 'active' : '' ?>" id="collapseExample2">
                <a class="sidebar-link <?= $page == 'authors.php' ? 'active' : '' ?>" href="authors.php">
                    <span class="align-middle">Authors</span>
                </a>
            </li>
           
            <li class="sidebar-item <?= $page == 'admin_contacts.php' ? 'active' : '' ?>">
                <a class="sidebar-link" href="admin_contacts.php">
                    <i class="fa-solid fa-comment" style="color: #ffffff;"></i> <span class="align-middle">Messages</span>
                </a>
            </li>


        </ul>

    </div>
</nav>