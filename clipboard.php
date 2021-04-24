<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="cn">
  <head>
    <title>gochaichai.com</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script type="text/javascript" src="css-selector.js"></script>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
  </head>
  <body>
    <div><br><br><br>
      <div style="text-align:center">
        <a href="https://gochaichai.com"><img src="logo.png" class="logo" alt="logo"></a><br>
      </div>
      <div style="text-align:center" id="headSpace"></div>
    </div>
    <br>
    <?php
    $clipboard = "";
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

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      return htmlspecialchars($data);
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <h3>✪ Submit To Clipboard - <span style="color:#666666">2019</span><br></h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <textarea autofocus name="clipboard" rows="12" style="resize:none;width:561px"><?php echo $clipboard; ?></textarea><br>
      <div style="text-align:center">
        <input style="width:100px;height:30px;margin-top:6px;" type="submit" name="submit" value="Submit">
      </div>
    </form>
    <h3>✪ Clipboard - <span style="color:#666666">2019</span><br></h3>
    <div style="border-style:solid;border-width:1px;border-color:gray">
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
            if(rawFile.readyState === 4) {
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
    <br>
    <div style="text-align:center">
      <address>&nbsp;&nbsp;
        <a href="about-en.php">About</a> | <a href="mailto:lhypds@gmail.com">Email</a> | <a href="https://gochaichai.com/index-zh.php">中文</a>
        <br> - by 318yang <a href="clipboard.php">-</a> <br>
      </address>
    </div>
    <p style="text-align:center">
      <a href="https://github.com/lhypds">
        <img src="kopimi.png" class="kopimi" alt="kopimi" border="0">
      </a>
      <br>
    </p>
    <p style="text-align:center"><br><br></p>
  </body>
</html>
