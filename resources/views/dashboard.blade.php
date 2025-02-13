<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Dashboard</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card text-center p-4">
                    <h4>Total Pengguna</h4>
                    <p id="total-users">{{ $total_users }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center p-4">
                    <h4>Pengguna Online</h4>
                    <p id="logged-in-users">{{ $logged_in_users }}</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>