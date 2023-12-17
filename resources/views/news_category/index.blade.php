<!DOCTYPE html>
@extends('common_page.main')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <fieldset class="border m-3">
                <legend class="float-none w-auto"><b>Categories</b></legend>
                @php
                    $serialCounter = 1;
                @endphp
                    <div class="row justify-content-center">
                        @foreach ($categories as $category)
                            <div class="col-md-5 btn btn-primary btn-sm m-2">
                                <label class="form-check-label" for="category_{{ $category->id }}">
                                        <b>{{ $serialCounter }}.</b>
                                       <a href="{{ route('news_page.posts_by_category', ['categoryId' => $category->id]) }}" style="text-decoration: none; color:black;">
                                        {{ $category->name }}
                                    </a>
                                </label>
                                @php
                                    $postCount = $category->news->count();
                                @endphp
                                <span class="badge bg-secondary">{{ $postCount }}</span>
                                @php
                                    $serialCounter++;
                                @endphp
                            </div>
                        @endforeach
                    </div>
            </fieldset>
        </div>
    </div>
</div>

@endsection
