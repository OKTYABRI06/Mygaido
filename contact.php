<?php
require_once "./items.php";
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/contact.css">
    <title>お問い合わせ｜弓道びぎなーず!</title>
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
        <section id="contact" class="contact-section container">
            <h1 class="section-title">お問い合わせ</h1>
            <p class="guide-note-contact">お問い合わせの前に、<a href="#faq">よくある質問</a>をご確認ください。返信は、受付から2〜3営業日を目安にお送りします。<span class="required">必須</span> の項目は、すべて入力してください。</p>
            <form class="contact-form" action="confirmation.php" method="post" novalidate>
                <h2 class="form-title">Contact</h2>
                <div class="form-group">
                    <label for="c-name">お名前 <span class="required">必須</span></label>
                    <input type="text" id="c-name" name="name" placeholder="山田 太郎" autocomplete="name" required>
                </div>
                <div class="form-group">
                    <label for="kana">フリガナ <span class="required">必須</span></label>
                    <input type="text" id="kana" name="kana" placeholder="ヤマダ　タロウ" required>
                </div>
                <div class="form-group">
                    <label for="c-email">メールアドレス <span class="required">必須</span></label>
                    <input type="email" id="c-email" name="email" placeholder="example@email.com" autocomplete="email" required>
                </div>
                <div class="form-group">
                    <label for="c-type">お問い合わせの種類 <span class="required">必須</span></label>
                    <select id="c-type" name="type" required>

                        <?php foreach ($Items as $choose): ?>
                            <option value="<?= $choose['i_id'] ?>"><?= $choose['i_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="c-message">メッセージ内容 <span class="required">必須</span></label>
                    <textarea id="c-message" name="message" rows="5" placeholder="ご用件を入力してください" required></textarea>
                </div>
                <div class="form-group form-check">
                    <label for="c-agree">
                        <input type="checkbox" id="c-agree" name="agree" required>
                        <a href="#privacy">個人情報の取り扱い</a>に同意する
                    </label>
                </div>
                <button type="submit" class="submit-btn">内容確認</button>
            </form>
        </section>
        

        <!-- ▼ 連絡先 ▼ -->
        <section class="guide-item" id="info">
            <h2>お問い合わせ先</h2>
            <div class="guide-mini-list">
                <div class="guide-mini">
                    <h3>電話</h3>
                    <p><a href="tel:0123456789">012-345-6789</a></p>
                </div>
                <div class="guide-mini">
                    <h3>メール</h3>
                    <p><a href="mailto:contact@example.com">contact@example.com</a></p>
                </div>
                <div class="guide-mini">
                    <h3>受付時間</h3>
                    <p>平日 10:00〜18:00（土日祝・年末年始は休み）</p>
                </div>
            </div>
        </section>

        <!-- ▼ よくある質問 ▼ -->
        <section class="guide-item" id="faq">
            <h2>よくある質問</h2>
            <details class="guide-accordion" open>
                <summary>弓道を始めるのに、何を用意すればいいですか？</summary>
                <div class="guide-accordion-body">
                    <p>最初は、動きやすい服装だけで始められる道場が多いです。弓・矢・ゆがけは貸し出しがあることも多く、買うのは慣れてからで大丈夫です。必要なものは道場によって違うので、見学の前に確認しましょう。買う順番は<a href="shop.html">道具店</a>のページにまとめています。</p>
                </div>
            </details>
            <details class="guide-accordion">
                <summary>運動が苦手でも、体力がなくても大丈夫ですか？</summary>
                <div class="guide-accordion-body">
                    <p>大丈夫です。力任せに引く競技ではなく、姿勢や呼吸、動きの正しさが大切です。学生から高齢の方まで、同じ道場で練習しています。</p>
                </div>
            </details>
            <details class="guide-accordion">
                <summary>何歳から始められますか？</summary>
                <div class="guide-accordion-body">
                    <p>道場や教室によって決まっています。中学・高校の部活で始める人も多いですが、一般の道場では対象年齢が決まっていることがあります。申し込みの前に確認してください。</p>
                </div>
            </details>
            <details class="guide-accordion">
                <summary>見学や体験はできますか？</summary>
                <div class="guide-accordion-body">
                    <p>多くの道場で、事前に連絡すれば見学できます。体験ができるかどうかは道場によるので、連絡のときに聞いてみましょう。探し方と流れは<a href="dojos.html">道場</a>のページを見てください。</p>
                </div>
            </details>
            <details class="guide-accordion">
                <summary>どんな服装で行けばよいですか？</summary>
                <div class="guide-accordion-body">
                    <p>見学は、動きやすい服装で大丈夫です。練習では道着と袴を着ることが多いですが、始めたばかりの間は運動着でよい道場もあります。道場の決まりに従ってください。</p>
                </div>
            </details>
            <details class="guide-accordion">
                <summary>費用はどれくらいかかりますか？</summary>
                <div class="guide-accordion-body">
                    <p>会費、施設の使用料、道具代などがあり、道場や団体によって違います。金額はこのサイトでは案内していないので、各道場に直接確認してください。</p>
                </div>
            </details>
            <details class="guide-accordion">
                <summary>眼鏡やコンタクトをしていても弓道はできますか？</summary>
                <div class="guide-accordion-body">
                    <p>できます。眼鏡をかけて練習している人もたくさんいます。引いたときにずれやすい場合は、指導者に相談してください。</p>
                </div>
            </details>
            <details class="guide-accordion">
                <summary>審査は、初心者でも受けられますか？</summary>
                <div class="guide-accordion-body">
                    <p>まずは級位から始めます。段位の受審資格は段ごとに決まっていて、所属する道場を通して申し込みます。くわしくは<a href="about.html#shinsa">「弓道とは」の審査</a>を見てください。</p>
                </div>
            </details>
            <details class="guide-accordion">
                <summary>このサイトの情報は、どのくらい信頼できますか？</summary>
                <div class="guide-accordion-body">
                    <p>初心者向けに、一般的な内容をまとめています。細かい決まりは道場や大会ごとに違い、改定されることもあります。最終的には、道場の指導者や全日本弓道連盟の最新の規程で確認してください。</p>
                </div>
            </details>
            <details class="guide-accordion">
                <summary>お問い合わせをしたのに、返事が来ません。</summary>
                <div class="guide-accordion-body">
                    <p>迷惑メールのフォルダと、入力したメールアドレスに間違いがないかを確認してください。2〜3営業日たっても届かない場合は、お手数ですが、もう一度送るか、お電話でご連絡ください。</p>
                </div>
            </details>
        </section>

        <!-- ▼ 個人情報の取り扱い ▼ -->
        <section class="guide-item" id="privacy">
            <h2>個人情報の取り扱い</h2>
            <ul class="guide-list">
                <li>集める情報：お名前、メールアドレス、お問い合わせの内容です。</li>
                <li>使う目的：お問い合わせへの返信と、内容の確認だけに使います。</li>
                <li>第三者への提供：法令にもとづく場合を除き、ご本人の同意なく提供しません。</li>
                <li>保管：返信が終わり、必要な期間がすぎたら削除します。</li>
            </ul>
            <p class="guide-note">このサイトは、学習用の架空のウェブサイトです。フォームの内容は、実際には送信されません。</p>
        </section>

        <div class="scroll-top">
            <a href="#"><img src="./img/top_button.png" width="50" height="50" alt="TOPへ戻る"></a>
        </div>
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