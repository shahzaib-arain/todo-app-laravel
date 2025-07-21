<!DOCTYPE html>
<html>
<head>
    <title>All Tenants</title>
</head>
<body>
    <h1>List of Tenants</h1>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Tenant ID</th>
                <th>Domain(s)</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenants as $tenant)
                <tr>
                    <td>{{ $tenant->id }}</td>
                    <td>
                        @foreach($tenant->domains as $domain)
                            {{ $domain->domain }}<br>
                        @endforeach
                    </td>
                    <td>{{ $tenant->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
