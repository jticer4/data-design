<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Data Design</title>
	</head>
	<body>
		<h1>Data Design</h1>
			<h2>Persona</h2>
				<h4>Name:</h4>
					<p>Chris P. Bacon</p>
				<h4>Gender:</h4>
					<p>Male</p>
				<h4>Age:</h4>
					<p>30 Years Old</p>
				<h4>Technology:</h4>
					<p>iPhone 7, running IOS 11 and an HP Envy x360 running the latest version of Windows 10.</p>
				<h4>Confidence:</h4>
					<p>Chris is very confident using both his iPhone and his laptop.</p>
				<h4>Attitude:</h4>
					<p>Busy, intellectual, who prefers to consume intellectually stimulating content.</p>
				<h4>Goals:</h4>
					<p>To find interesting articles/videos to entertain himself during his lunch break.</p>
				<h4>Frustrations:</h4>
					<p>Chris hates having to scroll through pages of content trying to find something interesting.
					In his experience a lot of websites post too much filler content.</p>
			<h2>User Story: </h2>
				<p>As a user Chris wants to search for content written by a specific author. </p>
			<h2>Use/Case Interaction Flow: </h2>
				<h4>End Goal:</h4>
					<p>Search for content by specific author on Sploid.</p>
				<h4>Description:</h4>
					<p>Chris wants to find content on Sploid posted by Andrew Liszewski.</p>
				<h4>Preconditions: </h4>
					<p>Chris has successfully connected to the internet and opened his web browser.</p>
				<h4>Postconditions:</h4>
					<p>Chris has a list of content posted by Andrew Liszewski.</p>
						<h4>Interaction Flow:</h4>
							<ul>
								<li>Chris navigates up to the address bar in his browser, types in sploid.gizmodo.com, and hits enter.</li>
								<li>The browser returns Sploid's homepage.</li>
								<li>Chris navigates to the top left corner of the page and clicks on the magnifying glass icon.</li>
								<li>The web browser returns a search field.</li>
								<li>Chris clicks on the search field, types in Andrew Liszewski and hits enter.</li>
								<li>The web browser returns a list populated with content posted by Andrew Liszewski.</li>
							</ul>
			<h2>Conceptual Model: </h2>
				<h3>Entities and Attributes</h3>
					<h4>Author:</h4>
						<ul>
							<li>authorId(primary key)</li>
							<li>authorByline</li>
							<li>authorEmail</li>
							<li>authorName</li>
							<li>authorTitle</li>
						</ul>
					<h4>Article:</h4>
						<ul>
							<li>articleId(primary key)</li>
							<li>articleAuthorId(foreign key)</li>
							<li>articleContent</li>
							<li>articleDateTime</li>
							<li>articleTitle</li>
						</ul>
				<h3>Relations:</h3>
					<ul>
						<li>Each author can have multiple articles.(1-n)</li>
					</ul>
			<h2>Entity Relationship Diagram:</h2>
				<p><img src='diagram2.svg' alt='conceptual model diagram'></p>
	</body>
</html>