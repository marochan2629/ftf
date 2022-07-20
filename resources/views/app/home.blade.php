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
                    <a href="/article/index"><img src="../images/leaves-gb0c9b754b_1920.jpg" class="service-img"><p class="service-name">読む<br>LEARN</p></a>
                    
                    <!-- <p>LEARN</p> -->
                </div>
            </div>
            <div class="card service service2">
                <div class="card-body">
                    <a href="/question/index"><img src="../images/grandmother-g1fa961d0c_1920.jpg" class="service-img"><p class="service-name">聞く<br>QUESTIONS</p></a>
                    
                </div>
            </div>
            <div class="card service service3">
                <div class="card-body">
                    <a href="/photo/index"><img src="../images/zhangjiajie-g66b1d36f8_1920.jpg" class="service-img"><p class="service-name">見る<br>PHOTOS</p></a>
                    
                </div>
            </div>
        </div>
        <div class="notifications">
            <h1>お知らせ機能作ってここに表示させようかなあ。もっと上の方がいいかな</h1>
        </div>
    </div>

@endsection