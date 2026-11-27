<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: contact.php");
    exit;
}
// ※学習用のサイトなので、ここではメールの送信やデータの保存はしません。
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>送信完了｜弓道びぎなーず!</title>
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
            <h1 class="section-title">送信完了</h1>
            <div class="confirm-box">
                <p>お問い合わせありがとうございました。</p>
                <p>内容を確認して、2〜3営業日を目安にご連絡します。</p>
                <div class="confirm-buttons">
                    <a class="back-btn" href="index.html">ホームへ戻る</a>
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