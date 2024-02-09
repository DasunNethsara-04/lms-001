<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 20px;
        }

        .availability-badge {
            position: relative;
            display: inline-block;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            color: white;
        }

        .availability-badge::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
            border-radius: 10px;
        }

        .out-of-stock::before {
            background-color: #ff6961;
            /* Light red */
        }

        .available::before {
            background-color: #77dd77;
            /* Light green */
        }

        .in-stock::before {
            background-color: #add8e6;
            /* Light blue */
        }
    </style>
</head>

<body>

    <div class="availability-badge out-of-stock">
        This product is currently out of stock.
    </div>

    <div class="availability-badge available">
        This product is available for purchase.
    </div>

    <div class="availability-badge in-stock">
        This product is currently in stock.
    </div>

</body>

</html>