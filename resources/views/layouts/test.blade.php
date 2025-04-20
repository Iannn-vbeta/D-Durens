<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                display: flex;
                height: 100vh;
                margin: 0;
            }

            .sidebar {
                width: 250px;
                background-color: #343a40;
                color: white;
                padding: 15px;
            }

            .sidebar a {
                color: white;
                text-decoration: none;
                display: block;
                margin: 10px 0;
            }

            .sidebar a:hover {
                background-color: #495057;
                padding-left: 10px;
            }

            .content {
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            .topbar {
                background-color: #f8f9fa;
                padding: 10px 20px;
                display: flex;
                justify-content: flex-end;
                align-items: center;
                border-bottom: 1px solid #dee2e6;
            }

            .main-content {
                padding: 20px;
                overflow-y: auto;
            }
        </style>
    </head>

    <body>
        <div class="sidebar">
            <h4>Admin Panel</h4>
            <a href="#">Dashboard</a>
            <a href="#">Users</a>
            <a href="#">Settings</a>
            <a href="#">Reports</a>
        </div>

        <div class="content">
            <div class="topbar">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
            <div class="main-content">
                {{ $slot }}
            </div>
        </div>
    </body>

</html>
