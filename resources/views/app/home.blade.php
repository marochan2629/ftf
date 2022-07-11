@extends('layouts.app')

@section('content')
<!-- <div class="content"> -->
    <div class="top-page">
        <div class="hero-area">
            <div class="hero-images">
                    <img src="/images/berlin-cathedral-g76d15908b_1920.jpg" class="slideshow hero-image">
                    <img src="/images/theravada-buddhism-g391f85ea1_1920.jpg" class="slideshow fadeout hero-image">
                    <img src="/images/the-pilgrims-guide-g4329790d6_1920.jpg" class="slideshow fadeout hero-image">
                    <img src="/images/architecture-gcdcb1e724_1920.jpg" class="slideshow fadeout hero-image">
            </div>
            
            <div class="main">
                <h1 class="catchphrase">宗教を知る<br>宗教に向き合う</h1>
                <!-- <h1>宗教に向き合う</h1> -->
                <a href="#" class="title">Face to Faith</a>
            </div>
        </div>
        <div class="concept">
            <h1>宗教をもっと身近に、もっとわかりやすく</h1>
            <p>普段身近に触れることがない宗教のことを、気軽に学べるサイトです。<br>本当はもっとなんか書いた方がいいけど思いつかんので適当に。</p>
        </div>
        <div class="card-deck services">
            <div class="card service service1">
                <div class="card-body">
                    <a class="service-name" href="#">読む<br>LEARN</a>
                    <!-- <p>LEARN</p> -->
                </div>
            </div>
            <div class="card service service2">
                <div class="card-body">
                <!-- <h4 class="card-title">聞く</h4> -->
                    <a class="service-name" href="#">聞く<br>QUESTIONS</a>
                <!-- <p class="card-text">説明文の欄だけど必要ないかもしれない削除して画像でも差し込むか</p> -->
                </div>
            </div>
            <div class="card service service3">
                <div class="card-body">
                <!-- <h4 class="card-title">見る</h4> -->
                    <a class="service-name" href="#">見る<br>PHOTOS</a>
                <!-- <p class="card-text">説明文の欄だけど必要ないかもしれない削除して画像でも差し込むか</p> -->
                </div>
            </div>
        </div>
        <div class="notifications">
            <h1>お知らせ機能作ってここに表示させようかなあ。もっと上の方がいいかな</h1>
        </div>
    </div>

@endsection