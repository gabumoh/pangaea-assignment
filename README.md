# Pangaea Take Home Assignment Start Up Instructions

## Publisher App Start Up Steps

Please follow these steps to get the publisher app running. If these steps are not followed properly the app would not work properly or not work at all.

1 **Step 1**: Navigate to the publisher-app folder inside the pangaea root folder.

2 **Step 2**: If a `.env` file is not available, create an empty `.env` file and copy over content from the `.env.example` file into your newly created `.env` file.

3 **Step 3**: The `.env` file configuration in the `.env.example` file has already been set up for `sqlite`. If there is not a `database.sqlite` file present in the database folder create one.
If you are going to use your system's local `mysql` database, update the database section of your `.env` file to match the configurations of your local machine.

4 **Step 4**: Open a new terminal in the publisher-app folder and run the commands in the listed order to install componser requirements and create the database tables and seed the topics table:
```bash
composer install
```

```bash
php artisan migrate
```

```bash
php artisan db:seed
```
5 **Step 5**: Still in that terminal you opened start the server
```bash
php artisan serve --port=8000
```

6 **Step 6**: With your previous terminal still open, open a new terminal in the publisher-app folder and start the queue (**note**: This app would not push notifications to subscribers if the queue is not running)
```bash
php artisan queue:listen
```

## Publisher App Documentation

This contains a light documentation explaining how the available endpoints work

### Topics Endpoint [/topic]

#### List All Topics [GET]

This endpoint is responsible for listing all topics available, it is paginated to show only 25 entries per page.

+ Response 200 (application/json)

			{
				"current_page": 1,
			    "data": [
			        {
			            "name": "test"
			        },
			        {
			            "name": "test1"
			        }
			    ],
			    "first_page_url": "http://127.0.0.1:8000/topics?page=1",
			    "from": 1,
			    "last_page": 1,
			    "last_page_url": "http://127.0.0.1:8000/topics?page=1",
			    "links": [
			        {
			            "url": null,
			            "label": "&laquo; Previous",
			            "active": false
			        },
			        {
			            "url": "http://127.0.0.1:8000/topics?page=1",
			            "label": "1",
			            "active": true
			        },
			        {
			            "url": null,
			            "label": "Next &raquo;",
			            "active": false
			        }
			    ],
			    "next_page_url": null,
			    "path": "http://127.0.0.1:8000/topics",
			    "per_page": 25,
			    "prev_page_url": null,
			    "to": 2,
			    "total": 2
			}

#### Create new Topic [POST]

You may add your own topics using this action. It takes a JSON object containing a name field (string type, no space).

+ Request (application/json)

	+ Body

			{
				"name": "topic1"
			}

+ Response 201 (application/json)
	
	+ Body

			{
				"name": "topic1"
			}


### Subscribe Endpoint [/subscribe/{topic}]

#### Create new Subscription [POST]

You may add your own subscribtion to a topic using this action. It takes a JSON object containing a url field (valid url).

+ Request (application/json)

	+ Body

			{
				"url": "http://test.com"
			}

+ Response 201 (application/json)

	+ Body

			{
				"url": "http://test.com",
				"topic": "{topic}"
			}

### Publish Endpoint [/publish/{topic}]

#### Publish new item to topic [POST]

This end point stores item published to topic in the database and posts this item to subscribers. It takes a JSON object containing keys (strings) of your choosing.

+ Request (application/json)

	+ Body

			{
				[key: string]: any
			}

+ Response 201 (application/json)

	+ Body

			{
				"topic": "{topic}",
				"data": [object] // whatever data was sent in the publish body
			}


## Subscriber App Start Up Steps

Please follow these steps to get the subscriber app running. If these steps are not followed properly the app would not work properly or not work at all.

1 **Step 1**: Navigate to the subscriber-app folder inside the pangaea root folder.

2 **Step 2**: If a `.env` file is not available, create an empty `.env` file and copy over content from the `.env.example` file into your newly created `.env` file.

3 **Step 3**: The `.env` file configuration in the `.env.example` file has already been set up for `sqlite`. If there is not a `database.sqlite` file present in the database folder create one.
If you are going to use your system's local `mysql` database, update the database section of your `.env` file to match the configurations of your local machine.

4 **Step 4**: Open a new terminal in the subscriber-app folder and run the commands below in order to install componser requirements and create the database tables
```bash
composer install
```

```bash
php artisan migrate
```

5 **Step 5**: Still in that terminal you opened start the server
```bash
php artisan serve --port=9000
```

## Subscriber App Documentation

This contains a light documentation explaining how the available endpoints work.

### Test1 Endpoint [/test1]

#### View most recent Notification for subscribed Topic [GET]

+ Response 200 (application/json)

	+ Body

			{
				"topic": "{topic}",
				"data": [object] // whatever data was sent in the publish body
			}

#### Create new Notification for subscribed Topic [POST]

+ Request (application/json)

	+ Body

			{
				"topic": "{topic}",
				"data": [object] // whatever data was sent in the publish body
			}

+ Response 201 (application/json)

	+ Body

			{
				"topic": "{topic}",
				"data": [object] // whatever data was sent in the publish body
			}

### Test2 Endpoint [/test2]

#### View most recent Notification for subscribed Topic [GET]

+ Response 200 (application/json)

	+ Body

			{
				"topic": "{topic}",
				"data": [object] // whatever data was sent in the publish body
			}

#### Create new Notification for subscribed Topic [POST]

+ Request (application/json)

	+ Body

			{
				"topic": "{topic}",
				"data": [object] // whatever data was sent in the publish body
			}

+ Response 201 (application/json)

	+ Body

			{
				"topic": "{topic}",
				"data": [object] // whatever data was sent in the publish body
			}