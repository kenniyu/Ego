<html>
<head>
<title>
Add Source Temporary Test Page - Ego
</title>
</head>
<body>
<!-
To test using AlchemyAPI: set action attribute to "/feed/alchemy_extract_keyword"
To test using Yahoo Content Analysis API: set action attribute to "/feed/yahoo_extract_keyword"
->
<form name="add_source" action="/query/add_feed" method="post">
<input type="text" name="site_name" />
<input type="text" name="rss_address" />
<input type="submit" value="Submit" />
</form>
</body>
</html>