<?php
	// Connection to database
	require "connection_to_database.php";

	// Request from database and sort by date and time from closest to farthest
	$response = $database -> query(
		'SELECT
			id, title, date_time, image
		FROM
			event
		ORDER BY
			date_time DESC'
	);

	// Get the date and time of the day
	$current_date_time = new DateTime();

	$count = 0;
	
	// Loop on all elements from the table event
	while ($data = $response -> fetch())
	{
		$events_data =
		[
			$data['id'],
			$data['title'],
			$data['date_time'],
			$data['image']
		];
		
		// Format the date and time object
		$event_date_time = DateTime::createFromFormat('Y-m-d H:i:s', $events_data[2]);

		// Checks if date is yet to come
		if ($event_date_time < $current_date_time)
		{
			echo
				"<div class='card'>
					<!-- Event picture -->
					<figure class='card_image'>
						<img src='".$events_data[3]."' alt='Logo'>
					</figure>
	
					<div class='card_data'>
						<!-- Event title -->
						<h3 class='card_title'>".$events_data[1]."</h3>
	
						<!-- Event date and hour -->
						<ul class='card_unordered_list'>
							<li>".$event_date_time -> format('l, j F Y - H:i')."</li>
						</ul>
	
						<!-- Button that sends on the event page to see a detailed version -->
						<button type='button' name='see_event' title='See the event&#39;s details' class='card_button'>
							See Event
						</button>
					</div>
				</div>"
			;
		}
	}

	$response -> closeCursor();
?>