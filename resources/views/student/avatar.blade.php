<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avatar setup</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div id="app">
        {{auth()->user()->avatar->base}} {{auth()->user()->avatar->hair}} {{auth()->user()->avatar->dress}}
        <avatar-main my-avatar="{{true ? auth()->user()->avatar : null}}" college="{{request()->college ?? request()->user()->interest->college->name}}" gender="{{request()->gender ?? auth()->user()->gender}}" is-premium="{{is_null(request()->premium) ? auth()->user()->isPremium(): request()->premium}}"></avatar-main>
    </div>
    <script src="/js/app.js" defer></script>
</body>
</html>
