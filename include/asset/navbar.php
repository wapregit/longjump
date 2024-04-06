<!-- CSS -->
<link rel="stylesheet" href="include/css/navbar.css">


<body>
    <nav class="navbar navbar-expand-md bg-body">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img class="navbar-logo" src="include/image/favicon.png" />
                Long Jump Competition System
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-1">
                <span class="visually-hidden">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php if(isset($_SESSION['admin_username']))  { ?>
            <div id="navcol-1" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">กรรมการ</a></li>
                </ul>
                <a class="btn btn-danger ms-md-2" role="button" href="logout.php?logout=1">ออกจากระบบ</a>
            </div>
            <?php } ?>
        </div>
    </nav>