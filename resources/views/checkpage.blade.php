<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Sessions</title>
    @vite('resources/css/bootstrap.min.css')
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        table {
            width: 1150px;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 12px;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .counter {
            font-size: 20px;
            margin-top: 10px;
            padding: 10px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="checkbox"] {
            transform: scale(1.2);
        }
        .reset-button {
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .reset-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Group: {{ $group->name }}</h2>

    <!-- عرض رسالة نجاح -->
    @if(session('success'))
        <p style="color: red;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ url('/groups/' . $group->id . '/update') }}">
        @csrf
        <table>
            <tr>
                <th>Option</th>
                <th>Check</th>
            </tr>
            @for ($i = 1; $i <= 8; $i++)
                <tr>
                    <td>Session {{ $i }}</td>
                    <td>
                        <input type="checkbox" name="sessions[]" value="{{ $i }}" 
                            {{ $i <= $group->completed_sessions ? 'checked' : '' }}>
                    </td>
                </tr>
            @endfor
        </table>

        <div class="counter">Number of Sessions: {{ $group->completed_sessions }}</span></div>

        <button type="submit" class="reset-button ">Save</button>
    </form>

    <!-- زر إعادة التعيين لإزالة جميع الحصص -->
    <form action="{{ url('/groups/' . $group->id . '/reset') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Reset</button>
    </form>

    <script>
        // تحديث العدد عند تغيير الـ checkboxes
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                let count = document.querySelectorAll('input[type="checkbox"]:checked').length;
                document.getElementById('count').innerText = count;
            });
        });
    </script>
</body>
</html>
