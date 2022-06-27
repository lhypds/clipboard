<?php

$clipboard = "";
if ((isset($_POST["robotCheck"]) && $_POST["robotCheck"]) || (isset($_COOKIE["robotCheck"]) && $_COOKIE["robotCheck"])) {
    setcookie("robotCheck", "true");

    if (empty($_POST["clipboard"])) {
        $clipboard = "";
    } else {
        $clipboard = test_input($_POST["clipboard"]);

        // Write to clipboard with submitted text
        $filename = 'clipboard.txt';
        if (is_writable($filename)) {
            if (!$handle = fopen($filename, 'a')) {
                echo "Error: Cannot open file ($filename)";
                exit;
            }

            file_put_contents($filename, ""); // Clean
            if (fwrite($handle, $clipboard) === FALSE) {
                echo "Error: Cannot write to file ($filename)";
                exit;
            }
            fclose($handle);
        } else {
            echo "Error: The file $filename is not writable";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">

<head>
    <title>gochaichai.com</title>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <link rel="stylesheet" href="css/style.css">
    <style>
    #clipboardTextarea {
        resize:none;
        width:561px;
        font-size:12.5;
        font-family:Verdana, STXihei, Microsoft YaHei, SimSun, PMingLiU;
    }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/cookie-utils.js"></script>
</head>

<body>
<br>
<h3>✪ Submit To Clipboard<br></h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <textarea id="clipboardTextarea" autofocus name="clipboard" rows="12"><?php echo $clipboard; ?></textarea><br>
  <div style="font-size:12px">
    <input id="robotCheck" style="height:12px;flex" type="checkbox" name="robotCheck" <?php if (isset($_COOKIE["robotCheck"]) && $_COOKIE["robotCheck"]) echo "checked"; ?>>I'm not a robot 🤖</input>
    <script>
        const checkbox = document.getElementById('robotCheck');
        checkbox.addEventListener('change', (event) => {
            if (event.currentTarget.checked) {
                setCookie("robotCheck", true);
            } else {
                setCookie("robotCheck", false);
            }
        });
    </script>
  </div>
  <div style="text-align:center">
    <button style="width:100px;height:30px;margin-top:6px;" type="submit">Submit</button>
  </div>
</form>

<h3>✪ Clipboard<br></h3>
<div style="border-style:solid;border-width:1px;border-color:gray;font-size:12.5;line-height:140%">

    <div style="margin:3px">
    <?php

    if ($file = fopen("clipboard.txt", "r")) {
        while (!feof($file)) {
            $line = fgets($file);
            echo $line;
            echo "<br>";
        }
        fclose($file);
    }

    ?>
    </div>
</div>

<div style="text-align:center">
  <button style="width:100px;height:30px;margin-top:6px" onclick="copyToClipboard(readTextFile('clipboard.txt'))">Copy text</button>
  <script>
    function copyToClipboard(text) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(text).select();
        document.execCommand("copy");
        $temp.remove();
    }

    function readTextFile(file) {
        var rawFile = new XMLHttpRequest();
        var result;
        rawFile.open("GET", file, false);
        rawFile.onreadystatechange = function () {
            if (rawFile.readyState === 4) {
                if(rawFile.status === 200 || rawFile.status == 0) {
                    result = rawFile.responseText;
                }
            }
        }
        rawFile.send(null);
        return result;
    }
  </script>
</div>
<br>
</body>