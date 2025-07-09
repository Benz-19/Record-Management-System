<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-oBwB0QXYK0KXGp8bgoW8KQfZCrsAIbnl9LtKeNMX7GnW1lV7bJUEEvdjZ05cHEhhEkYkYtUez6Wy5YUM3UwXDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            padding: 20px;
        }

        header {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
        }

        header h1 {
            font-size: 2em;
            color: #333;
        }

        header p {
            color: #666;
            margin-top: 5px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        }

        .card i {
            font-size: 28px;
            margin-right: 12px;
            color: #4a90e2;
        }

        .card h2 {
            font-size: 1.2em;
            margin-bottom: 6px;
        }

        .card p {
            font-size: 0.9em;
            color: #777;
            margin-bottom: 10px;
        }

        .card .card-content {
            display: flex;
            align-items: center;
        }

        .card .text {
            flex: 1;
        }

        .card button {
            margin-top: 10px;
            padding: 8px 16px;
            font-size: 14px;
            background-color: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .card button:hover {
            background-color: #3b7bd4;
        }

        .card a {
            text-decoration: none;
        }

        .logoutBtn {
            background-color: red;
            width: 80px;
            height: 34px;
            border-color: red;
            transition: all 0.6s ease-in-out;
            border-radius: 7px;
        }

        .logoutBtn:hover {
            background-color: gray;
            transform: translateY(-10%);
            border: none;
        }
    </style>
</head>

<body>

    <header>
        <div>
            <h1>📚 Admin Dashboard</h1>
            <p>Manage your library system</p>
        </div>
        <a href="/record_management_system/logout">
            <button class="logoutBtn" type="submit">Logout</button>
        </a>
    </header>

    <section class="cards">

        <div class="card">
            <div class="card-content">
                <i class="fas fa-plus-circle"></i>
                <div class="text">
                    <h2>Add New Book</h2>
                    <p>Create a new book entry</p>
                    <a href="/record_management_system/admin/add-book"><button>Add Book</button></a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <i class="fas fa-book"></i>
                <div class="text">
                    <h2>View Available Books</h2>
                    <p>Browse current book inventory</p>
                    <a href="/record_management_system/admin/display-all-books"><button>View Books</button></a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <i class="fas fa-users"></i>
                <div class="text">
                    <h2>View All Clients</h2>
                    <p>See all registered users</p>
                    <a href="/admin/clients"><button>View Clients</button></a>
                </div>
            </div>
        </div>

    </section>

</body>

</html>
