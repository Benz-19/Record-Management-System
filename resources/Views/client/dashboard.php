<?php
// echo '<pre>';
// print_r($borrowed_books[0]['is_returned']);
// echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #222;
        }

        .search-bar {
            margin-bottom: 30px;
        }

        .search-bar input[type="text"] {
            padding: 8px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-bar button {
            padding: 8px 14px;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .dashboard-section {
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .btn {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
        }

        .btn-rent {
            background-color: #28a745;
            color: white;
        }

        .btn-return {
            background-color: #ffc107;
            color: black;
        }

        .icon {
            margin-right: 6px;
        }

        @media (max-width: 600px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            td {
                border-bottom: none;
                margin-bottom: 10px;
            }
        }

        .top-cont {
            display: flex;
            justify-content: space-between;
        }

        .logoutBtn {
            background-color: red;
            width: 70px;
            height: 30px;
            border-color: red;
            transition: all 0.6s ease-in-out;
        }

        .logoutBtn:hover {
            background-color: gray;
            transform: translateY(-10%);
            border: none;
        }
    </style>
</head>

<body>

    <h1>📘 Welcome to Client Dashboard</h1>


    <div class="top-cont">
        <!-- Search Bar -->
        <form class="search-bar" method="POST" action="/client/search">
            <input type="text" name="search" placeholder="Search for books..." required>
            <button type="submit"><i class="fas fa-search icon"></i>Search</button>
        </form>

        <a href="/record_management_system/logout">
            <button class="logoutBtn" type="submit">Logout</button>
        </a>
    </div>
    <!-- Available Books -->
    <div class="dashboard-section">
        <h2><i class="fas fa-book-open icon"></i>Available Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <!-- <?php if ($book['is_rented'] !== 'yes'): ?> -->
                    <tr>
                        <td><?= htmlspecialchars($book['title']) ?></td>
                        <td><?= htmlspecialchars($book['author']) ?></td>
                        <td>
                            <form method="POST" action="/client/rent/<?= $book['id'] ?>" class="inline">
                                <button type="submit" class="btn btn-rent"><i class="fas fa-book-reader icon"></i>Rent</button>
                            </form>
                        </td>
                    </tr>
                    <!-- <?php endif; ?> -->
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Rented Books -->
    <div class="dashboard-section">
        <h2><i class="fas fa-box icon"></i>Your Rented Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php if ($rented === 0): ?>
                    <tr>
                        <td>
                            <?php echo "You haven't rented any books yet.";
                            ?>
                        </td>
                    </tr>
                <?php else: ?> -->
                <?php foreach ($books as $book): ?>
                    <?php foreach ($borrowed_books as $borrowed_book): ?>
                        <?php if (array_search($book['id'], $borrowed_books_ids) && ($borrowed_book['is_returned'] === 0) && ($borrowed_book['user_id'] === 2)): ?>
                            <tr>
                                <td><?= htmlspecialchars($book['title']) ?></td>
                                <td><?= htmlspecialchars($book['author']) ?></td>
                                <td>
                                    <form method="POST" action="/client/return/<?= $book['id'] ?>" class="inline">
                                        <button type="submit" class="btn btn-return"><i class="fas fa-undo icon"></i>Return</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <!-- <?php endif; ?> -->
            </tbody>
        </table>
    </div>

</body>

</html>
