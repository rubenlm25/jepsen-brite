<?php
	// Connection to database
	try
	{
		$database = new PDO
		// Connection to database on Heroku
		// ('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');

		// Connection to database on localhost
		('mysql:host=localhost;dbname=jepsen-brite;charset=utf8','root','');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e -> getMessage());
	}

	// Request from database and sort by date and time from closest to farthest
	$response = $database -> query(
		'SELECT
			id, title, date, time, image
		FROM
			event
		ORDER BY
			date, time ASC'
	);

	$count = 0;
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
		if ($count === 0)
		{
			echo
				"<div class='".$first_card_classes[0]."'>
					<!-- Event picture -->
					<figure class='".$first_card_classes[1]."'>
						<img src='".$data['image']."' alt='Logo'>
					</figure>
	
					<div class='".$first_card_classes[2]."'>
						<!-- Event title -->
						<h3 class='".$first_card_classes[3]."'>".$data['title']."</h3>
	
						<!-- Event date and hour -->
						<ul class='".$first_card_classes[4]."'>
							<li>".date('l, d.m.Y', strtotime($data['date']))."</li>
							<li>".date('H:i', strtotime($data['time']))."</li>
						</ul>
	
						<!-- Button that sends on the event page to see a detailed version -->
						<button type='button' name='see_event' class='".$first_card_classes[5]."'>
							See Event
						</button>
					</div>
				</div>"
			;
			$count++;
		}
		
		else
		{
			echo
				"<div class='".$rest_of_cards_classes[0]."'>
					<!-- Event picture -->
					<figure class='".$rest_of_cards_classes[1]."'>
						<img src='".$data['image']."' alt='Logo'>
					</figure>

					<div class='".$rest_of_cards_classes[2]."'>
						<!-- Event title -->
						<h3 class='".$rest_of_cards_classes[3]."'>".$data['title']."</h3>

						<!-- Event date and hour -->
						<ul class='".$rest_of_cards_classes[4]."'>
							<li>".date('l, d.m.Y', strtotime($data['date']))."</li>
							<li>".date('H:i', strtotime($data['time']))."</li>
						</ul>

						<!-- Button that sends on the event page to see a detailed version -->
						<button type='button' name='see_event' class='".$rest_of_cards_classes[5]."'>
							See Event
						</button>
					</div>
				</div>"
			;
		}
	}

	$response -> closeCursor();
?>