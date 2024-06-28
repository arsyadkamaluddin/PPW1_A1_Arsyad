<?php
session_start();
require("./api/functions.php");
if (!isset($_SESSION["userId"])||!isset($_COOKIE["username"])) {
    if (!isset($_SESSION["signup"])) {
        header("Location: ./signup");
    }
    header("Location: ./login");
}
if (isset($_POST["quest"])) {
    postQuest($_POST["title"], $_POST["quest"]);
    unset($_POST);
    header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_GET["delete"])) {
    deleteQuest($_GET["delete"]);
    header("Location: ./");
}
$page = isset($_GET["page"])?$_GET["page"]:1;
$highQuestions = getHighQuestions();
$questions = getAllQuestions($page);
$answers = getAllAnswers();
$all = ceil(mysqli_fetch_row(mysqli_query($mysql,"SELECT COUNT(quest_id) FROM questions"))[0]/5);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArsyaFess</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body class="container-fluid bg-body-tertiary">
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-danger" href="#">ArsyaFess</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./user?name=<?=$_COOKIE["username"]?>">Profile</a>
                    </li>
                </ul>
                    <a href="api/logout.php" class="text-secondary btn float-end">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container">
    <div class="row mb-5 pb-5">
        <div class="col-md-8">
            <h1 class="mt-3">@<?= $_COOKIE["username"] ?></h1>
    
            <form method="post" class="form">
                <input type="text" maxlength="20" required placeholder="Judul" name="title" class="form-control my-3"></input>
                <input type="text" required placeholder="Pertanyaan" name="quest" class="form-control my-3"></input>
                <input type="submit" value="Buat" class="btn btn-primary">
            </form>
            <div class="mt-5 d-flex flex-column gap-4">
                <?php foreach ($questions as $quest) : ?>
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $quest["title"] ?></h5>
                            <p class="card-text"><?= $quest["text"] ?></p>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $quest["date"] ?> <span><i><a class="text-decoration-none text-secondary" href="./user?name=<?=$quest["username"]?>">by @<?= $quest["username"] ?></a></i></span><img src="../assets/avatar/<?= $quest['avatar'] ?>.png" style="width: 25px;" alt="" class="bg-primary rounded-circle ms-2"></h6>
                            <a href="./answer?qid=<?= $quest["quest_id"] ?>" class="btn btn-primary">Answers <?= $quest["ans_count"] ?></a>
                            <?php if ($quest["username"] == $_COOKIE["username"]) : ?>
                                <div onclick="onDelete(`<?= $quest['quest_id'] ?>`)" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                    </svg></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach ?>
                <nav aria-label="...">
  <ul class="pagination pagination-lg">
    <?php for($i=1;$i<=$all;$i++):?>
    <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
    <?php endfor;?>
  </ul>
</nav>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-danger text-light p-3 mt-3 rounded">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center">Higlight</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5>New Question</h5>
                    </div>
                    <?php for($i=0;$i<5;$i++):?>
                        <div class="col-12 mt-2">
                            <a href="./answer?qid=<?= $highQuestions[$i]["quest_id"] ?>" class="text-decoration-none">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <?=$highQuestions[$i]['title']?>
                                        </h4>
                                        <div class="card-text new"><?=$highQuestions[$i]['text']?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endfor;?>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <h5>New Answer</h5>
                    </div>
                    <?php foreach($answers as $answer):?>
                    <div class="col-12 mt-2">
                        <a href="./answer?qid=<?=$answer['quest_id']?>" class="text-decoration-none">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-text new"><?=$answer['text']?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach;?>
                    </div>
                </div>
            </div>
    </div>
    </div>
</body>

</html>
<script>
    function onDelete(id){
        Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "./?delete="+id
      }
    });
    }
</script>