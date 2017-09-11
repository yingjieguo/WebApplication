# Calender
link: http://ec2-54-244-11-86.us-west-2.compute.amazonaws.com/~joecz/mod5_group/mycalender.html

A simple calendar that allows users to add and remove events dynamically. Details:

	Used JavaScript to process user interactions at the web browser, without ever refreshing the browser after the initial web page load. Utilized AJAX to run server-side scripts that query your database to save and retrieve information, including user accounts and events.

	Support a month-by-month view of the calendar. Show one month at a time, with buttons to move forward or backwards. 
	No limit about how far forward or backward the user can go. 
	Users can register and log in to the website.

	Unregistered users see no events on the calendar.
	Registered users can add events.
	All events should have a date and time, but do not need to have a duration.
	Registered users see only events that they have added.

	AJAX should won't ask the server for events from a certain username. Instead, it ask the server for events, and the server will respond with the events for only the currently-logged-in user (from the session).
	Registered users can delete their events, but not the events of others.

	All user and event data are kept in a database.
	At no time will the main page need to be reloaded.
	User registration, user authentication, event addition, and event deletion are all be handled by JavaScript and AJAX requests to server.

For your convenience:

Username & password: 
aaaa       aaaa


addtional function: multiple share, choose tag view