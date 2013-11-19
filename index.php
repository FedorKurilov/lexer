<?php

require 'lexer.php';
require 'analyzers/pascal.php';

$lexer = new PascalLexer();

if (isset($_POST['code']) && $_POST['code'] !== '') {
    $lexer->analyze($_POST['code']);
    $output = $lexer->get_result();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Pascal lexical analyzer</title>
        <link rel="stylesheet" href="css/codemirror.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="js/codemirror.min.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="wrapper">
            <h1>Pascal lexical analyzer</h1>
            <p>This UI allows the user to parse the source code in some programming language and obtain the information about tokens which make up the source code by using the capabilities of the lexical analyzer.</p>
            <p>The information returned by the lexer: "<code>[<span class="string">line</span>:<span class="string">column</span>] Token: <span class="string">value</span> Token class: <span class="string">class_id</span></code>".</p>
            <div class="main clearfix">
                <div class="box left">
                    <form method="post" action="index.php">
                         <textarea id="code" name="code"><?php echo (isset($_POST['code']) && $_POST['code'] !== '') ? $_POST['code'] : 'input'; ?></textarea>
                         <div class="clearfix"><input type="submit" value="Analyze" class="right"></div>
                    </form>
                </div>
                <div class="box right" id="re">
                    <div class="result">
                        <table>
<?php

if (isset($output)) {
    foreach ($output as $line) {
        echo '                            <tr><td>[' . ($line['row'] + 1) . ':' . ($line['col'] + 1) . ']</td>';
        echo ($line['t_value'] !== '') ? "<td>Token: <b>{$line['t_value']}</b></td>" : '<td></td>';
        echo "<td>Token class: <em>{$line['t_type']}</em></td></tr>\n";
    }
} else {
    echo 'output';
}

?>
                        </table>
                    </div>
                </div>
            </div>
            <p>Copyright (c) 2013 Fedor Kurilov | <a href="https://github.com/FedorKurilov/lexer">GitHub</a></p>
        </div>
    </body>
</html>
