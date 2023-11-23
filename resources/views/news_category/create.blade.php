<!DOCTYPE html>
@extends('backend.main')
@include('news_page.script')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Awesome !! Create a New Category.</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><b>N.B : </b> Please Upload a Post after Plagiarism Testing. Don't Post Copy
                paste Content.</li>
        </ol>

        <div class="row ">
            <div class="col-md-12 ">
                <div class="form-border mt-2">
                    <form action="{{ route('news_category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <fieldset class="form-group border p-3">
                                    <legend class="float-none w-auto"><b>Category</b></legend>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter a Category" >
                                </fieldset>
                            </div>
                        
                        </div>

                        <div class="d-flex justify-content-center mt-3 mb-4">
                            <button type="submit" class="btn btn-primary">Create New Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
