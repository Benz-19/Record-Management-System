<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Book Record</title>
    <link rel="stylesheet" href="/record_management_system/public/css/layout.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
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

        .updateBtn {
            background-color: green;
        }
    </style>
</head>

<body>
    <header>
        <div>
            <h1>📚 Update Record</h1>
            <p>Manage your library system</p>
        </div>
        <a href="/record_management_system/admin/dashboard">
            <button class="dashboardBtn" type="submit">Dashboard</button>
        </a>
    </header>

    <div class="container">
        <h2>Add New Book Record</h2>
        <form action="/record_management_system/admin/process-update-book" method="POST">
            <div class="message">
                <?php if (isset($_SESSION['error'])): ?>
                    <p class="error"><?php echo $_SESSION['error']; ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php elseif (isset($_SESSION['success'])): ?>
                    <p class="success"><?php echo $_SESSION['success']; ?></p>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
            </div>
            <label for="title">Book Title</label>
            <input type="text" id="title" name="title" value="<?php echo $book_data['title']; ?>" required>

            <label for="author">Author</label>
            <input type="text" id="author" name="author" value="<?php echo $book_data['author']; ?>" required>

            <label for="year">Published Year</label>
            <input type="number" id="year" name="published_year" min="1000" max="9999" value="<?php echo $book_data['published_year']; ?>" required>

            <label for="genre">Genre</label>
            <input type="text" id="genre" name="genre" value="<?php echo $book_data['genre']; ?>" required>

            <label for="total">Total Copies</label>
            <input type="number" id="total" name="total_copies" min="1" value="<?php echo $book_data['total_copies']; ?>" required>

            <label for="available">Available Copies</label>
            <input type="number" id="available" name="available_copies" min="0" value="<?php echo $book_data['available_copies']; ?>" required>

            <button type="submit" class="updateBtn" name="updateBtn">Update Book Record</button>
        </form>
    </div>

    <!-- JS -->
    <script src="/record_management_system/public/js/layout.js"></script>
</body>

</html>
