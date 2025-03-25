<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration Confirmation</title>

    <style>
        body {
            font-family: Inter, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        header {
            background-color: #f5f5f5;
            padding: 10px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        footer {
            background-color: #f5f5f5;
            padding: 10px;
            text-align: center;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-top: 20px;
        }

        .card-header {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-body {
            padding: 10px;
        }

        .card-body li {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Course Registration Confirmation</h1>
        </header>

        <main>
            <h3>Hello, <?= $student_name; ?></h3>
            <p>Thank you for registering for the following course:</p>

            <div class="card">
                <div class="card-header">
                    <strong>Course Details</strong>
                </div>
                <div class="card-body">
                    <ul>
                        <li>
                            <strong>Course Name:</strong> <?= $enrollment->course_name; ?>
                        </li>

                        <li>
                            <strong>Course Code:</strong> <?= $enrollment->course_code; ?>
                        </li>

                        <li>
                            <strong>Credit Hours:</strong> <?= $enrollment->course_credit; ?>
                        </li>

                        <li>
                            <strong>Registration Date:</strong> <?= $enrollment->created_at->toDateTimeString(); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </main>

        <footer>
            <p>This email was sent automatically. Please do not reply to this email.</p>
            <p>&copy; 2025 Student Management System</p>
        </footer>
    </div>
</body>

</html>