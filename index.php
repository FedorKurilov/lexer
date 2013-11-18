<?php

require 'lexer.php';
require 'analyzers/pascal.php';

$lexer = new PascalLexer();

if (isset($_POST['code']) && $_POST['code']) {
    $lexer->analyse($_POST['code']);
    $output = $lexer->get_result();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Pascal lexical analyzer</title>
        <link rel="stylesheet" href="codemirror/lib/codemirror.css">
        <link rel="stylesheet" href="style.css">
        <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="codemirror/lib/codemirror.js"></script>
        <script src="codemirror/addon/selection/active-line.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <h1>Pascal lexical analyzer</h1>
            <p>This UI allows the user to parse the source code in some programming language and obtain the information about tokens which make up the source code, using the capabilities of the lexical analyzer.</p>
            <p>Information about the token returned by lexer: "<code>[<span class="string">line</span>:<span class="string">column</span>] Token: <span class="string">value</span> Token class: <span class="string">class_id</span></code>".</p>
            <div class="clearfix">
                <div class="box left">
                    <form method="post" action="index.php">
                         <textarea id="code" name="code"><?php echo (isset($_POST['code']) && $_POST['code']) ? $_POST['code'] : 'input'; ?></textarea>
                         <div class="clearfix"><input type="submit" value="Analyse" class="right"></div>
                    </form>
                </div>
                <div class="box right" id="re">
                    <div class="result">
                        <table>
<?php

if (isset($output)) {
    foreach ($output as $line) {
        echo '<tr><td>[' . ($line['row'] + 1) . ':' . ($line['col'] + 1) . ']</td>';
        echo ($line['t_value']) ? "<td>Token: <b>{$line['t_value']}</b></td>" : '<td></td>';
        echo "<td>Token class: <em>{$line['t_type']}</em></td></tr>";
    }
} else {
    echo 'output';
}

?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
