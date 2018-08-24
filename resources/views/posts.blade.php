@foreach ($posts as $post)
    {{  $post->title    }}
    {{  $post->body     }}
    {{  $post->created_at   }}
@endforeach