<header>
        <div class="logo">
            <div class="logoimg">
                <img src="../../assets/img/logo_logo.png" alt="Logo">
            </div>
            <h1>BIBLIOETEC</h1>
        </div>
        <nav>
            <a class="categorias" id="categorias" href="../categorias/index.php">
                <h1>Categorias</h1>
            </a>
            <div class="subMenu">
                <ul id="particaoUl1" class="particaoUl">
                    <li><a href="../categorias/index.php?busca_categoria=literatura">Literatura</a></li>
                    <li><a href="../categorias/index.php?busca_categoria=história">História</a></li>
                    <li><a href="../categorias/index.php?busca_categoria=geografia">Geografia</a></li>
                </ul>
                <ul id="particaoUl2" class="particaoUl">
                    <li><a href="../categorias/index.php?busca_categoria=matemática">Matemática</a></li>
                    <li><a href="../categorias/index.php?busca_categoria=física">Física</a></li>
                    <li><a href="../categorias/index.php?busca_categoria=biologia">Biologia</a></li>
              
                </ul>
            </div>
        </nav>
        <form action="../categorias/index.php" method="GET">
            <div class="searchContainer">
                <div class="searchBoxIcon">
                    <div class="bx bx-search searchIcon"></div>
                </div>
                <input type="text" class="searchInput" id="searchInput" name="busca_livros" required />

            </div>
        </form>
    </header>