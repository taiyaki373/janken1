<?php

// 定数
const CHOICES = [
    'rock' => 'グー',
    'paper' => 'パー',
    'scissors' => 'チョキ'
];

// 初期設定
$computer_choice = '';
$player_choice = '';
$result = '';

// プレイヤーが選択を送信した場合の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['choice'])) {
    
    // プレイヤーの選択を取得
    $player_choice_key = $_POST['choice'];
    if (array_key_exists($player_choice_key, CHOICES)) {
        $player_choice = CHOICES[$player_choice_key];
    } else {
        // 不正な選択の場合は処理を中断
        $result = '不正な選択です。';
        goto render_html;
    }
    
    // コンピュータの選択をランダムに決定
    $computer_choice_key = array_rand(CHOICES);
    $computer_choice = CHOICES[$computer_choice_key];
    
    // 勝敗の判定
    $result = determine_winner($player_choice_key, $computer_choice_key);
}

/**
 * 勝敗を判定する関数
 * @param string $player プレイヤーの選択キー ('rock', 'paper', 'scissors')
 * @param string $computer コンピュータの選択キー ('rock', 'paper', 'scissors')
 * @return string 結果メッセージ
 */
function determine_winner($player, $computer) {
    if ($player === $computer) {
        return '引き分けです！';
    }

    // 勝利条件
    // rock > scissors, paper > rock, scissors > paper
    if (
        ($player === 'rock' && $computer === 'scissors') ||
        ($player === 'paper' && $computer === 'rock') ||
        ($player === 'scissors' && $computer === 'paper')
    ) {
        return 'あなたの勝ちです！おめでとう！';
    } else {
        return 'コンピュータの勝ちです...';
    }
}

// HTMLのレンダリング開始
render_html:
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>じゃんけんゲーム</title>
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
        .choices button {
            padding: 10px 20px;
            font-size: 18px;
            margin: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s;
        }
        .choices button:hover {
            background-color: #0056b3;
        }
        .result-area {
            margin-top: 30px;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .result-text {
            font-size: 24px;
            font-weight: bold;
            color: #d9534f; /* 負け */
        }
        .result-text.win {
            color: #5cb85c; /* 勝ち */
        }
        .result-text.draw {
            color: #f0ad4e; /* 引き分け */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>✊🏻 チョキ✌🏻 パー✋🏻 じゃんけんゲーム</h1>
    
    <?php if ($result): ?>
        <div class="result-area">
            <p><strong>あなたの手:</strong> <?php echo htmlspecialchars($player_choice); ?></p>
            <p><strong>コンピュータの手:</strong> <?php echo htmlspecialchars($computer_choice); ?></p>
            <hr>
            <?php
                $result_class = 'draw';
                if (strpos($result, '勝ちです') !== false) {
                    $result_class = 'win';
                } elseif (strpos($result, '勝ちです...') !== false) {
                    $result_class = 'lose';
                }
            ?>
            <p class="result-text <?php echo $result_class; ?>">
                <?php echo htmlspecialchars($result); ?>
            </p>
        </div>
    <?php endif; ?>

    <h2>あなたの手を選んでください:</h2>
    <div class="choices">
        <form method="POST" action="janken.php">
            <?php foreach (CHOICES as $key => $name): ?>
                <button type="submit" name="choice" value="<?php echo $key; ?>">
                    <?php echo htmlspecialchars($name); ?>
                </button>
            <?php endforeach; ?>
        </form>
    </div>
    
    <?php if ($result): ?>
    <hr>
    <p>もう一度勝負しますか？上記ボタンから手を選んでください。</p>
    <?php endif; ?>

</div>

</body>
</html>
