<?php
require("../api/functions.php");
session_start();
if (isset($_GET["delete"])) {
  deleteAnswer($_GET["delete"]);
}
if (!isset($_GET["qid"])) {
  header("Location: ../");
}
$answers = getAnswers($_GET["qid"]);
$question = getQuestion($_GET["qid"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $question["title"] ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-danger" href="../">ArsyaFess</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/?name=<?=$_COOKIE["username"]?>">Profile</a>
                    </li>
                </ul>
                    <a href="../api/logout.php" class="btn btn-danger float-end">Logout</a>
            </div>
        </div>
    </nav>
  <div class="container mb-5 pb-5">

    <div class="card my-4">
      <div class="card-body">
        <h5 class="card-title"><?= $question["title"] ?></h5>
        <p class="card-text"><?= $question["text"] ?></p>
        <h6 class="card-subtitle mb-2 text-body-secondary"><?= $question["date"] ?> <span><i>by @<?= $question["username"] ?></i></span></h6>
      </div>

    </div>
    <form action="post.php" method="post" class="form">
      <input type="text" required placeholder="Jawaban" name="answer" class="form-control"></input>
      <input type="text" class="d-none" name="qid" value="<?= $_GET['qid'] ?>">
      <input type="submit" value="Jawab" class="my-4 btn btn-primary">
    </form>

    <div class="d-flex flex-column gap-3">
      <?php foreach ($answers as $answer) : ?>

        <div class="card" style="width: 100%;">
          <div class="card-body">
            <img src="../assets/avatar/<?= $answer['avatar'] ?>.png" style="width: 30px;" alt="" class="bg-primary rounded-circle">
            <a style="text-decoration: none;color:black" href="../user?name=<?= $answer["username"] ?>">
              <h5 class="card-title d-inline"><i><?= $answer["username"] ?>
            </a>
            <?php if ($answer["username"] == $_COOKIE["username"]) : ?>
              <div onclick="onDelete(`<?=$answer['answer_id'] ?>`)" class="ms-2 d-inline"><img src="../assets/icon/trash.svg" alt=""></div>
            <?php endif; ?>
          
          </i></h5>
            <h6 class="card-subtitle my-2 text-body-secondary"><?= $answer["date"] ?></h6>
            <?php $stat=getVote($_SESSION['userId'],$answer['answer_id']); if($stat==0):?>
              <a href="./vote.php?uid=<?= $_SESSION['userId'] ?>&aid=<?= $answer['answer_id'] ?>&val=-1" class="float-end me-3 text-decoration-none text-secondary"><img src="../assets/icon/empty_dislike.svg" alt="" class="me-2"><?=$answer['dislikes']?></a>
            <a href="./vote.php?uid=<?= $_SESSION['userId'] ?>&aid=<?= $answer['answer_id'] ?>&val=1" class="float-end me-3 text-decoration-none text-secondary"><img src="../assets/icon/empty_like.svg" alt="" class="me-2"><?=$answer['likes']?></a>
            <?php elseif($stat==1):?>
              <a href="./vote.php?uid=<?= $_SESSION['userId'] ?>&aid=<?= $answer['answer_id'] ?>&val=-1" class="float-end me-3 text-decoration-none text-secondary"><img src="../assets/icon/empty_dislike.svg" alt="" class="me-2"><?=$answer['dislikes']?></a>
              <a href="./vote.php?uid=<?= $_SESSION['userId'] ?>&aid=<?= $answer['answer_id'] ?>&val=0" class="float-end me-3 text-decoration-none text-secondary"><img src="../assets/icon/like.svg" alt="" class="me-2"><?=$answer['likes']?></a>
              <?php elseif($stat==-1):?>
                <a href="./vote.php?uid=<?= $_SESSION['userId'] ?>&aid=<?= $answer['answer_id'] ?>&val=0" class="float-end me-3 text-decoration-none text-secondary"><img src="../assets/icon/dislike.svg" alt="" class="me-2"><?=$answer['dislikes']?></a>
                <a href="./vote.php?uid=<?= $_SESSION['userId'] ?>&aid=<?= $answer['answer_id'] ?>&val=1" class="float-end me-3 text-decoration-none text-secondary"><img src="../assets/icon/empty_like.svg" alt="" class="me-2"><?=$answer['likes']?></a>
              <?php endif;?>
            <p class="card-text"><?= $answer["text"] ?></p>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</body>

</html>
<script>
    function onDelete(id){
        Swal.fire({
      title: "Kamu yakin?",
      text: "Jawaban ini akan dihapus secara permanen",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yakin",
      cancelButtonText: "Batal"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "./?delete="+id
      }
    });
    }
</script>