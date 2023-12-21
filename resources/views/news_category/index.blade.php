<!DOCTYPE html>
@extends('common_page.main')
@section('content')
    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-12 col-md-12">
                            <div class="properties__button">
                                <!--Nav Button  -->
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                            href="#nav-home" role="tab" aria-controls="nav-home"
                                            aria-selected="true">All</a>
                                        {{-- all categories one by one  --}}
                                        @foreach ($recentCategories as $category)
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
                                        </div>
                                        <span class="m-2">{{ $allpost->links('pagination::bootstrap-5') }}</span>

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
                                                @foreach ($category->news as $post)
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
                                                @if ($category->news->isEmpty())
                                                    <div class="container">
                                                        <style>
                                                            .animate-charcter {
                                                                text-transform: uppercase;
                                                                background-image: linear-gradient(-225deg,
                                                                        #231557 0%,
                                                                        #44107a 29%,
                                                                        #ff1361 67%,
                                                                        #fff800 100%);
                                                                background-size: auto auto;
                                                                background-clip: border-box;
                                                                background-size: 200% auto;
                                                                color: #fff;
                                                                background-clip: text;
                                                                text-fill-color: transparent;
                                                                -webkit-background-clip: text;
                                                                -webkit-text-fill-color: transparent;
                                                                animation: textclip 2s linear infinite;
                                                                display: inline-block;
                                                                font-size: 40px;
                                                            }

                                                            @keyframes textclip {
                                                                to {
                                                                    background-position: 200% center;
                                                                }
                                                            }
                                                        </style>
                                                        <div class="row">
                                                            <div class="col-md-12 col-12 text-center">
                                                                <h3 class="animate-charcter"> COMING SOON</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
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
