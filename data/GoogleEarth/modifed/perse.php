<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <title>Analize BiblicalPlace.XML</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/reset.css" type="text/css">
    <link rel="stylesheet" href=“./css/style.css” type="text/css">
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="">
</head>

<body>
    <!-- コンテンツを配置 -->
    <header>
        <div>
            <h1>Read XML file</h1>
            <h2>target: BiblicealPlace.xml</h2>
        </div>
    </header>
    <div>
        <?php
        function myCallback($value, $key) {
            echo "The key $key has the value $value<br>";
        }
        define("XML_FILE", './BiblicealPlace.xml');
        // libxmlエラーを抑制して、ユーザーによるエラー処理を許可する。
        libxml_use_internal_errors(true);
        // XMLファイルを一気に読み込む
        if(file_exists(XML_FILE)) {
            $xml = simplexml_load_file(XML_FILE);
        } else {
            exit("Feild to open XML_FILE");
        }
        if($xml === false) {
            echo("Unable to read XML_FILE as an XML file<br>");
            foreach(libxml_get_errors() as $error) {
                echo "\t" . $error->message;
            }
        }
        $xmlString = $xml->__toString();
        $xsi = new SimpleXMLIterator($xmlString);
        ?>
    </div>
    <!-- SCRIPTS -->
    <!-- Example: <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <!-- Example: <script src="my-script.js" async></script>-->
</body>

</html>