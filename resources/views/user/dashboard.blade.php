<!DOCTYPE html>
<html>
<head>
    <title>Data Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Data Users</h1>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Bisa Login?</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="{{ $user->status === 'nonaktif' ? 'table-danger' : '' }}">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-primary' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $user->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $user->status }}
                        </span>
                    </td>
                    <td>
                        @if($user->canLogin())
                            <span class="badge bg-success">BISA</span>
                        @else
                            <span class="badge bg-danger">TIDAK BISA</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>