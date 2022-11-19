<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name', 'IIS projekt studentske turnaje')}}</title>
    </head>
    <body>
	<p>tournament page</p>
	<p>shows basic info, name, photo?, list of matches</p>
	<p>if host of tournament, add TF to each match team name to add result of match, with button to send</p>
    </body>
</html>
