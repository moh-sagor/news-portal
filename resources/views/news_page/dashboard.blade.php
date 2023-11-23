<!DOCTYPE html>
@extends('backend.main')
@include('backend.sweetalert')
@section('content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <div class="row">

            <div class="col-xl-3 col-md-6">
                <div class="card text-black mb-4 ">
                        <div class="card-body bg-primary d-flex align-items-center justify-content-center">Total News</div>
                        <div class="card-footer bg-info d-flex align-items-center justify-content-center">
                            <div class="text-danger counter" data-target="{{ $newsCount }}" style="font-size: 40px;"></div>
                        </div>
                </div>
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
                                            {{ $item->title }}
                                        </a>
                                    </td>
                                    <td>{{ Str::limit($item->slug, 10) }}</td>
                                    <td>{{ Str::limit($item->meta_title, 15) }}</td>
                                    <td>{{ Str::limit($item->meta_description, 20) }}</td>
                                    <td>{{ Str::limit($item->short_content, 20) }}</td>
                                    <td><p>{!! Str::limit($item->content, 30) !!}</p></td>

                                    <td>
                                        @if ($item->photo)
                                            <img src="{{ asset('Posted_News/News/' . $item->photo) }}" alt="news Photo"
                                                width="100">
                                        @else
                                            No Photo Found
                                        @endif
                                    </td>
                                    <td>  
                                        <div class="row">
                                            <div class="col">
                                                <a href="#" onclick="confirmEdit('{{ $item->id }}')">
                                                    <i class="fas fa-edit" style="color: green;"></i>
                                                </a>
                                            </div>
                                            
                                            <div class="col">
                                                <form method="POST" id="delete-form-{{ $item->id }}" action="{{ route('news_page.destroy', ['id' => $item->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" onclick="confirmDelete(event, '{{ $item->id }}')">
                                                        <i class="fas fa-trash" style="color: red; margin-left:10px;"></i>
                                                    </a>
                                                </form>
                                            </div>
                                            
                                        </div>
                                        
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
