<!DOCTYPE html>
@extends('backend.main')
@include('news_page.script')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Awesome !! Create a New Post.</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><b>N.B : </b> Please Upload a Post after Plagiarism Testing. Don't Post Copy
                paste Content.</li>
        </ol>

        <div class="row ">
            <div class="col-md-12 ">
                <div class="form-border mt-2">
                    <form action="{{ route('news_page.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <fieldset class="form-group border p-3">
                                    <legend class="float-none w-auto"><b>Title</b></legend>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter a title" oninput="updateMetaTitle(this.value)">
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group border p-1">
                                    <legend class="float-none w-auto"><b>Meta Details Review</b></legend>
                                    <p>Meta Title: <b style="color: red"> <span id="metaTitlePreview"></span></b></p>
                                    <p>Meta Description: <b style="color: rgb(162, 0, 255)"><span
                                                id="metaDescriptionPreview"></span></b> </p>
                                </fieldset>
                            </div>
                        </div>

                        
                        <fieldset class="form-group border p-3">
                            <legend class="float-none w-auto"><b>Select Category</b></legend>
                            @foreach ($categories->chunk(6) as $categoryChunk)
                                <div class="row">
                                    @foreach ($categoryChunk as $category)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" id="category_{{ $category->id }}" name="category_id[]"
                                                       value="{{ $category->id }}">
                                                <label class="form-check-label"
                                                       for="category_{{ $category->id }}"><b>{{ $category->name }}</b></label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </fieldset>
                        
                        
                        

                        <fieldset class="form-group border p-3">
                            <legend class="float-none w-auto"><b>Short Description</b></legend>
                            <textarea name="short_content" id="short_content" class="form-control" placeholder="Enter Short Description"
                                oninput="updateMetaDescription(this.value)"></textarea>
                        </fieldset>
                        <fieldset class="form-group border p-3">
                            <legend class="float-none w-auto"><b>Full Described Content</b></legend>
                            <p><b>N.B:</b> If you want to use image and video in this section must use <b style="color:red;">"width:100% and height:auto"</b>  </p>
                            <textarea name="content" id="content" class="form-control my-editor" placeholder="Enter Full Described Content"
                                oninput="updateMetaDescription(this.value)"></textarea>
                        </fieldset>


                        <fieldset class="form-group border p-3">
                            <legend class="float-none w-auto"><b>Photo</b></legend>
                            <div class="row">
                                <div class="col-md-10 form-group mt-3">
                                    <label class="form-label form-fonts" for="photo"><p><b>N.B:</b>Try to use Photo size (750 x 375) for better output. otherwise automatically convet to this ratio and photo not properly visualized.</p></label>
                                    <input type="file" class="form-control" id="photo" name="photo"
                                        onchange="previewImage(event)" />
                                </div>
                                <div class="col-md-2 form-group mt-3">
                                    <img height="240" width="240" id="imagePreview" class="img-fluid"
                                        src="{{ asset('assets/img/icon/dummy-image.jpg') }}" alt="Image Preview" />
                                </div>
                            </div>

                        </fieldset>

                        <div class="d-flex justify-content-center mt-3 mb-4">
                            <button type="submit" class="btn btn-primary">Create New Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
