<!DOCTYPE html>
<html>
<head>
    <title>Register Tenant</title>
</head>
<body>
    <h1>Register New Tenant</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('tenant.store') }}">
        @csrf
        <label for="name">Tenant Name (e.g., foo, bar)</label><br>
        <input type="text" name="name" placeholder="Enter tenant name" required><br><br>
        <button type="submit">Register Tenant</button>
    </form>
</body>
</html>
