<table>
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
</table>
