<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>挨拶一覧</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            font-family: 'Segoe UI', sans-serif;
            color: #e0e0e0;
            padding: 48px 24px;
        }

        .container {
            max-width: 860px;
            margin: 0 auto;
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

        .empty {
            text-align: center;
            color: #a0a8c0;
            padding: 48px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        }

        thead {
            background: linear-gradient(90deg, rgba(233, 108, 254, 0.2), rgba(123, 97, 255, 0.2));
        }

        th {
            padding: 16px 20px;
            text-align: left;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #a0a8c0;
        }

        .btn-delete {
            padding: 6px 14px;
            background: rgba(255, 80, 80, 0.15);
            border: 1px solid rgba(255, 80, 80, 0.3);
            border-radius: 6px;
            color: #ff6b6b;
            font-size: 0.8rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-delete:hover {
            background: rgba(255, 80, 80, 0.3);
        }

        td {
            padding: 14px 20px;
            font-size: 0.95rem;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        tbody tr:hover {
            background: rgba(123, 97, 255, 0.08);
        }

        .id {
            color: #a0a8c0;
            font-size: 0.85rem;
        }

        .message {
            color: #fff;
        }

        .date {
            color: #a0a8c0;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .nav {
            text-align: center;
            margin-top: 28px;
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
    <div class="container">
        <h1>挨拶一覧</h1>

        @if($greetings->isEmpty())
            <div class="empty">
                <p>挨拶がまだありません。</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>挨拶した人</th>
                        <th>挨拶された人</th>
                        <th>メッセージ</th>
                        <th>日時</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($greetings as $greeting)
                        <tr>
                            <td class="id">{{ $greeting->id }}</td>
                            <td>{{ $greeting->from_name }}</td>
                            <td>{{ $greeting->to_name }}</td>
                            <td class="message">{{ $greeting->message }}</td>
                            <td class="date">{{ $greeting->created_at->format('Y/m/d H:i') }}</td>
                            <td>
                                <form method="POST" action="/greetings/{{ $greeting->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="nav">
            <a href="/greet">← 挨拶ページへ戻る</a>
        </div>
    </div>
</body>
</html>
