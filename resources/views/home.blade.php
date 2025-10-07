<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <main class="container">

        @auth
        <div class="d-flex w-100 justify-content-between align-items-center p-3 border rounded">
            <h6>You are logged in!</h6>
            <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-danger">Logout</button>
            </form>
        </div>

        <div class="card mt-4">
            <div class="card-title bg-light px-3 pb-1 pt-2 border-bottom">
                <h3>Create a New Post</h3>
            </div>
            <div class="card-body p-3 pt-1">
                <form action="/create-post" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="inputTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="inputTitle" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="inputBody" class="form-label">Content</label>
                        <textarea name="body" class="form-control" id="inputBody" cols="30" rows="10"
                            placeholder="Enter your content here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Post</button>
                </form>
            </div>
        </div>

        <div class="mt-4">
            <h3>All Posts</h3>
            @foreach ($posts as $post)
            <div class="card mt-4">
                <div
                    class="card-title bg-light px-3 pb-1 pt-2 border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-baseline gap-2">
                        <h4 class="m-0 mb-1">{{ $post->title }}</h4>
                        <p class="m-0 text-secondary">By {{ $post->author->name }} ({{ $post->author->role->name }})</p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="/edit-post/{{ $post->id }}">
                            <button type="button" class="btn btn-sm btn-primary">Edit</button>
                        </a>
                        <form action="/delete-post/{{ $post->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-3 pt-1">
                    {{ $post->body }}
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="card">
            <div class="card-title bg-light px-3 pb-1 pt-2 border-bottom">
                <h3>Register</h3>
            </div>
            <div class="card-body p-3 pt-1">
                <form action="/register" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="inputName" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-title bg-light px-3 pb-1 pt-2 border-bottom">
                <h3>Login</h3>
            </div>
            <div class="card-body p-3 pt-1">
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="loginEmail" name="loginEmail">
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="loginPassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
        @endauth

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>