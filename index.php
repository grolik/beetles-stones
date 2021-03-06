<?php
if (!empty($_POST)) {
	$stones = (int) htmlspecialchars($_POST['stones']);
	$beetles = (int) htmlspecialchars($_POST['beetles']);
	if ($stones <= 0 or $beetles <= 0) $message = "Расчет проводится только с положительными числами.";
	if ($beetles > $stones) $message = "Камней меньше чем жуков.";
	if (!empty($stones) and $stones == $beetles) $message = "Каждому жуку досталось по камню. Свободных камней, при этом не осталось. У последнего жука 0 камней и слева и справа.";
	
	if (!isset($message)) {
		$line[] = $stones;
		$step = 0;
		while ($step < $beetles) {
			rsort($line);
			for ($i = 0; $i < count($line); $i++) {
				$left = $line[$i] == 0 ? 0 : floor(($line[$i] - 1) / 2);
				$right = $line[$i] == 0 ? 0 : ceil(($line[$i] - 1) / 2);
				$step++;
				if ($step == $beetles) {
					$message = "Жук №$step спрятался за камень. Слева у него свободных камней: {$left}, а справа: {$right}";
					break 2;
				}
				$newLine[] = $left;
				$newLine[] = $right;
			}
			$line = $newLine;
			$newLine = [];
		}
	}
}

//default values for form
$stones = isset($stones) ? $stones : 8;
$beetles = isset($beetles) ? $beetles : 3;
?>
<!doctype html>
<html lang="ru">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Bugs and stones</title>
</head>
<body>
	<div class="container">
		<h1>Жуки и камни</h1>
<?php if(isset($message)): ?>
<div class="alert alert-primary" role="alert">
<?= $message ?>
</div>
<?php endif; ?>
		<form method="POST">
			<div class="form-group">
				<label>Количество камней</label>
				<input type="number" value="<?=$stones ?>" class="form-control" name="stones" required>
			</div>
			<div class="form-group">
				<label>Количество жуков</label>
				<input type="number" value="<?=$beetles ?>" class="form-control" name="beetles" required>
			</div>
			<button type="submit" class="btn btn-primary">Посчитать</button>
		</form>
		<hr>
		<div class="card">
			<div class="card-header">
				Тестовое задание
			</div>
			<div class="card-body">
				<h5 class="card-title">Задача:</h5>
				<p class="card-text">Жуки не любят находиться рядом друг с другом и каждый прячется под отдельным камнем и старается выбирать камни, максимально удаленные от соседей.</p>
				<p class="card-text">Так же жуки любят находится максимально далеко от края. Как только жук сел за камень, он более не перемещается.</p>
				<p class="card-text">Всего в линии лежат X камней. И туда последовательно бежит прятаться Y жуков.</p>
				<p class="font-italic">Найти сколько свободных камней будет слева и справа от последнего жука.</p>
				<p></p>
				<h5 class="card-title">Примеры</h5>
				<ul class="list-unstyled">
					<li class="list-inline-item">X=8, Y=1 – ответ 3,4;</li>
					<li class="list-inline-item">X=8, Y=2 – ответ 1,2;</li>
					<li class="list-inline-item">X=8, Y=3 – ответ 1,1;</li>
				</ul>
				<hr class="my-4">
				<div class="jumbotron">
					<h1 class="display-4">Исходный код</h1>
					<p class="lead">Листинг этого файла.</p>
					<hr class="my-4">
					<pre><code>
						<p>
<?php echo htmlspecialchars(file_get_contents("index.php")); ?>
						</p>
					</code></pre>
				</div>
			</div>
		</div>
	</div>
</body>
</html>