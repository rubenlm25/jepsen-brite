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
			date_time ASC'
	);

	// Get the date and time of the day
	$current_date_time = new DateTime();

	$count = 0;
	$events_number = 1;
	$first_card_classes =
	[
		'card_next_event',
		'card_next_event_image',
		'card_next_event_data',
		'card_next_event_title',
		'card_next_event_unordered_list',
		'card_next_event_button'
	];	
	$rest_of_cards_classes =
	[
		'card',
		'card_image',
		'card_data',
		'card_title',
		'card_unordered_list',
		'card_button'
	];

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
		
		// Format the DateTime object
		$event_date_time = DateTime::createFromFormat('Y-m-d H:i:s', $events_data[2]);

		// Checks if date is yet to come
		if ($event_date_time > $current_date_time)
		{
			// Displays maximum 21 events
			if ($events_number <= 21)
			{
				// Applies special CSS classes for the first element of the list
				if ($count === 0)
				{
					echo
						"<div class='".$first_card_classes[0]."'>
							<!-- Event picture -->
							<figure class='".$first_card_classes[1]."'>
								<img src='".$events_data[3]."' alt='Logo'>
							</figure>
	
							<div class='".$first_card_classes[2]."'>
								<!-- Event title -->
								<h3 class='".$first_card_classes[3]."'>".$events_data[1]."</h3>
	
								<!-- Event date and hour -->
								<ul class='".$first_card_classes[4]."'>
									<li>".$event_date_time -> format('l, d F Y - H:i')."</li>
								</ul>
	
								<!-- Button that sends on the event page to see a detailed version -->
								<button type='button' name='see_event' title='See the event&#39;s details' class='".$first_card_classes[5]."'>
									See Event
								</button>
							</div>
						</div>"
					;
					$count++;
				}
				// Applies the default CSS for the rest of the elements of the list
				else
				{
					echo
						"<div class='".$rest_of_cards_classes[0]."'>
							<!-- Event picture -->
							<figure class='".$rest_of_cards_classes[1]."'>
								<img src='".$events_data[3]."' alt='Logo'>
							</figure>

							<div class='".$rest_of_cards_classes[2]."'>
								<!-- Event title -->
								<h3 class='".$rest_of_cards_classes[3]."'>".$events_data[1]."</h3>

								<!-- Event date and hour -->
								<ul class='".$rest_of_cards_classes[4]."'>
									<li>".$event_date_time -> format('l, j F Y - H:i')."</li>
								</ul>

								<!-- Button that sends on the event page to see a detailed version -->
								<button type='button' name='see_event' title='See the event&#39;s details' class='".$rest_of_cards_classes[5]."'>
									See Event
								</button>
							</div>
						</div>"
					;
				}
				$events_number++;
			}
		}
	}

	$response -> closeCursor();
?>