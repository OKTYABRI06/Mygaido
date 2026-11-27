<?php
// 矢尺（やじゃく）＝矢の長さ の計算
// 矢尺の目安 ＝ 矢束（やづか）＋ 5〜10cm
// 矢束がわからない時は、身長の半分を矢束の目安にする

$yazuka = "";       // 入力された矢束（cm）
$height = "";       // 入力された身長（cm）
$error = "";        // エラーメッセージ
$result = null;     // 計算結果

// 0.5cm きざみに丸める（矢は 0.5cm きざみで作ることが多いため）
function roundHalf($value)
{
    return round($value * 2) / 2;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 入力を受け取って、全角の数字を半角にする
    $yazuka = trim((string)filter_input(INPUT_POST, 'yazuka'));
    $height = trim((string)filter_input(INPUT_POST, 'height'));
    $yazuka = mb_convert_kana($yazuka, "n", "UTF-8");
    $height = mb_convert_kana($height, "n", "UTF-8");

    if ($yazuka !== "") {
        // 矢束が入力されている時（こちらを優先）
        if (!is_numeric($yazuka) || (float)$yazuka < 60 || (float)$yazuka > 110) {
            $error = "矢束は、60〜110cmの数字で入力してください。";
        } else {
            $base = (float)$yazuka;
            $from = "入力した矢束";
        }
    } elseif ($height !== "") {
        // 矢束がなくて、身長だけ入力されている時
        if (!is_numeric($height) || (float)$height < 100 || (float)$height > 220) {
            $error = "身長は、100〜220cmの数字で入力してください。";
        } else {
            $base = (float)$height / 2;
            $from = "身長の半分";
        }
    } else {
        $error = "矢束か身長のどちらかを入力してください。";
    }

    // 入力が正しければ計算する
    if ($error === "") {
        $result = [
            'from' => $from,
            'base' => roundHalf($base),
            'min' => roundHalf($base + 5),
            'mid' => roundHalf($base + 7.5),
            'max' => roundHalf($base + 10)
        ];
    }
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>矢尺の計算｜弓道びぎなーず!</title>
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
                            <li><a href="shop.php">道具店</a></li>
                            <li><a href="dojos.html">道場</a></li>
                            <li><a href="contact.php">お問い合わせ</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main class="page-main">
        <!-- ▼ ページの見出し ▼ -->
        <section class="page-top">
            <h1>矢尺（やじゃく）の計算</h1>
            <p>矢の長さの目安を計算します。矢束（やづか）を入力してください。測れないときは、身長でも計算できます。</p>
        </section>

        <!-- ▼ 矢束の測り方 ▼ -->
        <section class="page-block">
            <h2>矢束の測り方</h2>
            <p>背筋を伸ばして立ち、左腕を真横にまっすぐ伸ばします。喉の中心から、左手の中指の先までの長さを測ります。ひとりだと正確に測りにくいので、誰かに手伝ってもらいましょう。</p>
        </section>

        <!-- ▼ 計算フォーム ▼ -->
        <section class="page-block">
            <h2>計算する</h2>
            <form class="keisan-form" action="keisan.php" method="post">
                <label for="yazuka">矢束（cm）</label>
                <input type="number" id="yazuka" name="yazuka" step="0.1" min="60" max="110" placeholder="例：86" value="<?= htmlspecialchars($yazuka) ?>">

                <p class="keisan-or">または</p>

                <label for="height">身長（cm）</label>
                <input type="number" id="height" name="height" step="0.1" min="100" max="220" placeholder="例：172" value="<?= htmlspecialchars($height) ?>">

                <button type="submit" class="keisan-button">計算する</button>
            </form>

            <?php if ($error !== ""): ?>
                <p class="guide-caution"><strong>入力を確認してください</strong><?= $error ?></p>
            <?php endif ?>

            <?php if ($result !== null): ?>
                <div class="keisan-result">
                    <p>矢尺の目安（<?= $result['from'] ?>：<?= number_format($result['base'], 1) ?>cm ＋ 5〜10cm）</p>
                    <p class="keisan-number"><?= number_format($result['min'], 1) ?> 〜 <?= number_format($result['max'], 1) ?> cm</p>
                    <p>真ん中の長さは <?= number_format($result['mid'], 1) ?>cm です。</p>
                </div>
                <?php if ($result['from'] === "身長の半分"): ?>
                    <p class="guide-note">身長の半分は、矢束のおおよその目安です。腕の長さには個人差があるので、できるだけ矢束を実際に測ってください。</p>
                <?php endif ?>
            <?php endif ?>

            <p class="guide-caution"><strong>注意</strong>この計算は目安です。矢が短すぎると、矢先が弓の内側に入ってケガをするおそれがあります。矢の長さは、必ず専門店や指導者に測ってもらってから決めてください。</p>
            <p class="guide-note">矢の選び方は、<a href="index.html#select">ホームの「道具の選び方」</a>で説明しています。</p>
        </section>

        <div class="scroll-top">
            <a href="#"><img src="./img/top_button.png" width="50" height="50" alt="TOPへ戻る"></a>
        </div>
    </main>
    <footer class="site-footer">
        <div class="container">
            <div class="footer-inner">
                <!-- Footer Logo Group -->
                <div class="footer-logo">
                    <div class="emblem"><span>弓</span></div>
                    <div class="text-group">
                        <div class="title">弓道びぎなーず!</div>
                        <div class="slogan">SLOGAN HERE</div>
                    </div>
                </div>
                <!-- Copyright -->
                <p class="copyright"><small>Copyright © 2026 弓道びぎなーず! All Rights Reserved.</small></p>
            </div>
            <!-- Disclaimer -->
            <p class="footer-disclaimer">このサイトは、弓道初心者のための情報提供を目的とした架空のウェブサイトです。実際の弓道に関する情報は、公式な団体や専門家の指導を参考にしてください。</p>
        </div>
    </footer>
    <!-- Bootstrap のメニュー（スマホのボタン）に必要 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
