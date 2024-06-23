<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>contact edit-form</title>
</head>
<body>
    <h1>Edit Contact</h1>

    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('contact.update', $contact->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $contact->name }}"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="{{ $contact->email }}"><br>
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" value="{{ $contact->phone }}"><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message">{{ $contact->message ?? '' }}</textarea><br>
        <button type="submit">Update</button>
    </form>

    <hr>
    <a href="{{ route('index') }}">Back</a>
</body>
</html>