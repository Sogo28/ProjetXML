<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }
        .image {
            flex: 1;
            margin-right: 20px;
        }
        .image img {
            max-width: 100%;
            max-height: 300px; /* Ajouté pour limiter la taille de l'image */
            border-radius: 10px;
            object-fit: cover;
        }
        .form-container {
            flex: 1;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image">
            <img src="assets\images\foodie.jpg" alt="food image" />
        </div>
        <div class="form-container">
            <h1>Connexion Admin</h1>
            <form action="index.php?action=authenticate" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

