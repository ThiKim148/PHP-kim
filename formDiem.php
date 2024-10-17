<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính Toán Điểm</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 50px;
        }

        #form {
            width: 450px;
            background-color: gray;
            padding: 20px;
            border: 1px solid black;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 18px;
        }

        h1 {
            color: blue;
            text-align: center;
        }

        .b-row {
            display: flex;
            width: 100%;
            padding: 0;
            justify-content: left;
            align-items: center;
            margin-bottom: 10px;
            margin-top: 20px;
        }

        .b {
            width: 30%; /* Adjust label width */
        }

        #so1, #so2, #kq {
            background-color: rgb(211, 211, 211);
            flex: 1;
            border: none;
            padding: 5px;
        }

        select {
            width: 200px; /* Full width for select */
            background-color: rgb(211, 211, 211);
            color: red;
        }

        button {
            background-color: rgb(211, 211, 211);
            margin: 0 15px;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: lightgray; /* Change color on hover */
        }
    </style>
</head>
<body>
    <div id="form">
        <form action="formDiem.php" method="POST">
        <h1>Bảng điểm của em </h1>
            <div class="b-row">
                <label for="so1" class="b">Kì 1:</label>
                <input type="number" id="so1" name="so1" value="<?php echo isset($_POST['so1']) ? $_POST['so1'] : ''; ?>" required>
            </div>
            <div class="b-row">
                <label for="so2" class="b">Kì 2:</label>
                <input type="number" id="so2" name="so2" value="<?php echo isset($_POST['so2']) ? $_POST['so2'] : ''; ?>" required>
            </div>

            <div class="b-row">
                <label for="select" class="b">Năm:</label>
                <select id="select" name="years">
                    <option value="1" <?php echo (isset($_POST['years']) && $_POST['years'] == 1) ? 'selected' : ''; ?>>Năm 1</option>
                    <option value="2" <?php echo (isset($_POST['years']) && $_POST['years'] == 2) ? 'selected' : ''; ?>>Năm 2</option>
                    <option value="3" <?php echo (isset($_POST['years']) && $_POST['years'] == 3) ? 'selected' : ''; ?>>Năm 3</option>
                </select>
            </div>

            <input type="submit" value="Tính Điểm">
        </form>

        <div class="b-row">
            <label for="kq" class="b">Kết quả:</label>
            <input type="text" id="kq" value="<?php echo isset($result) ? $result : ''; ?>" readonly>
        </div>
    </div>

    <?php 
    error_reporting(0);

    // Hàm tính điểm
    function tinhDiem($so1, $so2, $years) {
        if ($years == 1) {
            return ($so1 + $so2) /2;  
        } elseif ($years == 2) {
            return ($so1 + $so2) * 2 /4; 
        } else {
            return "Chỉ tính điểm cho năm 1 và năm 2";  // Năm khác
        }
    }

    // Kiểm tra xem có dữ liệu gửi đến không
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $so1 = isset($_POST['so1']) ? (float)$_POST['so1'] : 0; 
        $so2 = isset($_POST['so2']) ? (float)$_POST['so2'] : 0;  
        $years = isset($_POST['years']) ? (int)$_POST['years'] : 0; 

        // Tính điểm
        $result = tinhDiem($so1, $so2, $years);

        // Hiển thị kết quả
        if (is_numeric($result)) {
            echo "<script>document.getElementById('kq').value = '" . number_format($result, 2) . "';</script>";
        } else {
            echo "<script>document.getElementById('kq').value = '$result';</script>";
        }
    }
    ?>
</body>
</html>