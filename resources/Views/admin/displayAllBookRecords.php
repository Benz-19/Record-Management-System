<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>display All Books</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/record_management_system/public/css/layout.css">

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

        .dashboardBtn {
            width: 115px;
            padding: 10px;
            font-size: 16px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.6s ease-in-out;
        }

        .dashboardBtn:hover {
            background-color: gray;
            transform: translateY(-10%);
            border: none;
        }

        #no-results {
            display: none;
            color: red;
            margin-top: 10px;
            text-align: center;
        }

        .message {
            margin: 20px 300px;
        }
    </style>
</head>

<body>
    <div class="top-cont">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search for books by ID or name...">
        </div>

        <a href="/record_management_system/admin/dashboard">
            <button class="dashboardBtn" type="submit">Dashboard</button>
        </a>
    </div>

    <!-- Available Books -->
    <div class="dashboard-section">
        <h2><i class="fas fa-book-open icon"></i>Available Books</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="available-books-body">
                <!-- Books will be injected here by JS -->
            </tbody>
        </table>
        <p id="no-results">ID, Title or Author does not exist.</p>
    </div>

    <div class="message">
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php elseif (isset($_SESSION['success'])): ?>
            <p class="success"><?php echo $_SESSION['success']; ?></p>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </div>

    <!-- JS -->
    <script src="/record_management_system/public/js/layout.js"></script>
    <script src="/record_management_system/public/js/adm_render_books.js"></script>
</body>

</html>
