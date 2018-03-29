<!DOCTYPE html>
<html>
<head>
	<title>Classroom API Quickstart</title>
	<meta charset='utf-8'/>
</head>
<body>
	<p>Classroom API Quickstart</p>
	<!--Add buttons to initiate auth sequence and sign out-->
	<button id="authorize-button" style="display: none;">Authorize</button>
	<button id="signout-button" style="display: none;">Sign Out</button>
	<pre id="content"></pre>
	<script type="text/javascript">
		// Client ID and API key from the Developer Console
		var CLIENT_ID = '';
		var API_KEY = '';

		// Array of API discovery doc URLs for APIs used by the quickstart
		var DISCOVERY_DOCS = ['https://www.googleapis.com/discovery/v1/apis/classroom/v1/rest'];

		// Authorization scopes required by the API; multiple scopes can be
		// included, separated by spaces.
		var SCOPES = 'https://www.googleapis.com/auth/classroom.courses.readonly';

		var authorizeButton = document.getElementById('authorize-button');
		var signoutButton = document.getElementById('signout-button');

		/**
		 *  On load, called to load the auth2 library and API client library.
		 */
		function handleClientLoad() {
			gapi.load('client:auth2', initClient);
		}

		/**
		 *  Initializes the API client library and sets up sign-in state
		 *  listeners.
		 */
		function initClient() {
			gapi.client.init({
				apiKey: API_KEY,
				clientId: CLIENT_ID,
				discoveryDocs: DISCOVERY_DOCS,
				scope: SCOPES
			}).then(function () {
				// Listen for sign-in state changes.
				gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

				// Handle the initial sign-in state.
				updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
				authorizeButton.onclick = handleAuthClick;
				signoutButton.onclick = handleSignoutClick;
			});
		}

		/**
		 *  Called when the signed in status changes, to update the UI
		 *  appropriately. After a sign-in, the API is called.
		 */
		function updateSigninStatus(isSignedIn) {
			if (isSignedIn) {
				authorizeButton.style.display = 'none';
				signoutButton.style.display = 'block';
				listCourses();
			} else {
				authorizeButton.style.display = 'block';
				signoutButton.style.display = 'none';
			}
		}

		/**
		 *  Sign in the user upon button click.
		 */
		function handleAuthClick(event) {
			gapi.auth2.getAuthInstance().signIn();
		}

		/**
		 *  Sign out the user upon button click.
		 */
		function handleSignoutClick(event) {
			gapi.auth2.getAuthInstance().signOut();
		}

		/**
		 * Append a pre element to the body containing the given message
		 * as its text node. Used to display the results of the API call.
		 *
		 * @param {string} message Text to be placed in pre element.
		 */
		function appendPre(message) {
			var pre = document.getElementById('content');
			var textContent = document.createTextNode(message + '\n');
			pre.appendChild(textContent);
		}

		/**
		 * Print the names of the first 10 courses the user has access to. If
		 * no courses are found an appropriate message is printed.
		 */
		function listCourses() {
			gapi.client.classroom.courses.list({
				pageSize: 10
			}).then(function (response) {
				var courses = response.result.courses;
				appendPre('Courses:');

				if (courses.length > 0) {
					console.log(courses);
					for (i = 0; i < courses.length; i++) {
						var course = courses[i];
						appendPre(course.name);
					}
				} else {
					appendPre('No courses found.');
				}
			});
		}
	</script>
	<script async defer src="https://apis.google.com/js/api.js" onload="this.onload=function(){};handleClientLoad()" onreadystatechange="if (this.readyState === 'complete') this.onload()"></script>
	<
	/body>
	< /html>;