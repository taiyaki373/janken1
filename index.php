<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ゲーム一覧</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 15px 0;
        }
        a {
            text-decoration: none;
            font-size: 20px;
            color: #007bff;
            padding: 10px 20px;
            border: 1px solid #007bff;
            border-radius: 5px;
            display: inline-block;
            width: 50%;
            transition: background-color 0.3s, color 0.3s;
        }
        a:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>ゲーム一覧</h1>
    
    <p>プレイしたいゲームを選択してください。</p>

    <ul>
        <li>
            <a href="./janken.php">じゃんけんゲーム</a>
        </li>
        </ul>
</div>

</body>
</html>