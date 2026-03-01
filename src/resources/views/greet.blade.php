<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>挨拶ページ</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            color: #e0e0e0;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 48px 40px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        }

        h1 {
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 36px;
            background: linear-gradient(90deg, #e96cfe, #7b61ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 0.8rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #a0a8c0;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }

        input[type="text"]::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        input[type="text"]:focus {
            border-color: #7b61ff;
            background: rgba(123, 97, 255, 0.1);
        }

        button {
            width: 100%;
            padding: 14px;
            margin-top: 8px;
            background: linear-gradient(90deg, #e96cfe, #7b61ff);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.1s;
        }

        button:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        button:active {
            transform: translateY(0);
        }

        .nav {
            text-align: center;
            margin-top: 24px;
        }

        .nav a {
            color: #7b61ff;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>挨拶しよう！</h1>

        <form method="POST" action="/greet">
            @csrf
            <div class="field">
                <label for="from_name">あなたの名前</label>
                <input type="text" id="from_name" name="from_name" placeholder="例：太郎">
            </div>
            <div class="field">
                <label for="to_name">挨拶する相手</label>
                <input type="text" id="to_name" name="to_name" placeholder="例：花子">
            </div>
            <div class="field">
                <label for="message">メッセージ</label>
                <input type="text" id="message" name="message" placeholder="例：おはようございます！">
            </div>
            <button type="submit">挨拶する</button>
        </form>

        <div class="nav">
            <a href="/greetings">挨拶一覧を見る →</a>
        </div>
    </div>
</body>
</html>
