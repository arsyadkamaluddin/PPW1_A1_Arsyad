<?php
require "../api/functions.php";
if (!isset($_GET['name'])) {
    header("Location: ../index.php");
}
$data = getAllData($_GET['name']);
$id = getId($_COOKIE["username"]);
$follower = getFollower(getId($_GET["name"]));
$isFollowed = in_array($id,$follower);
$followed = getFollowed(getId($_GET["name"]));
$answersBy = getAnswersBy(getId($_GET["name"]));
$questionsBy = getQuestionsBy(getId($_GET["name"]));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</head>

<body class="container-fluid">
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
                        <a class="nav-link" href="./?name=<?=$_COOKIE["username"]?>">Profile</a>
                    </li>
                </ul>
                    <a href="api/logout.php" class="btn btn-danger float-end">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row mb-5 pb-5">
            <div class="col-md-4">
                <div class="card">
                    <img src="../assets/avatar/<?= $data['avatar'] ?>.png" class="card-img-top img-sel" alt="Foto Profil">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $data["name"] ?></h5>
                        <i class="card-title"><?= $data["username"] ?></i>
                        <p class="card-text"><?= $data["bio"] ?></p>
                        <p class="card-text"><small class="text-muted">Bergabung sejak: <?= $data["gabung"] ?></small></p>
                        <?php if($data["username"]!=$_COOKIE["username"]):?>
                        <?php if($isFollowed):?>
                            <a href="follow.php?id=<?=$data['user_id']?>" class="btn btn-primary">Unfollow</a>
                        <?php else:?>
                            <a href="follow.php?id=<?=$data['user_id']?>" class="btn btn-primary">Follow</a>
                        <?php endif;?>

                        <?php endif;?>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Statistik Pengguna</h5>
                        <p class="card-text"><i class="fa-solid fa-people-arrows"></i> Mengikuti: <?=count($followed)?></p>
                        <p class="card-text"><i class="fa-solid fa-person"></i> Pengikut: <?=count($follower)?></p>
                        <p class="card-text"><i class="fa fa-question-circle"></i> Pertanyaan: <?= $data['questions_count'] ?></p>
                        <p class="card-text"><i class="fa fa-comment"></i> Jawaban: <?= $data['answers_count'] ?></p>
                        <p class="card-text"><i class="fa fa-thumbs-up"></i> Vote Setuju: <?= $data['likes_count'] ?></p>
                        <p class="card-text"><i class="fa fa-thumbs-down"></i> Vote Tidak Setuju: <?= $data['dislikes_count'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="true">Pengikut</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="followed-tab" data-bs-toggle="tab" data-bs-target="#followed" type="button" role="tab" aria-controls="followed" aria-selected="false">Mengikuti</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="questions-tab" data-bs-toggle="tab" data-bs-target="#questions" type="button" role="tab" aria-controls="questions" aria-selected="false">Pertanyaan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="answers-tab" data-bs-toggle="tab" data-bs-target="#answers" type="button" role="tab" aria-controls="answers" aria-selected="false">Jawaban</button>
                    </li>
                    <?php if ($_GET["name"] == $_COOKIE["username"]) : ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Pengaturan Profil</button>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                        <div class="list-group mt-3">
                            <?php foreach($follower as $followe):?>
                            <a href="?name=<?=getUserName($followe)?>" class="list-group-item list-group-item-action"><?=getUserName($followe)?></a>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="followed" role="tabpanel" aria-labelledby="followed-tab">
                        <div class="list-group mt-3">
                        <?php foreach($followed as $followe):?>
                            <a href="?name=<?=getUserName($followe)?>" class="list-group-item list-group-item-action"><?=getUserName($followe)?></a>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="questions-tab">
                        <div class="list-group mt-3">
                        <?php foreach($questionsBy as $question):?>
                            <a href="../answer?qid=<?=$question["quest_id"]?>" class="list-group-item list-group-item-action"><h6><?=$question["title"]?></h6><p><?=$question["text"]?></p></a>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="answers" role="tabpanel" aria-labelledby="answers-tab">
                        <div class="list-group mt-3">
                        <?php foreach($answersBy as $answer):?>
                            <a href="../answer?qid=<?=$answer["quest_id"]?>" class="list-group-item list-group-item-action"><h6><?=$answer["title"]?></h6><p><?=$answer["text"]?></p></a>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                        <form class="mt-3" action="edit.php?uid=<?=$data['user_id']?>" method="post">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" value="<?=$data['name']?>" class="form-control" maxlength="64" name="nama" placeholder="Nama">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" value="<?=$data['username']?>" maxlength="16" class="form-control" name="username" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" value="<?=$data['email']?>" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea maxlength="300" class="form-control" value="<?=$data['bio']?>" name="bio" rows="3" placeholder="Bio singkat"></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputAvatar">Avatar</label>
                                <select class="form-select" name="avatar" id="inputAvatar">
                                    <option selected>Pilihan</option>
                                    <option value="00">00</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    const inputAvatar = document.querySelector("#inputAvatar")
    inputAvatar.addEventListener("change",function(e){
        document.querySelector(".img-sel").setAttribute("src",`../assets/avatar/avatar ${inputAvatar.value}.png`)
    })
</script>
</body>

</html>