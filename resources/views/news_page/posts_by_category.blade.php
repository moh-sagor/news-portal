
    <div class="container">
        <h2>Posts in Category: {{ $category->name }}</h2>

        @foreach ($posts as $post)
            <!-- Display individual post information here -->
            <h3>{{ $post->title }}</h3>
            <!-- Other post details... -->
        @endforeach
    </div>
