<?php
header('Content-Type: application/json; charset=UTF-8');
// XMLを取得
$strXml = file_get_contents("./BiblicealPlace.xml");
// XML⇒JSONに変換
$strJson = xml_to_json($strXml);
// 出力
print $strJson;

//**********************************
// XML ⇒ JSONに変換する関数
//**********************************
function xml_to_json($xml)
{
    // コロンをアンダーバーに（名前空間対策）
    $xml = preg_replace("/<([^>]+?):([^>]+?)>/", "<$1_$2>", $xml);
    // プロトコルのは元に戻す
    $xml = preg_replace("/_\/\//", "://", $xml);
    // XML文字列をオブジェクトに変換（CDATAも対象とする）
    $objXml = simplexml_load_string($xml, NULL, LIBXML_NOCDATA);
    // 属性を展開する
    xml_expand_attributes($objXml);
    // JSON形式の文字列に変換
    $json = json_encode($objXml, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    // "\/" ⇒ "/" に置換
    return preg_replace('/\\\\\//', '/', $json);
}

//**********************************
// XMLタグの属性を展開する関数
//**********************************
function xml_expand_attributes($node)
{
    if($node->count() > 0) {
        foreach($node->children() as $child)
        {
            foreach($child->attributes() as $key => $val) {
                $node->addChild($child->getName()."@".$key, $val);
            }
            xml_expand_attributes($child); // 再帰呼出
        }
    }
}
?>