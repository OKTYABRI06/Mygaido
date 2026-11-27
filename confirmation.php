<?php
require_once "items.php";

$result = [];   // フォームから受け取ったデータ
$viewData = []; // 画面に表示するデータ
$errors = [];   // 入力エラーがある項目

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: contact.php");
    exit;
}

$result['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$result['kana'] = filter_input(INPUT_POST, 'kana', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$result['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$result['type'] = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$result['message'] = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$result['agree'] = filter_input(INPUT_POST, 'agree');

// 名前データの加工（null対策で ?? '' を追加）
$result['name'] = mb_convert_kana($result['name'] ?? '', "rnsKV", "UTF-8");
$result['name'] = trim($result['name']);

// フリガナデータの加工
$result['kana'] = mb_convert_kana($result['kana'] ?? '', "sKV", "UTF-8");
$result['kana'] = trim($result['kana']);

// メッセージデータの加工
$result['message'] = trim($result['message'] ?? '');

// 名前が空白でないかチェック
if ($result['name'] !== "") {
    $viewData['name'] = $result['name'];
} else {
    $viewData['name'] = "名前が入力されていません";
    $errors['name'] = true;
}

// フリガナが空白でないかチェック
if ($result['kana'] !== "") {
    $viewData['kana'] = $result['kana'];
} else {
    $viewData['kana'] = "フリガナが入力されていません";
    $errors['kana'] = true;
}

// emailのチェック
if ($result['email']) {
    $viewData['email'] = htmlspecialchars($result['email'], ENT_QUOTES, "UTF-8");
} else {
    $viewData['email'] = "メールアドレスが正しく入力されていません";
    $errors['email'] = true;
}

// お問い合わせの種類（選んだ値を、表示用の名前に変える）
$viewData['type'] = "お問い合わせの種類が選ばれていません";
$errors['type'] = true;
foreach ($Items as $item) {
    if ($item['i_id'] !== null && $item['i_id'] === $result['type']) {
        $viewData['type'] = $item['i_name'];
        unset($errors['type']);
        break;
    }
}

// メッセージ内容のチェック（改行は <br> にする）
if ($result['message'] !== "") {
    $viewData['message'] = nl2br($result['message']);
} else {
    $viewData['message'] = "メッセージが入力されていません";
    $errors['message'] = true;
}

// 個人情報の取り扱いに同意しているか
if (!$result['agree']) {
    $errors['agree'] = true;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="contact.css">
    <title>内容確認｜弓道びぎなーず!</title>
</head>

<body>
    <header>
        <div class="container-fluid main">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="sr-only">メニューを開く</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.html">
                            <div class="emblem"><span>弓</span></div>
                            <div class="text-group">
                                <div class="title">弓道びぎなーず!</div>
                                <div class="slogan">SLOGAN HERE</div>
                            </div>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.html">ホーム</a></li>
                            <li><a href="about.html">弓道とは</a></li>
                            <li><a href="shop.html">道具店</a></li>
                            <li><a href="dojos.html">道場</a></li>
                            <li class="active"><a href="contact.php">お問い合わせ</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <section class="contact-section container">
            <h1 class="section-title">内容確認</h1>

            <?php if (!empty($errors)): ?>
                <p class="guide-caution">
                    <strong>入力に問題があります。</strong>「戻る」を押して、入力し直してください。
                    <?php if (isset($errors['agree'])): ?>
                        <br>※個人情報の取り扱いへの同意チェックも必要です。
                    <?php endif ?>
                </p>
            <?php else: ?>
                <p class="guide-note-contact">入力内容をご確認ください。よろしければ「送信」を押してください。</p>
            <?php endif ?>

            <div class="confirm-box">
                <div class="confirm-row">
                    <p class="confirm-label">名前</p>
                    <p class="confirm-value-1<?= isset($errors['name']) ? ' confirm-error' : '' ?>"><?= $viewData['name'] ?></p>
                </div>
                <div class="confirm-row">
                    <p class="confirm-label">フリガナ</p>
                    <p class="confirm-value-1<?= isset($errors['kana']) ? ' confirm-error' : '' ?>"><?= $viewData['kana'] ?></p>
                </div>
                <div class="confirm-row">
                    <p class="confirm-label">メールアドレス</p>
                    <p class="confirm-value-1<?= isset($errors['email']) ? ' confirm-error' : '' ?>"><?= $viewData['email'] ?></p>
                </div>
                <div class="confirm-row">
                    <p class="confirm-label">お問い合わせの種類</p>
                    <p class="confirm-value-1<?= isset($errors['type']) ? ' confirm-error' : '' ?>"><?= $viewData['type'] ?></p>
                </div>
                <div class="confirm-row">
                    <p class="confirm-label">メッセージ内容</p>
                    <p class="confirm-value-1<?= isset($errors['message']) ? ' confirm-error' : '' ?>"><?= $viewData['message'] ?></p>
                </div>

                <div class="confirm-buttons">
                    
                    <?php if (empty($errors)): ?>
                        <form class="confirm-form" action="complete.php" method="post">
                            <input type="hidden" name="name" value="<?= $result['name'] ?>">
                            <input type="hidden" name="kana" value="<?= $result['kana'] ?>">
                            <input type="hidden" name="email" value="<?= $viewData['email'] ?>">
                            <input type="hidden" name="type" value="<?= $result['type'] ?>">
                            <input type="hidden" name="message" value="<?= $result['message'] ?>">
                            <button type="submit" class="submit-btn">送信</button>
                        </form>
                    <?php endif ?>
                    <button type="button" class="back-btn" onclick="history.back()">戻る</button>
                </div>
            </div>
        </section>
    </main>
    <footer class="site-footer">
        <div class="container">
            <div class="footer-inner">
                <div class="footer-logo">
                    <div class="emblem"><span>弓</span></div>
                    <div class="text-group">
                        <div class="title">弓道びぎなーず!</div>
                        <div class="slogan">SLOGAN HERE</div>
                    </div>
                </div>
                <p class="copyright"><small>Copyright &copy; 2026 All Rights Reserved.</small></p>
            </div>
            <p class="footer-disclaimer">このサイトは、弓道初心者のための情報提供を目的とした架空のウェブサイトです。実際の弓道に関する情報は、公式な団体や専門家の指導を参考にしてください。</p>
        </div>
    </footer>
    <!-- Bootstrap のメニュー（スマホのボタン）に必要 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
</body>

</html>
