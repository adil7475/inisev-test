<!DOCTYPE html>
<html>
<head></head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <h3>{{ $post->title }}</h3>
    <p>{!! $post->description !!}</p>
</body>
</html>
