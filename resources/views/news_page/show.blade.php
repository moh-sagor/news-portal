
@extends('common_page.main')
{{-- Meta details --}}
{{-- @include('common_page.dynamicMeta') --}}
@section('content')


<style>
    .category-color-1 { color: #ff0000; } /* Red */
    .category-color-2 { color: #00ff00; } /* Green */
    .category-color-3 { color: #0000ff; } /* Blue */
    .category-color-4 { color: #151571; } /* Blue */
    .category-color-5 { color: #aeff00; } /* Blue */
    .category-color-6 { color: #dd00ff; } /* Blue */
    .category-color-7 { color: #ff00bb; } /* Blue */
    .category-color-8 { color: #84ff00; } /* Blue */
    .category-color-9 { color: #8080d3; } /* Blue */
    .category-color-10 { color: #f2d204; } /* Blue */
</style>

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{ asset('Posted_News/News/' . $news->photo) }}" alt="">
                        </div>
                        <div class="blog_details">
                            <h2>{{ $news->title }}</h2>

                        <ul class="blog-info-link mt-3 mb-4">
                            @foreach ($news->categories as $key => $category)
                                <li class="category-color-{{ $key + 1 }}">
                                    <i class="fa fa-file"></i>
                                    <a href="{{ route('news_page.posts_by_category', ['categoryId' => $category->id]) }}">
                                     {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                            
                            <p class="excert">
                                {{$news->short_content}}
                            </p>
                            <p>
                                {!! $news->content !!}
                            </p>
                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            <ul class="social-icons">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="navigation-area">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    @if ($prevPost)
                                        <div class="thumb">
                                            <a href="{{ route('news_page.show', $prevPost->slug) }}">
                                                <img class="img-fluid" src="{{ asset('Posted_News/News/' . $prevPost->photo) }}" alt="{{ $prevPost->title }}" width="120">
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="{{ route('news_page.show', $prevPost->slug) }}">
                                                <span class="lnr text-white ti-arrow-left"></span>
                                            </a>
                                        </div>
                                        <div class="detials">
                                            <p>Prev Post</p>
                                            <a href="{{ route('news_page.show', $prevPost->slug) }}">
                                                <h4>{{ Str::limit($prevPost->title,10) }}</h4>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                        
                                <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    @if ($nextPost)
                                        <div class="detials">
                                            <p>Next Post</p>
                                            <a href="{{ route('news_page.show', $nextPost->slug) }}">
                                                <h4>{{ Str::limit($nextPost->title,10) }}</h4>
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="{{ route('news_page.show', $nextPost->slug) }}">
                                                <span class="lnr text-white ti-arrow-right"></span>
                                            </a>
                                        </div>
                                        <div class="thumb">
                                            <a href="{{ route('news_page.show', $nextPost->slug) }}">
                                                <img class="img-fluid" src="{{ asset('Posted_News/News/' . $nextPost->photo) }}" alt="{{ $nextPost->title }}" width="120">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comments-area">
                        <h4>{{ $news->commentCount() }} Comments</h4>
                        @foreach($comments as $comment)
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img height="60px" width="300px" src="{{ asset('assets/img/comment/user.png') }}" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            {{ $comment->content }}
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    <a href="#">{{ $comment->user->name }}</a>
                                                </h5>
                                                <p class="date">{{ $news->created_at->format('F j, Y \a\t g:i a') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        {{-- category  --}}
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">All Categories</h4>
                            <ul class="list cat-list">
                                @php
                                    $serialCounter = 1;
                                @endphp
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('news_page.posts_by_category', ['categoryId' => $category->id]) }}" class="d-flex">
                                            <p>{{ $category->name }}</p>
                                            @php
                                                $postCount = $category->news->count();
                                            @endphp
                                            <p>({{ $postCount }})</p>
                                        </a>
                                    </li>
                                    @php
                                        $serialCounter++;
                                    @endphp
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Posts</h3>
                            
                            @foreach ($recentPosts as $post)
                                <div class="media post_item">
                                    <a href="{{ route('news_page.show', ['slug' => $post->slug]) }}">
                                    <img src="{{ asset('Posted_News/News/' . $post->photo) }}" alt="{{ $post->title }}" width="50" height="50">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{ route('news_page.show', ['slug' => $post->slug]) }}">
                                            <h3>{{ $post->title }}</h3>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                        
                    </div>
                </div>


                <!-- Comment Form -->
                @if(auth()->check())
                <div class="comment-form col-lg-8">
                    <h4>Add a Comment</h4>
                    <form class="form-contact comment_form" action="{{ route('comments.store', ['newsId' => $news->id]) }}"     method="post" id="commentForm">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="content" id="content" cols="30" rows="9"
                                        placeholder="Write a Comment"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-1">
                            <button type="submit" class="button button-contactForm btn_1 boxed-btn">Submit Comment</button>
                        </div>
                    </form>
                </div>
                @else
                <h4 class="ml-4">Please <a class="button button-contactForm btn_1 boxed-btn" href="{{ route('login') }}">login</a> to leave a comment.</h4>
                @endif
            </div>
        </div>
        {{-- <p>{{ !! $news->content !! }}</p> --}}
    </section>
    <!--================ Blog Area end =================-->
@endsection

