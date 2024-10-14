<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Button</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-button {
            padding: 15px 30px;
            text-decoration: none;
            font-size: 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .dashboard-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="button-container">
        <a class="dashboard-button" href="{{ route('dashboard') }}">Dashboard</a>
    </div>
</body>

</html>
