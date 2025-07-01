<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LibriFlow RMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/record_management_system/public/css/layout.css">
    <style>
        :root {
            --primary-color: #728FCE;
            /* A nice library-esque blue */
            --secondary-color: #A9CCE3;
            /* Lighter blue */
            --text-color: #333;
            --light-text-color: #666;
            --bg-color: #f4f7f6;
            --card-bg: #fff;
            --shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Full viewport height */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background-color: var(--card-bg);
            padding: 20px 0;
            box-shadow: var(--shadow);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8em;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }

        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            margin-left: 25px;
            font-weight: 400;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        main {
            flex-grow: 1;
            /* Allows main content to take up available space */
            display: flex;
            align-items: center;
            /* Vertically center the register box */
            justify-content: center;
            /* Horizontally center the register box */
            padding: 40px 20px;
            /* Add some padding around the register box */
        }

        .register-card {
            background-color: var(--card-bg);
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 400px;
            /* Max width for the register form */
            text-align: center;
        }

        .register-card h2 {
            font-size: 2em;
            margin-bottom: 30px;
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: var(--text-color);
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: calc(100% - 20px);
            /* Account for padding */
            padding: 12px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
            /* Include padding in width calculation */
            transition: border-color 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .register-button {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 20px;
        }

        .register-button:hover {
            background-color: #5d7ebc;
            /* Slightly darker primary color */
            transform: translateY(-2px);
        }

        .login-link {
            display: block;
            margin-top: 25px;
            font-size: 1em;
            color: var(--light-text-color);
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #5d7ebc;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <?php require __DIR__ . '/../layouts/header.php'; ?>
    <!-- CoNTENT -->
    <?php require __DIR__ . '/../pages/registerContent.php'; ?>

    <!-- FOOTER -->
    <?php require __DIR__ . '/../layouts/footer.php'; ?>

</body>

</html>
