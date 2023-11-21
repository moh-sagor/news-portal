@extends('backend.main')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Meta Title</th>
                    <th>Meta Description</th>
                    <th>Content</th>
                    <th>Photo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->meta_title }}</td>
                        <td>{{ $item->meta_description }}</td>
                        <td>{{ $item->content }}</td>
                        <td>
                            @if ($item->photo)
                                <img src="{{ asset($item->photo) }}" alt="item Photo" width="100">
                            @else
                                No Photo
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}


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
                                            No Photo
                                        @endif
                                    </td>
                                    <td> </a> <a href=""><i class="fas fa-edit" style="color: green;"></i></a> <a
                                            href=""><i class="fas fa-trash"
                                                style="color: red; margin-left:10px;"></i>
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
@endsection
