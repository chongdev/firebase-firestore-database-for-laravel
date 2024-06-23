<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact create-form</title>
</head>
<body>

    <h1>Create Contact</h1>

    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contact.store') }}" method="post">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="phone">Phone</label>
        <input type="tel" name="phone" id="phone" required>
        <br>
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="30" rows="10"></textarea>
        <br>
        <button type="submit">Submit</button>
    </form>
    
    <hr>
    <a href="{{ route('index') }}">Back</a>
    
</body>
</html>