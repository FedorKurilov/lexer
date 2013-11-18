<?php

require 'lexer.php';
require 'analyzers/pascal.php';

$lexer = new PascalLexer();

if (isset($_POST['code']) && $_POST['code']) {
	$time_start = microtime(true);
	$lexer->analyse($_POST['code']);
	$time_end = microtime(true);
	$work_time = round($time_end - $time_start, 5);
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
		<h1>Лексический анализатор</h1>
		<p>Данный графический интерфейс позволяет пользователю, используя возможности лексического анализатора (сканера), провести разбор исходного кода на некотором языке программирования и получить информацию о лексемах (токенах) этого языка, составляющих исходный код. </p>
		<p>Информация о лексеме, возвращаемая сканером: "<code>[<span class="string">строка</span>:<span class="string">столбец_первого_символа</span>] Лексема: <span class="string">текст</span> Класс лексемы: <span class="string">идентификатор_класса</span></code>".</p>
		<div class="clearfix">
			<div class="box left">
				<form method="post" action="index.php">
					<textarea id="code" name="code"><?php echo (isset($_POST['code']) && $_POST['code']) ? $_POST['code'] : 'input'; ?></textarea>
					<div class="clearfix"><input type="submit" value="Анализ" class="right"></div>
				</form>
			</div>
			<div class="box right" id="re">
				<div class="result">
					<table>
<?php

if (isset($output)) :
	foreach ($output as $line) :

?>						<?php
						echo '<tr><td>[' . ($line['row'] + 1) . ':' . ($line['col'] + 1) . ']</td>';
						echo ($line['lex_value']) ? "<td>Лексема: <b>{$line['lex_value']}</b></td>" : '<td></td>';
						echo "<td>Класс лексемы: <em>{$line['lex_type']}</em></td></tr>";
						?>

<?php

	endforeach;
else :
	echo 'output';
endif;

?>
					</table>
				</div>
				<div class="clearfix">
					<?php echo $work_time ? '<span class="right">Выполнено за ' . sprintf('%.5f', $work_time) . ' с</span>' : '';?>

				</div>
			</div>
		</div>
	</div>
</body>
</html>
