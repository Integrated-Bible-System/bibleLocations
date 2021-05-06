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
        function myPrint($string, $val) {
            echo $string . $val . nl2br("<br>");
        }

        function    xml2arr($parsedXML) {
            // prepare an array for return
            $arr = array();
            // Parse XML recursive
            foreach($parsedXML as $key => $val) {
                // if $key's $val is an object, set value to parameter and call itself.
                myPrint('current key is ', $key);
                if(is_object($parsedXML[$key])) {
                    if(array_key_exists($key, $arr)) {
                        $arr[$key] += xml2arr($val);
                    } else {
                        $arr[$key] = xml2arr($val);
                    }
                } else if(is_array($val)) {
                    foreach($val as $k => $v) {
                        if(is_object($v) || is_array($v)) {
                            if(array_key_exists($key, $arr)) {
                                if(array_key_exists($k, $arr[$key])) {
                                    $arr[$key][$k] += xml2arr($v);
                                } else {
                                    $arr[$key][$k] = xml2arr($v);
                                }
                            } else {
                                $arr[$key][$k] = xml2arr($v);
                            }
                        } else {
                            if(array_key_exists($k, $arr[$key])) {
                                $arr[$key][$k] += $v;
                            } else {
                                $arr[$key][$k] = $v;
                            }
                        }
                    }
                } else {
                    if(array_key_exists($key, $arr)) {
                        $arr[$key] += $val;
                    } else {
                        $arr[$key] = $val;
                    }
                }
            }
            return $arr;
        }
        // Read local XML file as simpleXMLObject
        $simpleXMLObj = simplexml_load_file('./BiblicealPlace.xml');
        //var_dump($simpleXMLObj);
        // Convert XML to an array
        $xmlArray = xml2arr($simpleXMLObj);
        echo 'xmlArray count is' . count($xmlArray) . nl2br("<br>");
        var_dump($xmlArray);
        ?>
    </div>
</body>

</html>