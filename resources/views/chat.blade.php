<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="user-id" content="{{ Auth::id() }}">
    <title>dokumen</title>
</head>
<body>
<h1>Chat</h1>
<div id="app">
    <form action="{{ route('send') }}" method="POST">
        @method('POST')
        @csrf

        <label for="receiver">
            <select name="receiver_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </label>
        <label for="message">
            <input type="text" name="message" id="message">
        </label>
        <input type="submit" value="submit">
    </form>
</div>

<div>
    <h2>Chat History</h2>
    <ul id="chat-history">
        <li>
            <strong></strong>
            <p></p>
        </li>
    </ul>
</div>

@vite('resources/js/chat.js')
</body>
</html>
