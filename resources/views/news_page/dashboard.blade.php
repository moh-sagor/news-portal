<!DOCTYPE html>
@extends('backend.main')
@include('backend.sweetalert')
@section('content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <div class="row">
            <div class="col-xl-3 col-md-3 pt-3">
                <div class="card text-black mb-4 ">
                        <div class="card-body bg-primary d-flex align-items-center justify-content-center">Total News</div>
                        <div class="card-footer bg-info d-flex align-items-center justify-content-center">
                            <div class="text-danger counter" data-target="{{ $newsCount }}" style="font-size: 40px;"></div>
                        </div>
                </div>
            </div>

            <div class="col-xl-9 col-md-9">
                <fieldset class="border ps-4 pb-2">
                    <legend class="float-none w-auto"><b>Categories</b></legend>
                    @php
                        $serialCounter = 1;
                    @endphp
                    @foreach ($categories->chunk(6) as $categoryChunk)
                        <div class="row">
                            @foreach ($categoryChunk as $category)
                                <div class="col-md-4">
                                    <label class="form-check-label" for="category_{{ $category->id }}">
                                        <form method="POST" id="delete-item-{{ $category->id }}" action="{{ route('news_category.destroy', $category->id) }}" onsubmit="console.log('Form Submitted');">
                                            @csrf
                                        <b>{{ $serialCounter }}. {{ $category->name }}</b>
                                            
                                        @if(auth()->user()->isAdmin())
                                        <a style="text-decoration: none;" class="edit-category" data-id="{{ $category->id }}">
                                            <i class="fas fa-edit" style="color: green;"></i>
                                        </a>
                                        <a style="text-decoration: none;" onclick="confirmDeleteCategory(event, '{{ $category->id }}')">
                                            <i class="fas fa-trash" style="color: red; margin-left:10px;"></i>
                                        </a>
                                    @endif
                                        </form>
                                    </label>
                                    @php
                                        $serialCounter++;
                                    @endphp
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </fieldset>
            </div>
           
            
        </div>

        <div class="container-fluid px-4">
            <h1 class="mt-4">All Posted News </h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    All News Data
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>S\N</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Meta Title</th>
                                <th>Meta Description</th>
                                <th>Short Content</th>
                                <th>Content</th>
                                <th>Category</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S\N</th>
                                <th>Slug</th>
                                <th>Meta Title</th>
                                <th>Meta Description</th>
                                <th>Short Content</th>
                                <th>Content</th>
                                <th>Category</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $sn = 1;
                            @endphp

                            @foreach ($news as $item)
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td>
                                        <a style="text-decoration: none;"
                                            href="{{ route('news_page.show', ['slug' => $item->slug]) }}">
                                            {{Str::limit($item->title,20) }}
                                        </a>
                                    </td>
                                    <td>{{ Str::limit($item->slug, 10) }}</td>
                                    <td>{{ Str::limit($item->meta_title, 15) }}</td>
                                    <td>{{ Str::limit($item->meta_description, 20) }}</td>
                                    <td>{{ Str::limit($item->short_content, 20) }}</td>
                                    <td><p>{!! Str::limit($item->content, 30) !!}</p></td>
                                    <td>@foreach ($item->categories as $category)
                                        {{ $category->name }},
                                    @endforeach</td>

                                    <td>
                                        @if ($item->photo)
                                            <img src="{{ asset('Posted_News/News/' . $item->photo) }}" alt="news Photo"
                                                width="100">
                                        @else
                                            No Photo Found
                                        @endif
                                    </td>
                                    <td>   
                                        <form method="POST" id="delete-form-{{ $item->id }}" action="{{ route('news_page.destroy', ['id' => $item->id]) }}">
                                        @csrf
                                        @if(auth()->user()->isAdmin())
                                                <a style="text-decoration: none;" onclick="confirmEdit('{{ $item->id }}')">
                                                    <i class="fas fa-edit" style="color: green;"></i>
                                                </a>
                                               
                                                    <a style="text-decoration: none;" onclick="confirmDelete(event, '{{ $item->id }}')">
                                                        <i class="fas fa-trash" style="color: red; margin-left:10px;"></i>
                                                    </a>
                                        @else
                                        <p>Only for SuperUser.</p>
                                        @endif
                                                </form>
                                        
                                    </td>
                                </tr>
                                @php
                                    $sn++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- total news count  --}}
<script>
    const counters = document.querySelectorAll(".counter");
    counters.forEach((counter) => {
    counter.innerText = "0";
    const updateCounter = () => {
    const target = +counter.getAttribute("data-target");
    const count = +counter.innerText;
    const increment = target / 500;
    if (count < target) {
        counter.innerText = `${Math.ceil(count + increment)}`;
        setTimeout(updateCounter, 1);
        } else counter.innerText = target;
 };
     updateCounter();
});
</script>

@endsection
