@extends('common_page.main')
{{-- meta --}}
@include('common_page.homePageMeta')
@section('content')
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong>Trending now</strong>
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    @foreach ($news->take(20) as $item)
                                        <li>
                                            <a href="{{ route('news_page.show', $item->slug) }}">
                                                {{ $item->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <img src="{{ asset('Posted_News/News/' . $latestPost->photo) }}"
                                    alt="{{ $latestPost->title }}">
                                <div class="trend-top-cap">
                                    @foreach ($latestPost->categories as $category)
                                        <span><a href="{{ route('news_page.posts_by_category', ['categoryId' => $category->id]) }}"
                                                style="color:black;">{{ $category->name }}</a></span>
                                    @endforeach
                                    <h2><a
                                            href="{{ route('news_page.show', $latestPost->slug) }}">{{ $latestPost->title }}</a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">
                                @foreach ($news->slice(1, 3) as $item)
                                    <div class="col-lg-4">
                                        <div class="single-bottom mb-35">
                                            <div class="trend-bottom-img mb-30">
                                                <a href="{{ route('news_page.show', $item->slug) }}">
                                                    <img src="{{ asset('Posted_News/News/' . $item->photo) }}"
                                                        alt="{{ $item->title }}">
                                                </a>
                                            </div>
                                            <div class="trend-bottom-cap">
                                                <span class="color1">
                                                    <a href="{{ route('news_page.posts_by_category', ['categoryId' => $item->categories->first()->id]) }}"
                                                        style="color:black;">
                                                        {{ $item->categories->first()->name }}
                                                    </a>
                                                </span>
                                                <h4><a
                                                        href="{{ route('news_page.show', $item->slug) }}">{{ $item->title }}</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <!-- Riht content -->
                    <div class="col-lg-4">
                        @foreach ($news->slice(4, 5) as $item)
                            <div class="trand-right-single d-flex">
                                <div class="trand-right-img">
                                    <a href="{{ route('news_page.show', $item->slug) }}">
                                        <img src="{{ asset('Posted_News/News/' . $item->photo) }}"
                                            alt="{{ $item->title }}" height="120" width="100">
                                    </a>
                                </div>
                                <div class="trand-right-cap">
                                    <span class="color1">
                                        <a href="{{ route('news_page.posts_by_category', ['categoryId' => $item->categories->first()->id]) }}"
                                            style="color:black;">
                                            {{ $item->categories->first()->name }}
                                        </a>
                                    </span>
                                    <h4><a href="{{ route('news_page.show', $item->slug) }}">{{ $item->title }}</a></h4>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->
    <!--   Weekly-News start -->
    <div class="weekly-news-area pt-50">
        <div class="container">
            <div class="weekly-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Weekly Trends</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly-news-active dot-style d-flex dot-style">
                            @foreach ($weeklyTopNews as $news)
                                <div class="weekly-single">
                                    <div class="weekly-img">
                                        <img src="{{ asset('Posted_News/News/' . $news->photo) }}"
                                            alt="{{ $news->title }}" height="300" width="100">
                                    </div>
                                    <div class="weekly-caption">
                                        @foreach ($news->categories as $category)
                                            <span class="color1">
                                                <a href="{{ route('news_page.posts_by_category', ['categoryId' => $category->id]) }}"
                                                    style="color:black;">
                                                    {{ $category->name }}
                                                </a>
                                            </span>
                                        @endforeach
                                        <h4><a href="{{ route('news_page.show', $news->slug) }}">{{ $news->title }}</a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Weekly-News -->
    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-3 col-md-3">
                            <div class="section-tittle mb-30">
                                <h3>At a Glance</h3>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="properties__button">
                                <!--Nav Button  -->
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                            href="#nav-home" role="tab" aria-controls="nav-home"
                                            aria-selected="true">All</a>
                                        {{-- all categories one by one  --}}
                                        @foreach ($categories as $category)
                                            @php
                                                $categoryId = str_replace(' ', '-', $category->id);
                                            @endphp
                                            <a class="nav-item nav-link" id="nav-{{ $categoryId }}-tab" data-toggle="tab"
                                                href="#nav-{{ $categoryId }}" role="tab"
                                                aria-controls="nav-{{ $categoryId }}"
                                                aria-selected="false">{{ $category->name }}</a>
                                        @endforeach
                                    </div>
                                </nav>
                                <!--End Nav Button  -->
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <!-- Nav Card -->
                            <div class="tab-content" id="nav-tabContent">
                                <!-- card one -->
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <div class="whats-news-caption">
                                        <div class="row">
                                            @foreach ($allpost as $item)
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="single-what-news mb-100">
                                                        <div class="what-img">
                                                            <img src="{{ asset('Posted_News/News/' . $item->photo) }}"
                                                                alt="{{ $item->title }}" height="300" width="100">
                                                        </div>
                                                        <div class="what-cap">
                                                            @foreach ($item->categories as $category)
                                                                <span class="color1">
                                                                    <a href="{{ route('news_page.posts_by_category', ['categoryId' => $category->id]) }}"
                                                                        style="color: black;">
                                                                        {{ $category->name }}
                                                                    </a>
                                                                </span>
                                                            @endforeach
                                                            <h4><a
                                                                    href="{{ route('news_page.show', $item->slug) }}">{{ $item->title }}</a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <a class="btn btn-sm" href="{{ route('news_page.index') }}">View All
                                                Posts</a>
                                        </div>
                                    </div>
                                </div>

                                @foreach ($categories as $category)
                                    @php
                                        $categoryId = str_replace(' ', '-', $category->id);
                                    @endphp
                                    <div class="tab-pane fade" id="nav-{{ $categoryId }}" role="tabpanel"
                                        aria-labelledby="nav-{{ $categoryId }}-tab">
                                        <div class="whats-news-caption">
                                            <div class="row">
                                                @foreach ($category->news->take(4) as $post)
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="single-what-news mb-100">
                                                            <div class="what-img">
                                                                <img src="{{ asset('Posted_News/News/' . $post->photo) }}"
                                                                    alt="{{ $post->title }}" height="300"
                                                                    width="100">
                                                            </div>
                                                            <div class="what-cap">
                                                                <span class="color1">
                                                                    <a href="{{ route('news_page.posts_by_category', ['categoryId' => $category->id]) }}"
                                                                        style="color: black;">
                                                                        {{ $category->name }}
                                                                    </a>
                                                                </span>
                                                                <h4><a
                                                                        href="{{ route('news_page.show', $post->slug) }}">{{ $post->title }}</a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <a class="btn btn-sm"
                                            href="{{ route('news_page.posts_by_category', ['categoryId' => $category->id]) }}">View
                                            All
                                            {{ $category->name }}</a>
                                    </div>
                                @endforeach

                            </div>
                            <!-- End Nav Card -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Section Tittle -->
                    <div class="section-tittle mb-40">
                        <h3>Follow Us</h3>
                    </div>
                    <!-- Flow Socail -->
                    <div class="single-follow mb-45">
                        <div class="single-box">
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('assets/img/news/icon-fb.png') }}"
                                            alt=""></a>
                                </div>
                                <div class="follow-count">
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('assets/img/news/icon-tw.png') }}"
                                            alt=""></a>
                                </div>
                                <div class="follow-count">
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('assets/img/news/icon-ins.png') }}"
                                            alt=""></a>
                                </div>
                                <div class="follow-count">
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('assets/img/news/icon-yo.png') }}"
                                            alt=""></a>
                                </div>
                                <div class="follow-count">
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- New Poster -->
                    <div class="news-poster d-none d-lg-block">
                        <img src="{{ asset('assets/img/news/news_card.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->
@endsection
