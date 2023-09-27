<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body><div class="register-container">
    <form action="/pony" method="post">
        <div>
            <label>
                Name:<br>
                <input type="text" name="name" placeholder="John Smith" />
            </label>
        </div>
        <div>
            <label>
                Email:<br>
                <input type="email" name="email" placeholder="john.smith@example.com" />
            </label>
        </div>
        <div>
            <label>
                Password:<br>
                <input type="password" name="password" />
            </label>
        </div>
        <div class="btn-container">
            <button type="submit" class="btn">Register</button>
        </div>
    </form>
</div>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>