<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-oBwB0QXYK0KXGp8bgoW8KQfZCrsAIbnl9LtKeNMX7GnW1lV7bJUEEvdjZ05cHEhhEkYkYtUez6Wy5YUM3UwXDQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background-color: #007bff;
            color: white;
        }

        th,
        td {
            padding: 15px 20px;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e9f5ff;
        }

        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3b7bd4;
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

        .dashboardBtn {
            background-color: blue;
            width: 120px;
            height: 40px;
            border-color: red;
            transition: all 0.6s ease-in-out;
        }

        .dashboardBtn:hover {
            background-color: gray;
            transform: translateY(-10%);
            border: none;
        }
    </style>
</head>

<body>
    <header>
        <div>
            <h1>📚 View All Users</h1>
            <p>Manage your library system</p>
        </div>
        <a href="/record_management_system/admin/dashboard">
            <button class="dashboardBtn" type="submit">Dashboard</button>
        </a>
    </header>

    <h1><i class="fas fa-users"></i> View All Users</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>User Type</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['user_type']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>
