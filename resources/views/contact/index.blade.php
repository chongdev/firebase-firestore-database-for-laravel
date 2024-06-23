<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contacts</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    @if (session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    {{-- <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone"><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message"></textarea><br>
        <button type="submit">Create</button>
    </form> --}}
    <h1>Contacts</h1>

    <a href="{{ route('contact.create') }}">Create</a>

    <br>

    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th></th>
        </tr>
        @foreach ($contacts ?? [] as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->message }}</td>
                <td>{{ $contact->created_at }}</td>
                <td>{{ $contact->updated_at }}</td>
                <td>
                    <form action="{{ route('contact.destroy', $contact->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>

                    <form action="{{ route('contact.edit', $contact->id) }}" method="GET">
                        <button type="submit">Edit</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

</body>

</html>
