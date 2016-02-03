<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ $title }}</h2>

		<div>
                    {{ $intro }} <a href="{{route('confirm', $confirmation_code)}}">Confirm</a> 
		</div>
	</body>
</html>